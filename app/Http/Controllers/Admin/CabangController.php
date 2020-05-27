<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\AdminModel;
use App\ModelUser;
use App\ModelRiwayat;
use App\ModelKeuangan;
use App\ModelTagihan;
use Auth;
use Indonesia;
use Illuminate\Support\Facades\Input;

class CabangController extends Controller
{
    //
    protected $redirectTo = '/login';

    public function __construct(){
        // pengecekan apakan admin atau bukan
        $this->middleware('cek_admin');
    }

    public function index(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        return view('admin/cabang',
            [
                'user'=>$user,
            ]
        );
    }

    public function getCabang(){
        $cabang = ModelUser::where('id_admin',Auth::guard('admin')->user()->id)->get();
        return $cabang;
    }

    //tambah cabang
    public function tambahCab(Request $request){
        $this->validate($request, [
            'nama'=>'required|min:3',
            'alamat'=>'required|string',
            'no_tlp' => 'required|numeric|unique:tbl_cabang'
        ]);

        $tbl = new ModelUser();
        $tbl->nama_cabang = $request->nama;
        $tbl->password = bcrypt(123456);
        $tbl->alamat = $request->alamat;
        $tbl->no_tlp = $request->no_tlp;
        $tbl->logo = '';
        $tbl->remember_token = '';
        $tbl->active = true;
        $tbl->id_admin = Auth::guard('admin')->user()->id;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = 0;
        $riwayat->id_admin = Auth::guard('admin')->user()->id;
        $riwayat->keterangan = 'Cabang Baru ditambahkan ke sistem';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','Berhasil Ditambahkan');
    }

    //set status
    public function setStatus(){
        $id = Input::get('id');
        $tbl = ModelUser::where('id_admin',Auth::guard('admin')->user()->id)->Where('id',$id)->first();
        $data = (object) array(
            'status' => 'error',
            'message' => 'id tidak ditemukan'
        );
        if($tbl!=null){
            if($tbl->active==true){
                $tbl->active = false;
                $tbl->save();
                //riwayat
                $riwayat = new ModelRiwayat;
                $riwayat->id_cabang = $id;
                $riwayat->id_admin = Auth::guard('admin')->user()->id;
                $riwayat->keterangan = 'Cabang '.$id.' dinonaktifkan';
                $riwayat->tipe = 1;
                $riwayat->save();
                $data->status = 'success';
                $data->message = 'Akun di Nonaktifkan';
            }
            else{
                $tbl->active = true;
                $tbl->save();
                //riwayat
                $riwayat = new ModelRiwayat;
                $riwayat->id_cabang = $id;
                $riwayat->id_admin = Auth::guard('admin')->user()->id;
                $riwayat->keterangan = 'Cabang '.$id.' diaktifkan';
                $riwayat->tipe = 1;
                $riwayat->save();
                $data->status = 'success';
                $data->message = 'Akun di Aktifkan';
            }
        }
        return Response::json($data);
    }

    //hapus cabang
    public function hapusCabang(){
        $id = Input::get('id');
        $tbl = ModelUser::where('id_admin',Auth::guard('admin')->user()->id)->Where('id',$id)->first();
        $data = (object) array(
            'status' => 'error',
            'message' => 'id tidak ditemukan'
        );
        if($tbl!=null){
            $tbl->delete();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = 0;
            $riwayat->id_admin = Auth::guard('admin')->user()->id;
            $riwayat->keterangan = 'Cabang '.$id.' dihapus';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Akun di Hapus Permanent';
        }
        return Response::json($data);
    }

    //reset pass cabang
    public function resetCabang(){
        $id = Input::get('id');
        $tbl = ModelUser::where('id_admin',Auth::guard('admin')->user()->id)->Where('id',$id)->first();
        $data = (object) array(
            'status' => 'error',
            'message' => 'id tidak ditemukan'
        );
        if($tbl!=null){
            $tbl->password = bcrypt(123456);
            $tbl->save();
            //riwayat
            $riwayat = new ModelRiwayat;
            $riwayat->id_cabang = $id;
            $riwayat->id_admin = Auth::guard('admin')->user()->id;
            $riwayat->keterangan = 'Password '.$id.' direset';
            $riwayat->tipe = 1;
            $riwayat->save();
            $data->status = 'success';
            $data->message = 'Akun di berhasil di reset';
        }
        return Response::json($data);
    }

    //get detail cabang
    public function detailCabang(){
        $id = Input::get('id');
        $data = ModelUser::select(
            'tbl_cabang.id',
            'tbl_cabang.no_tlp',
            'tbl_cabang.created_at',
            DB::raw('COUNT(tbl_pelanggan.id) as jml_pelanggan'))->leftJoin('tbl_pelanggan', function($join){
                $join->on('tbl_cabang.id','=','tbl_pelanggan.id_cabang');
            })->where('tbl_cabang.id',$id)->first();
        $max = ModelKeuangan::select(DB::raw('max(created_at) as a'))->where('id_cabang',$id)->first()->a;
        $data->saldo = ModelKeuangan::select(DB::raw('max(saldo) as saldo'))->where('created_at',$max)->where('id_cabang',$id)->first()->saldo;
        $data->avg = ModelTagihan::select(DB::raw('avg(tbl_tagihan.jml_meter) as avg'))
        ->leftJoin('tbl_pelanggan', function($join){
            $join->on('tbl_tagihan.id_pelanggan','=','tbl_pelanggan.id');
        })->where('tbl_pelanggan.id_cabang',$id)->first()->avg;
        return Response::json($data);
    }
}
