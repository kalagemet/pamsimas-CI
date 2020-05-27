<?php

namespace App\Http\Controllers\Cabang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\ModelPelanggan;
use App\ModelTagihan;
use App\ModelUser;
use App\AdminModel;
use App\ModelRiwayat;
use Indonesia;
use Illuminate\Support\Facades\Input;
use Auth;

class PelangganController extends Controller
{
    public function __construct(){
        // pengecekan apakan user atau bukan
        $this->middleware('cek_user');
    }

    //tampil pelanggan
    public function index(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/pelanggan',
        [
            'user' => $user,
        ]);
    }

    //get pellanggan
    public function getPel(){
        $data = ModelPelanggan::where('id_cabang', Auth::user()->id)->paginate(10);
        return $data;
    }

    //hapus pelanggan
    public function hapusPelanggan(){
        $id = Input::get('id');
        $tbl = ModelPelanggan::where('id_cabang',Auth::user()->id)->Where('id',$id)->first();
        $data = (object) array(
            'status' => 'error',
            'message' => 'id tidak ditemukan'
        );
        if($tbl!=null){
            $tagihan = ModelTagihan::where('id_pelanggan',$id);
            $tagihan->delete();
            $tbl->delete();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = Auth::user()->id;
            $riwayat->id_admin = 0;
            $riwayat->keterangan = 'Pelanggan dihapus';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Akun di Hapus Permanent';
        }
        return Response::json($data);
    }

    //cari pelanggan
    public function cariPel(){
        $cari = Input::get('key');
        $data = ModelPelanggan::where('id_cabang', Auth::user()->id)->where(function($q) use($cari){
            $q->Where('nama','like', "%$cari%")->orWhere('id','like', "%$cari%");
        })->paginate(10);
        return Response::json($data);
    }

    //tambah pelanggan
    public function tambahPelanggan(Request $request){
        $this->validate($request, [
            'nama' => 'string|required|min:4|max:50',
            'alamat' => 'max:50'
        ]);

        $tbl = new ModelPelanggan;
        $tbl->nama = $request->nama;
        if($request->alamat==null){
            $tbl->alamat = '-';
        }else{
            $tbl->alamat = $request->alamat;
        }
        $tbl->id_cabang = Auth::user()->id;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Penambahan Pelanggan';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success', 'Pelanggan disimpan');
    }

    //ubah pelanggan
    public function ubahPelanggan(Request $request){
        $this->validate($request, [
            'id'   => 'required|numeric',
            'nama' => 'string|required|min:4|max:50',
            'alamat' => 'max:50'
        ]);

        $tbl = ModelPelanggan::find($request->id);
        $tbl->nama = $request->nama;
        $tbl->alamat = $request->alamat;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Data Pelanggan diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','data diperbarui');
    }
}
