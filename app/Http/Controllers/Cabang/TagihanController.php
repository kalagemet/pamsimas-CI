<?php

namespace App\Http\Controllers\Cabang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\ModelPelanggan;
use App\ModelUser;
use App\AdminModel;
use App\ModelTagihan;
use App\ModelRiwayat;
use Indonesia;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;

class TagihanController extends Controller
{
    public $YEAR_RELEASE;
    public function __construct(){
        // pengecekan apakan user atau bukan
        $this->middleware('cek_user');
        //tahun rilis aplikasi untuk sorting data tahun
        $this->YEAR_RELEASE = 2019;
    }

    //input tagihan pelanggan
    public function index(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/input_tagihan',
        [
            'user' => $user,
        ]);
    }

    //get tarif
    public function getTarif(){
        $data = DB::table('tbl_kebijakan')->where('id_cabang', Auth::user()->id)->first();
        while($data==null){
            //membuat tabel jika belum ada
            $keb = DB::table('tbl_kebijakan')->insert([
                'id_cabang' => Auth::user()->id,
                'tarif'     => 1000,
                'penalti'   => 0,
                'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
            ]);
            $data = DB::table('tbl_kebijakan')->where('id_cabang', Auth::user()->id)->first();
        }
        return Response::json($data);
    }

    // /set tarif
    public function setTarif(Request $request){
        $this->validate($request, [
            'tarif' => 'numeric|required|min:1',
            'penalti' => 'numeric|required'
        ]);

        $tbl = DB::table('tbl_kebijakan')->where('id_cabang', Auth::user()->id)->update([
            'tarif' => $request->tarif,
            'penalti' => $request->penalti,
            'updated_at' => \Carbon\Carbon::now('Asia/Jakarta')
        ]);
        
        $data = (object) array(
            'status' => 'error',
            'message' => 'Autentikasi ID Cabang tidak ditemukan'
        );
        if($tbl){
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Kebijakan diperbarui';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Kebijakan diperbaharui';
        }
        return Response::json($data);
    }

    //input tagihan
    public function inputTagihan(Request $request){
        $this->validate($request, [
            'jml_meter' => 'required|numeric|min:1',
            'id_pelanggan' => 'required|string'
        ]);
        
        $data = (object) array(
            'status' => 'error',
            'message' => 'Autentikasi ID Cabang tidak ditemukan'
        );
        $tarif = DB::table('tbl_kebijakan')->select('tarif')->where('id_cabang', Auth::user()->id)->first();
        if($tarif->tarif==null){
            $data->status = 'error';
            $data->message = 'Gagal, Mohon Periksa Kebijakan';
        }
        else{
            $tbl = new ModelTagihan;
            $tbl->jml_meter = $request->jml_meter;
            $tbl->id_pelanggan = $request->id_pelanggan;
            $tbl->tarif = $tarif->tarif;
            $tbl->lunas = 0;
            $tbl->save();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Tagihan baru di inputkan';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Tagihan disimpan';
        }
        return Response::json($data);
    }

    //input tagihan 2
    public function inputTagihan2(Request $request){
        $this->validate($request, [
            'jml_meter' => 'required|numeric|min:1',
            'id_pelanggan' => 'required|string',
            'bulan' => 'numeric|required'
        ]);
        
        $data = (object) array(
            'status' => 'error',
            'message' => 'Autentikasi ID Cabang tidak ditemukan'
        );
        $tarif = DB::table('tbl_kebijakan')->select('tarif')->where('id_cabang', Auth::user()->id)->first();
        if($tarif->tarif==null){
            $data->status = 'error';
            $data->message = 'Gagal, Mohon Periksa Kebijakan';
        }
        else{
            $tbl = new ModelTagihan;
            $tbl->jml_meter = $request->jml_meter;
            $tbl->id_pelanggan = $request->id_pelanggan;
            $tbl->tarif = $tarif->tarif;
            //set tanggal tagihan
            $tahun = \Carbon\Carbon::now('Asia/Jakarta');
            $tahun = $tahun->year;
            $bulan = $request->bulan;
            $tbl->created_at = date($tahun.'-'.$bulan.'-05 12:01:98');
            $tbl->lunas = 0;
            $tbl->save();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Penambahan input Tagihan';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Tagihan disimpan';
        }
        return Response::json($data);
    }

    //get pellanggan (tagihan)
    public function getPel(){
        $data = ModelPelanggan::select(
            DB::raw('tbl_pelanggan.id as id,
            tbl_pelanggan.alamat as alamat,
            tbl_pelanggan.nama as nama,
            IF(month(max(tbl_tagihan.created_at))=month(CURRENT_TIMESTAMP),1,0) as input,
            tbl_tagihan.jml_meter as jml_meter, max(month(tbl_tagihan.created_at)) as tagihan_terakhir, tbl_tagihan.tarif, tbl_tagihan.jml_meter')
        )->leftJoin('tbl_tagihan', function($join) {
            $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
        })->where('id_cabang', Auth::user()->id)->groupBy('tbl_pelanggan.id')->paginate(10);
        return Response::json($data);
    }

    //cari tagihan pelanggan
    public function cariPel(){
        $cari = Input::get('key');
        $data = ModelPelanggan::select(
            DB::raw('tbl_pelanggan.id as id,
            tbl_pelanggan.alamat as alamat,
            tbl_pelanggan.nama as nama,
            IF(month(max(tbl_tagihan.created_at))=month(CURRENT_TIMESTAMP),1,0) as input,
            tbl_tagihan.jml_meter as jml_meter, max(month(tbl_tagihan.created_at)) as tagihan_terakhir, tbl_tagihan.tarif, tbl_tagihan.jml_meter')
        )->leftJoin('tbl_tagihan', function($join) {
            $join->on('tbl_pelanggan.id', '=', 'tbl_tagihan.id_pelanggan');
        })->where('id_cabang', Auth::user()->id)->where(function($q) use($cari){
            $q->Where('tbl_pelanggan.nama','like', "%$cari%")->orWhere('tbl_pelanggan.id','like', "%$cari%");
        })->groupBy('tbl_pelanggan.id')->paginate(10);
        return $data;
    }

    //ubah tagihan pelanggan
    public function ubahTagihan(){
        $id_pel = Input::get('id_pel');
        $data = ModelPelanggan::find($id_pel);
        if($data==null){
            return redirect('/cabang/input_tagihan')->with('error', 'ID Pelanggan '.$id_pel.' tidak ditemukan');
        }
        //cek tagihan sudah ada apa belum
        $tagihan = ModelTagihan::where('id_pelanggan',$id_pel)->first(['id']);
        if($tagihan==null){
            return redirect('/cabang/input_tagihan')->with('error', 'ID Pelanggan '.$id_pel.' Belum memiliki tagihan apapun');
        }
        //cek tagihan bulan ini sudah ada apa belum
        $tagihan = ModelTagihan::where('id_pelanggan',$id_pel)->whereMonth('created_at',\Carbon\Carbon::now('Asia/Jakarta')->month)->whereYear('created_at', \Carbon\Carbon::now('Asia/Jakarta'))->first(['id']);
        if($tagihan==null){
            return redirect('/cabang/input_tagihan')->with('error', 'Mohon terlebih dahulu input tagihan bulan ini untuk ID Pelanggan '.$id_pel);
        }
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $tahun = \Carbon\Carbon::now('Asia/Jakarta');
        return view('cabang/ubah_tagihan',
        [
            'tahun_rilis' => $this->YEAR_RELEASE,
            'tahun_ini' => $tahun->year,
            'user' => $user,
            'data'  => $data,
        ]);
    }

    // get tagihan
    public function getTagihanall(){
        $id_pel = Input::get('id_pel');
        $tahun = Input::get('tahun');
        if($tahun==null){
            $tahun = \Carbon\Carbon::now('Asia/Jakarta');
            $tahun = $tahun->year;
        }
        $data = array();
        $batas = \Carbon\Carbon::now('Asia/Jakarta');
        $batas = $batas->month;
        for($i=0;$i<$batas;$i++){
            $data[] = array(
                'bulan' => $i,
                'data' => ModelTagihan::select(DB::raw('*,(tarif*jml_meter) as total'))
                ->where('id_pelanggan',$id_pel)
                ->whereMonth('created_at', $i+1)
                ->whereYear('created_at', $tahun )->get()
            );
        }
        return Response::json($data);
    }

    //update tagihan
    public function updateTagihan(Request $request){
        $this->validate($request, [
            'jml_meter' => 'required|numeric|min:1',
            'id_tagihan' => 'required|string'
        ]);
        
        $data = (object) array(
            'status' => 'error',
            'message' => 'Autentikasi ID Cabang tidak ditemukan'
        );
        $tarif = DB::table('tbl_kebijakan')->select('tarif')->where('id_cabang', Auth::user()->id)->first();
        if($tarif->tarif==null){
            $data->status = 'error';
            $data->message = 'Gagal, Mohon Periksa Kebijakan';
        }
        else{
            $tbl = ModelTagihan::find($request->id_tagihan);
            $tbl->jml_meter = $request->jml_meter;
            $tbl->save();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Tagihan Pelanggan diperbarui';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Tagihan disimpan';
        }
        return Response::json($data);
    }
}
