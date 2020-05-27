<?php

namespace App\Http\Controllers\Cabang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\ModelPelanggan;
use App\ModelUser;
use App\AdminModel;
use App\ModelRiwayat;
use App\ModelTagihan;
use App\ModelKeuangan;
use Indonesia;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;

class BayarController extends Controller
{
    public function __construct(){
        // pengecekan apakan user atau bukan
        $this->middleware('cek_user');
    }

    public function index(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/bayar_tagihan',
        [
            'user' => $user,
        ]);
    }

    //get tagihan
    public function getTagihan(){
        $data = ModelPelanggan::select(DB::raw('tbl_pelanggan.id, tbl_pelanggan.nama, tbl_pelanggan.alamat, (SELECT COUNT(*) FROM tbl_tagihan WHERE tbl_tagihan.id_pelanggan=tbl_pelanggan.id AND tbl_tagihan.lunas=0) as jml_tagihan'))
        ->where('id_cabang', Auth::user()->id)->paginate(10);
        return Response::json($data);
    }

    //get tagihan belu widget
    public function getTagihanbelum(){
        $data = ModelPelanggan::select(DB::raw('tbl_pelanggan.nama, month(tbl_tagihan.created_at) as bulan, tbl_tagihan.id_pelanggan, COUNT(tbl_tagihan.id) as jml'))
        ->leftJoin('tbl_tagihan', function($join){
            $join->on('tbl_tagihan.id_pelanggan','=','tbl_pelanggan.id');
        })->where('tbl_tagihan.lunas','=',0)->where('id_cabang', Auth::user()->id)->groupBy('tbl_pelanggan.nama')->orderBy('jml','desc')->paginate(5);
        return Response::json($data);
    }

    //cari tagihan
    public function cariTagihan(){
        $cari = Input::get('cari');
        $data = ModelPelanggan::select(DB::raw('tbl_pelanggan.id, tbl_pelanggan.nama, tbl_pelanggan.alamat, (SELECT COUNT(*) FROM tbl_tagihan WHERE tbl_tagihan.id_pelanggan=tbl_pelanggan.id AND tbl_tagihan.lunas=0) as jml_tagihan'))
        ->where('id_cabang', Auth::user()->id)
        ->leftJoin('tbl_tagihan', function($join) {
            $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
        })->where(function($q) use($cari){
            $q->where('nama','like', "%$cari%")->orWhere('tbl_pelanggan.id','like', "%$cari%");
        })->groupby('tbl_tagihan.id_pelanggan')->paginate(10);
        return Response::json($data);
    }

    //cari bulan tagihan
    public function cariBulanTagihan(){
        $cari = Input::get('bulan');
        $data = ModelPelanggan::select(DB::raw('tbl_pelanggan.id, tbl_pelanggan.nama, tbl_pelanggan.alamat, (SELECT COUNT(*) FROM tbl_tagihan WHERE tbl_tagihan.id_pelanggan=tbl_pelanggan.id AND tbl_tagihan.lunas=0) as jml_tagihan'))
        ->where('id_cabang', Auth::user()->id)
        ->leftJoin('tbl_tagihan', function($join) {
            $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
        })->where(DB::raw('month(tbl_tagihan.created_at)'),'like', "%$cari%")->groupby('tbl_tagihan.id_pelanggan')->paginate(10);
        return Response::json($data);
    }

    //cetak tagihan
    public function cetakTagihan(){
        $cari = Input::get('bulan');
        //validasi bulan
        if($cari==null){
            return redirect('/err_cetak');
        }
        if($cari!=13){
            //get data tagihan
            $data = ModelPelanggan::select(DB::raw(
                'tbl_pelanggan.id, tbl_pelanggan.nama,
                tbl_pelanggan.alamat, month(tbl_tagihan.created_at) as bulan,
                tbl_tagihan.tarif, tbl_tagihan.jml_meter, 
                (tbl_tagihan.jml_meter*tbl_tagihan.tarif) as total,
                TIMESTAMPDIFF(Month,tbl_tagihan.created_at, NOW()) as terlambat,
                (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan) as tarif_denda,
                (TIMESTAMPDIFF(Month,tbl_tagihan.created_at, NOW())*
                (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan)) as denda'
            ))
            ->where('id_cabang', Auth::user()->id)
            ->leftJoin('tbl_tagihan', function($join) {
                $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
            })->where('tbl_tagihan.lunas',0)->where(DB::raw('month(tbl_tagihan.created_at)'), $cari)->get();
        }else{
            $data = ModelPelanggan::select(DB::raw(
                'tbl_pelanggan.id, tbl_pelanggan.nama,
                tbl_pelanggan.alamat, month(tbl_tagihan.created_at) as bulan,
                tbl_tagihan.tarif, tbl_tagihan.jml_meter, 
                (tbl_tagihan.jml_meter*tbl_tagihan.tarif) as total,
                TIMESTAMPDIFF(Month,tbl_tagihan.created_at, NOW()) as terlambat,
                (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan) as tarif_denda,
                (TIMESTAMPDIFF(Month,tbl_tagihan.created_at, NOW())*
                (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan)) as denda'
            ))
            ->where('id_cabang', Auth::user()->id)
            ->leftJoin('tbl_tagihan', function($join) {
                $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
            })->where('tbl_tagihan.lunas',0)->orderBy('tbl_pelanggan.id','ASC')->get();
        }
        //get kop slip rekening
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        //buat file slip rekening
        $pdf = PDF::loadView('document.cetak_tagihan', [
            'user' => $user,
            'data' => $data,
            'tgl'  => \Carbon\Carbon::now('Asia/Jakarta')
        ])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    //get bayar detail
    public function getBayarDetail(){
        $id_pel = Input::get('id_pel');
        $data = ModelTagihan::select(DB::raw(
            'id, jml_meter, tarif, month(created_at) as bulan,
             TIMESTAMPDIFF(Month,created_at, NOW()) as terlambat,
              (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan) as tarif_denda,
              (jml_meter*tarif) as total,
              (TIMESTAMPDIFF(Month,created_at, NOW())*(SELECT tbl_kebijakan.penalti FROM tbl_kebijakan)) as totaldenda,
              ((TIMESTAMPDIFF(Month,created_at, NOW())*(SELECT tbl_kebijakan.penalti FROM tbl_kebijakan))+(jml_meter*tarif)) as subtotal'
            ))
        ->where('id_pelanggan', $id_pel)->where('created_at', '<=', DB::raw('NOW()') )
        ->where('lunas',0)->get();
        return Response::json($data);
    }

    //bayar
    public function bayar(Request $request){
        //validasi
        $this->validate($request, [
            'id_pel' => 'required|numeric'
        ]);

        $stts = (object) array(
            'status' => 'error',
            'message' => 'Autentikasi ID Cabang tidak ditemukan'
        );
        //get data pelanggan yg dipilih dan kop rekening
        $id_pel = $request->id_pel;
        $pel = ModelPelanggan::find($id_pel);
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $user->kec = Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->name;
        $user->kab = Indonesia::findCity(
            Indonesia::findDistrict(
                Indonesia::findVillage($desa)->district_id
            )->city_id
        )->name;
        //get data tagihan
        $data = ModelTagihan::select(DB::raw(
            'id, jml_meter, tarif, month(created_at) as bulan,
             TIMESTAMPDIFF(Month,created_at, NOW()) as terlambat,
              (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan) as tarif_denda,
              (jml_meter*tarif) as total,
              (TIMESTAMPDIFF(Month,created_at, NOW())*
              (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan)) as totaldenda,
              ((TIMESTAMPDIFF(Month,created_at, NOW())*
              (SELECT tbl_kebijakan.penalti FROM tbl_kebijakan))+(jml_meter*tarif)) as subtotal'
            ))
        ->where('id_pelanggan', $id_pel)
        ->where('lunas',0)->get();
        //hitung denda
        $denda = DB::table('tbl_kebijakan')
        ->select('penalti')->where('id_cabang', Auth::user()->id)->get();
        //buat slip rekening
        $pdf = PDF::loadview('document.rekening', [
            'asli' => 'Cetak Asli',
            'user' => $user,
            'data' => $data,
            'nama' => $pel,
            'tgl'  => \Carbon\Carbon::now('Asia/Jakarta')
        ])->setPaper('a4', 'portrait');
        //set bayar
        $tbl = ModelTagihan::where('id_pelanggan', $request->id_pel)
        ->where('lunas',0)->update(['lunas' => 1, 'denda'=>$denda]);
        if($tbl!=null){
            //menulis di pembukuan
            for($i=0;$i<count($data);$i++){
                $pembukuan = new ModelKeuangan;
                $pembukuan->debet = $data[$i]->subtotal;
                $pembukuan->kredit = 0;
                $create = ModelKeuangan::select(DB::raw('max(created_at) as a'))->first();
                $saldo = ModelKeuangan::select(DB::raw('max(saldo) as saldo'))
                ->where('id_cabang',Auth::user()->id)->where('created_at',$create->a)->first();
                $saldo = $saldo->saldo;
                if($saldo==null){
                    $saldo = 0;
                }
                $pembukuan->saldo = ($saldo+$data[$i]->subtotal);
                $pembukuan->akses = 0;
                $pembukuan->keterangan = 'tagihan pam & denda Rp. '.$data[$i]->totaldenda.',- (id_pel : '.$id_pel.')';
                $pembukuan->id_cabang = Auth::user()->id;
                $pembukuan->save();
                //riwayat
                $riwayat = new ModelRiwayat;
                $riwayat->id_cabang = Auth::user()->id;
                $riwayat->id_admin = 0;
                $riwayat->keterangan = 'Tagihan terbayar/debet kas pelanggan #'.$id_pel;
                $riwayat->tipe = 0;
                $riwayat->save();
            }
            return $pdf->stream(\Carbon\Carbon::now('Asia/Jakarta').'_ca_'.$pel->id.'.pdf');
        }
        return Response::json($stts);
    }

    //cetak ulang
    public function cetakUlang(){
        $id_pel = Input::get('id_pel');
        $data = ModelPelanggan::find($id_pel);
        if($data==null){
            return redirect('/cabang/bayar_tagihan')->with('error', 'ID Pelanggan '.$id_pel.$pel->nama.' tidak ditemukan');
        }
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $tahun = \Carbon\Carbon::now('Asia/Jakarta');
        return view('cabang/cetak_ulang',
        [
            'tahun_rilis' => 2019,
            'tahun_ini' => $tahun->year,
            'user' => $user,
            'data'  => $data,
        ]);
    }

    //GET cetak ulang
    public function getCetakUlang(){
        $id_pel = Input::get('id_pel');
        $tahun = Input::get('tahun');
        $data = ModelTagihan::select('id','updated_at',DB::raw('month(created_at) as bulan'))->where('id_pelanggan', $id_pel)->where('lunas',1)->whereYear('updated_at',$tahun)->get();
        return Response::json($data);
    }
    
    //cetak ulang rekening
    public function cetakRekening(){
        $id = Input::get('id_tagihan');
        if($id==null || $id == 0){
            return redirect('/error');
        }
        $pel = ModelTagihan::select('id_pelanggan')->where('id',$id)->first();
        $pel = ModelPelanggan::find($pel->id_pelanggan);
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $user->kec = Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->name;
        $user->kab = Indonesia::findCity(Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->city_id)->name;
        $data = ModelTagihan::select(DB::raw(
            'id, jml_meter, tarif, month(created_at) as bulan,
             TIMESTAMPDIFF(Month,created_at, updated_at) as terlambat,
              tbl_tagihan.denda as tarif_denda,
              (jml_meter*tarif) as total,
              (TIMESTAMPDIFF(Month,created_at, updated_at)*denda) as totaldenda,
              ((TIMESTAMPDIFF(Month,created_at, updated_at)*denda)+(jml_meter*tarif)) as subtotal'
            ))
        ->where('id', $id)->where('lunas',1)->get();
        $pdf = PDF::loadview('document.rekening', [
            'asli' => 'Cetak ulang',
            'user' => $user,
            'data' => $data,
            'nama' => $pel,
            'tgl'  => \Carbon\Carbon::now('Asia/Jakarta')
        ])->setPaper('a4', 'portrait');
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Cetak Ulang rekening #'.$id;
        $riwayat->tipe = 1;
        $riwayat->save();
        return $pdf->stream(\Carbon\Carbon::now('Asia/Jakarta').'_cu_'.$pel->id.$pel->nama.'.pdf');
    }
}
