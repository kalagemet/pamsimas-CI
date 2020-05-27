<?php

namespace App\Http\Controllers\Cabang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelUser;
use App\AdminModel;
use App\ModelKeuangan;
use App\ModelRiwayat;
use Indonesia;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use Excel;
use App\Exports\LaporanExcel;

class PembukuanController extends Controller
{
    public function __construct(){
        // pengecekan apakah user atau bukan
        $this->middleware('cek_user');
    }

    public function index(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $tahun = \Carbon\Carbon::now('Asia/Jakarta');
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/pembukuan',
        [
            'tahun_rilis' => 2019,
            'tahun_ini' => $tahun->year,
            'user' => $user,
        ]);
    }

    //get data keuangan
    public function getData(){
        $tahun = Input::get('tahun');
        $data = ModelKeuangan::where('id_cabang', Auth::user()->id)->whereYear('created_at',$tahun)->orderBy('created_at','desc')->paginate(10);
        return Response::json($data);
    }

    //tambah data
    public function tambahData(Request $request){
        $request->nilai = preg_replace("/[^0-9 ]/", '', $request->nilai);
        $this->validate($request, [
            'type' => 'numeric|required|min:1',
            'nilai' => 'required|min:3',
            'ket'   => 'string|required'
        ]);

        $tbl = new ModelKeuangan;
        $tbl->id_cabang = Auth::user()->id;
        $create = ModelKeuangan::select(DB::raw('max(created_at) as a'))->first();
        $saldo = ModelKeuangan::select(DB::raw('max(saldo) as saldo'))->where('id_cabang',Auth::user()->id)->where('created_at',$create->a)->first();
        $saldo = $saldo->saldo;
        if($saldo==null){
            $saldo = 0;
        }
        if($request->type==1){
            $tbl->debet = $request->nilai;
            $tbl->kredit = 0;
            $tbl->saldo = $saldo+$request->nilai;
        }else{
            $tbl->kredit = $request->nilai;
            $tbl->debet = 0;
            $tbl->saldo = $saldo-$request->nilai;
        }
        $tbl->keterangan = $request->ket;
        $tbl->akses = 1;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Data Keuangan baru di inputkan';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','Data berhasil ditambahkan ');
    }

    //hapus data
    public function hapusData(Request $request){
        $this->validate($request, [
            'id' => 'numeric|required',
        ]);

        $data = (object) array(
            'status' => 'error',
            'message' => 'id tidak ditemukan'
        );
        $tbl= ModelKeuangan::find($request->id);
        if($tbl!=null){
            $tbl->delete();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Data pembukuan terbaru diurungkan dari pencatatan';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Dihapus';
        }
        return Response::json($data);
    }

    //cetak laporan
    public function cetakLaporan(){
        $tahun = Input::get('tahun');
        $data = ModelKeuangan::where(
            'id_cabang', Auth::user()->id
        )->whereYear('created_at',$tahun)->get();

        //cek data index
        if(count($data)==0){
            return redirect()->back()->with('error','Laporan tidak tersedia');
        }
        //get data kop laporan
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $user->kec = Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->name;
        $user->kab = Indonesia::findCity(
            Indonesia::findDistrict(
                Indonesia::findVillage($desa)->district_id
            )->city_id
        )->name;
        //buat laporan
        $pdf = PDF::loadview('document/laporan_keuangan',[
            'user' => $user,
            'data' => $data,
            'tgl'  => \Carbon\Carbon::now('Asia/Jakarta')
        ])->setPaper('a4', 'portrait');
        //return file laporan
        return $pdf->stream(
            'laporanCetak'.\Carbon\Carbon::now('Asia/Jakarta').'_'.Auth::user()->id.'-'.$tahun
        );
    }

    //download excel
    public function cetakExcel(){
        $tahun = Input::get('tahun');
        $user = ModelUser::find(Auth::user()->id);
        return (new LaporanExcel($tahun))->download('Laporan Keuangan '.$user->nama_cabang.'-'.Auth::user()->id.' Cetak'.\Carbon\Carbon::now('Asia/Jakarta').'.xlsx');
    }
}
