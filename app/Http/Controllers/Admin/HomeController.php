<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Image;
use Hash;
use Indonesia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\AdminModel;
use App\ModelRiwayat;
use App\ModelUser;
use App\ModelKeuangan;
use App\ModelTagihan;

class HomeController extends Controller
{
    /**
     * Where to redirect users if not admin.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    public $path;
    public $dimensions;

    public function __construct(){
        // pengecekan apakan admin atau bukan
        $this->middleware('cek_admin');

        //set dimesi gambar
        //DEFINISIKAN PATH
        $this->path = storage_path('app\public\admin\pic');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['100'];
    }

    public function index(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        return view('admin/home',
            [
                'user'=>$user,
            ]
        );
    }

    public function ubah_profil(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        $provinsi = Indonesia::allProvinces();
        return view('admin/ubah_profile',
            [
                'user'=>$user,
                'prov'=>$provinsi
            ]
        );
    }
    //get pic
    public function getPic(){
        return Image::make(storage_path('app\\public\\admin\\pic\\100\\'.Auth::guard('admin')->user()->foto))->response();
    }

    //upload
    public function upload_pic(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
		
        //JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }
		
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UuserID()
        $fileName = Carbon::now()->timestamp . '_' . Auth::guard('admin')->user()->id . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        // Image::make($file)->save($this->path . '/' . $fileName);
		
        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
			
            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }
        	
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);

            
            //menghapus fille sebelumnya
            File::delete($this->path . '/' . $row . '/' . Auth::guard('admin')->user()->foto);
        }
        
        //SIMPAN DATA IMAGE YANG TELAH DI-UPLOAD
        $tbl = AdminModel::find(Auth::guard('admin')->user()->id);
        $tbl->foto = $fileName;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = 0;
        $riwayat->id_admin = Auth::guard('admin')->user()->id;
        $riwayat->keterangan = 'Logo/Gambar Profil diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','');
    }

    //merubaah nik dan nama
    public function ubah_nama(Request $request){
        if($request->nik==Auth::guard('admin')->user()->nik){
            if($request->nama!=Auth::guard('admin')->user()->nama){
                $this->validate( $request, [
                    'nama' => 'required|string',
                ]);
            }
        }else if($request->nama==Auth::guard('admin')->user()->nama){
            $this->validate( $request, [
                'nik'  => 'required|numeric|unique:tbl_admin|max:16'
            ]);
        }else{
            $this->validate( $request, [
                'nama' => 'required|string',
                'nik'  => 'required|numeric|unique:tbl_admin|max:16'
            ]);
        }

        //simpan ke db
        $tbl = AdminModel::find(Auth::guard('admin')->user()->id);
        $tbl->nama = $request->nama;
        $tbl->nik = $request->nik;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = 0;
        $riwayat->id_admin = Auth::guard('admin')->user()->id;
        $riwayat->keterangan = 'Data Profil diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','');
    }

    //ganti password
    public function gantiPassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::guard('admin')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error','Password salah!!!');
        }
        if(strcmp($request->get('current-password'), $request->get('pass')) == 0){
            //Current password and new password are same
            return redirect()->back()->with('error','Pasword baru harus berbeda');
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'pass' => 'required|string|min:6|confirmed'
        ]);
        //Change Password
        $user = AdminModel::find(Auth::guard('admin')->user()->id);
        $user->password = bcrypt($request->get('pass'));
        $user->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = 0;
        $riwayat->id_admin = Auth::guard('admin')->user()->id;
        $riwayat->keterangan = 'Password diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect('/logout');
    }

    //ganti lokasi
    public function gantiLokasi(Request $request){
        $this->validate(  $request,[
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string'
        ]);

        //simpan ke db
        $tbl = AdminModel::find(Auth::guard('admin')->user()->id);
        $tbl->propinsi = $request->provinsi;
        $tbl->kabupaten = $request->kabupaten;
        $tbl->kecamatan = $request->kecamatan;
        $tbl->desa = $request->desa;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = 0;
        $riwayat->id_admin = Auth::guard('admin')->user()->id;
        $riwayat->keterangan = 'Data Lokasi diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','');
    }

    //log admin
    public function logAdmin(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        return view('admin/log_admin',
            [
                'user'=>$user,
            ]
        );
    }

    public function getriwayatAdmin(){
        $data = ModelRiwayat::where('id_admin',Auth::guard('admin')->user()->id)->orderBy('created_at','desc')->paginate(10);
        return Response::json($data);
    }

    //log cabang
    public function logCabang(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        return view('admin/log_cabang',
            [
                'user'=>$user,
            ]
        );
    }

    public function getriwayatCabang(){
        $data = ModelRiwayat::select('tbl_riwayat.*','tbl_cabang.id as id_cab','tbl_cabang.nama_cabang as cabang')->leftJoin('tbl_cabang', function($join){
            $join->on('tbl_riwayat.id_cabang','=','tbl_cabang.id');
        })->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)->orderBy('created_at','desc')->paginate(10);
        return Response::json($data);
    }

    //pembukuan
    public function pembukuan(){
        $user = AdminModel::where('id',Auth::guard('admin')->user()->id)->first();
        $user->lokasi = Indonesia::findVillage($user->desa)->name;
        $cabang = ModelUser::where('id_admin',Auth::guard('admin')->user()->id)->get();
        $batas = \Carbon\Carbon::now('Asia/Jakarta');
        $batas = $batas->month;
        return view('admin/pembukuan',
            [
                'bulan' => $batas,
                'tahun_ini' => \Carbon\Carbon::now('Asia/Jakarta')->year,
                'cabang' => $cabang,
                'tahun_rilis' => 2019,
                'user'=>$user,
            ]
        );
    }

    //get pembukuan
    public function getPembukuan(){
        $id_cabang = Input::get('id');
        $tahun = Input::get('tahun');
        $bulan = Input::get('bulan');
        if($bulan!=null && $bulan>0){
            $data = ModelKeuangan::select('tbl_pembukuan.*')->leftJoin(
                'tbl_cabang', function($join){
                    $join->on('tbl_cabang.id','=','tbl_pembukuan.id_cabang');
                }
            )->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)
            ->where('tbl_pembukuan.id_cabang',$id_cabang)->where(DB::raw('year(tbl_pembukuan.created_at)'),$tahun)->orderBy('tbl_pembukuan.created_at','DESC')
            ->whereMonth('tbl_pembukuan.created_at',$bulan)->paginate(10);
        }else{
            $data = ModelKeuangan::select('tbl_pembukuan.*')->leftJoin(
                'tbl_cabang', function($join){
                    $join->on('tbl_cabang.id','=','tbl_pembukuan.id_cabang');
                }
            )->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)
            ->where('tbl_pembukuan.id_cabang',$id_cabang)->where(DB::raw('year(tbl_pembukuan.created_at)'),$tahun)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(10);
        }
        return Response::json($data);
    }

    public function getDashboardPelangganDaftar(){
        $data = ModelUser::select(DB::raw(
            'UPPER(tbl_cabang.nama_cabang) as nama_cabang,
            (SELECT COUNT(COALESCE(tbl_pelanggan.id,0)) FROM tbl_pelanggan WHERE tbl_pelanggan.id_cabang = tbl_cabang.id) as jml'
            )
        )->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)->get();
        return Response::json($data);
    }

    public function getDashboardDebetKredit(){
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        $cabang = ModelUser::select(DB::raw('nama_cabang'))->where('id',$id_cabang)->get();
        if($bulan!=null && $bulan>0){
            $data = ModelKeuangan::select(DB::raw(
                'COALESCE(SUM(debet),0) as debet, COALESCE(SUM(kredit),0) as kredit, (SELECT tbl_cabang.nama_cabang FROM tbl_cabang WHERE tbl_cabang.id=id_cabang) as cabang'
                )
            )->whereMonth('created_at',$bulan)->where('id_cabang',$id_cabang)->get();
        }else{
            $data = ModelKeuangan::select(DB::raw(
                'COALESCE(SUM(debet),0) as debet, COALESCE(SUM(kredit),0) as kredit, (SELECT tbl_cabang.nama_cabang FROM tbl_cabang WHERE tbl_cabang.id=id_cabang) as cabang'
                )
            )->where('id_cabang',$id_cabang)->get();
        }
        return Response::json($data);
    }

    public function getDashboardSaldo(){
        $data = ModelUser::select(DB::raw(
            'UPPER(tbl_cabang.nama_cabang) as nama_cabang, COALESCE((SELECT tbl_pembukuan.saldo FROM tbl_pembukuan WHERE tbl_pembukuan.id_cabang = tbl_cabang.id ORDER BY tbl_pembukuan.created_at DESC limit 1),0) as jml'
            )
        )->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)->get();
        return Response::json($data);
    }

    public function getDashboardPelangganMeter(){
        $data = ModelUser::select(DB::raw(
            'UPPER(tbl_cabang.nama_cabang) as nama_cabang,
            (SELECT coalesce(SUM(tbl_tagihan.jml_meter),0) 
            FROM tbl_tagihan JOIN tbl_pelanggan on tbl_pelanggan.id =tbl_tagihan.id_pelanggan WHERE tbl_pelanggan.id_cabang = tbl_cabang.id and month(tbl_tagihan.created_at)=month(now())) as jml'
            )
        )->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)->get();
        return Response::json($data);
    }

    public function getDashboardriwayatAdmin(){
        $data = ModelRiwayat::select('tbl_riwayat.*','tbl_cabang.nama_cabang')->leftJoin('tbl_cabang', function($join){
            $join->on('tbl_riwayat.id_cabang','=','tbl_cabang.id');
        })->where('tbl_cabang.id_admin',Auth::guard('admin')->user()->id)->orderBy('tbl_riwayat.created_at','desc')->take(3)->get();
        return Response::json($data);
    }

    public function getDataGrafikPendapatanBulan(){
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        if($bulan != null && $bulan>0){
            $data = ModelKeuangan::select(DB::raw(
                'coalesce(SUM(tbl_pembukuan.debet),0) as debet, coalesce(SUM(tbl_pembukuan.kredit),0) as kredit'
                )
            )->where('id_cabang',$id_cabang)->whereMonth('tbl_pembukuan.created_at',$bulan)->get();
            $tagi= ModelKeuangan::select(DB::raw(
                'coalesce(SUM(tbl_pembukuan.debet),0) as debet'
                )
            )->where('tbl_pembukuan.akses','=',0)->where('id_cabang',$id_cabang)->whereMonth('tbl_pembukuan.created_at',$bulan)->get();
        }else{
            $data = ModelKeuangan::select(DB::raw(
                'coalesce(SUM(tbl_pembukuan.debet),0) as debet, coalesce(SUM(tbl_pembukuan.kredit),0) as kredit'
                )
            )->where('id_cabang',$id_cabang)->whereMonth('tbl_pembukuan.created_at',DB::raw('MONTH(NOW())'))->get();
            $tagi= ModelKeuangan::select(DB::raw(
                'coalesce(SUM(tbl_pembukuan.debet),0) as debet'
                )
            )->where('tbl_pembukuan.akses','=',0)->where('id_cabang',$id_cabang)->whereMonth('tbl_pembukuan.created_at',DB::raw('MONTH(NOW())'))->get();
        }
        return Response::json(['all' => $data, 'tagihan' => $tagi]);
    }

    public function getDataGrafikPendapatanTahun(){
        $id_cabang = Input::get('id');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        $data = ModelKeuangan::select(DB::raw(
            'coalesce(SUM(tbl_pembukuan.debet),0) as debet, coalesce(SUM(tbl_pembukuan.kredit),0) as kredit'
            )
        )->where('id_cabang',$id_cabang)->whereYear('tbl_pembukuan.created_at',DB::raw('YEAR(NOW())'))->get();
        $tagi= ModelKeuangan::select(DB::raw(
            'coalesce(SUM(tbl_pembukuan.debet),0) as debet'
            )
        )->where('tbl_pembukuan.akses','=',0)->where('id_cabang',$id_cabang)->whereYear('tbl_pembukuan.created_at',DB::raw('YEAR(NOW())'))->get();
        return Response::json(['all' => $data, 'tagihan' => $tagi]);
    }

    public function getDataNonTagihan() {
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        if($bulan!=null && $bulan>0){
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.debet as debet, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->whereMonth('tbl_pembukuan.created_at',$bulan)->where('tbl_pembukuan.debet','!=',0)->where('tbl_pembukuan.akses','=',1)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(5);
        }else{
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.debet as debet, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->where('tbl_pembukuan.debet','!=',0)
            ->where('tbl_pembukuan.akses','=',1)->orderBy('tbl_pembukuan.created_at','DESC')
            ->paginate(5);
        }
        return Response::json($data);
    }

    public function getDataTagihan() {
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        if($bulan!=null && $bulan>0){
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.debet as debet, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->where('tbl_pembukuan.debet','!=',0)->where('tbl_pembukuan.akses','=',0)
            ->whereMonth('tbl_pembukuan.created_at',$bulan)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(4);
        }else{
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.debet as debet, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->where('tbl_pembukuan.debet','!=',0)->where('tbl_pembukuan.akses','=',0)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(4);
        }
        return Response::json($data);
    }
    
    public function getDataPengeluaran() {
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        if($bulan!=null && $bulan>0){
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.kredit as kredit, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->where('tbl_pembukuan.kredit','!=',0)
            ->whereMonth('tbl_pembukuan.created_at',$bulan)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(4);
        }else{
            $data = ModelKeuangan::select(DB::raw(
                'tbl_pembukuan.created_at as tgl, tbl_pembukuan.kredit as kredit, tbl_pembukuan.keterangan as ket'
                )
            )->where('tbl_pembukuan.id_cabang',$id_cabang)->where('tbl_pembukuan.kredit','!=',0)->orderBy('tbl_pembukuan.created_at','DESC')->paginate(4);
        }
        return Response::json($data);
    }

    public function getDataavg() {
        $id_cabang = Input::get('id');
        $bulan = Input::get('bulan');
        if($id_cabang==NULL){
            $id_cabang=0;
        }
        if($bulan!=null && $bulan>0){
            $data = ModelTagihan::select(DB::raw(
                'cast(AVG(tbl_tagihan.jml_meter) as decimal(10,2)) as avg'
                )
            )->leftJoin('tbl_pelanggan', function($join){
                $join->on('tbl_tagihan.id_pelanggan','=','tbl_pelanggan.id');
            })->where('tbl_pelanggan.id_cabang',$id_cabang)->whereMonth('tbl_tagihan.created_at',$bulan)->get();
        }else{
            $data = ModelTagihan::select(DB::raw(
                'cast(AVG(tbl_tagihan.jml_meter) as decimal(10,2)) as avg'
                )
            )->leftJoin('tbl_pelanggan', function($join){
                $join->on('tbl_tagihan.id_pelanggan','=','tbl_pelanggan.id');
            })->where('tbl_pelanggan.id_cabang',$id_cabang)->whereMonth('tbl_tagihan.created_at',DB::raw('Month(now())'))->get();
        }
        return Response::json($data);
    }
}
