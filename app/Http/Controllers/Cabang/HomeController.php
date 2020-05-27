<?php

namespace App\Http\Controllers\Cabang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\ModelUser;
use App\AdminModel;
use App\ModelRiwayat;
use App\ModelPelanggan;
use Auth;
use File;
use Image;
use Hash;
use Indonesia;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    protected $redirectTo = '/login';

    public $path;
    public $dimensions;

    public function __construct(){
        // pengecekan apakan user atau bukan
        $this->middleware('cek_user');

        //set dimesi gambar
        //DEFINISIKAN PATH
        $this->path = storage_path('app\public\cabang\pic');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['100'];
    }

    public function index(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $pelanggan = ModelPelanggan::select(DB::raw('count(id) as jml'))->where('id_cabang',Auth::user()->id)->first();
        return view('cabang/home',
        [
            'jml' => $pelanggan->jml,
            'user' => $user,
        ]);
    }

    public function profile(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/profil',
        [
            'user' => $user,
        ]);
    }

    //uabah gambar logo
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
        $fileName = Carbon::now()->timestamp . '_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
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
            File::delete($this->path . '/' . $row . '/' . Auth::user()->logo);
        }
        
        //SIMPAN DATA IMAGE YANG TELAH DI-UPLOAD
        $tbl = ModelUser::find(Auth::user()->id);
        $tbl->logo = $fileName;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Gambar Profil diubah';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','Status: Berhasil');
    }

    //get pic
    public function getPic(){
        return Image::make(storage_path('app\\public\\cabang\\pic\\100\\'.Auth::user()->logo))->response();
    }

    //get pic to invoice
    public function getPicprint(){
        return Image::make(storage_path('app\\public\\cabang\\logo_default_dark.png'))->response();
    }

    //ganti password
    public function gantiPassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
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
        $user = ModelUser::find(Auth::user()->id);
        $user->password = bcrypt($request->get('pass'));
        $user->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Password diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect('/logout')->with('succes','Password diubah, silahkan Login ulang');
    }

    //ubah data cabang
    public function ubahData(Request $request){
        if($request->nama_cabang==Auth::user()->nama_cabang){
            if($request->no_tlp==Auth::user()->no_tlp){
                $this->validate($request ,[
                    'alamat' => 'required|string|max:50',
                ]);
            }else{
                $this->validate($request ,[
                    'alamat' => 'required|string|max:50',
                    'no_tlp' => 'numeric|required|min:10|unique:tbl_cabang',
                ]);
            }
        }else if($request->no_tlp==Auth::user()->no_tlp){
            $this->validate($request ,[
                'alamat' => 'required|string|max:50',
                'nama_cabang' => 'required|string|min:5|unique:tbl_cabang',
            ]);
        }else{
            $this->validate($request ,[
                'nama_cabang' => 'required|string|min:5|unique:tbl_cabang',
                'alamat' => 'required|string|max:50',
                'no_tlp' => 'numeric|required|min:10|unique:tbl_cabang',
            ]);
        }

        //simpan ke db
        $tbl = ModelUser::find(Auth::user()->id);
        $tbl->nama_cabang = $request->nama_cabang;
        $tbl->alamat = $request->alamat;
        $tbl->no_tlp = $request->no_tlp;
        $tbl->save();
        //riwayat
        $riwayat = new ModelRiwayat;
        $riwayat->id_cabang = Auth::user()->id;
        $riwayat->id_admin = 0;
        $riwayat->keterangan = 'Data Profil diperbarui';
        $riwayat->tipe = 1;
        $riwayat->save();
        return redirect()->back()->with('success','Status: Berhasil');
    }

    //riwayat
    public function riwayatTagihan(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/riwayattagihan',
        [
            'user' => $user,
        ]);
    }

    //get riwayat sistem
    public function getriwayatTagihan(){
        $data = ModelRiwayat::where('id_cabang',Auth::user()->id)->where('tipe',0)->orderBy('created_at','desc')->paginate(10);
        return Response::json($data);
    }

    //riwayat
    public function riwayatSistem(){
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        return view('cabang/riwayatsistem',
        [
            'user' => $user,
        ]);
    }

    //get riwayat sistem
    public function getriwayatSistem(){
        $data = ModelRiwayat::where('id_cabang',Auth::user()->id)->where('tipe',1)->orderBy('created_at','desc')->paginate(10);
        return Response::json($data);
    }

    // get tagihan dashboard
    public function getTagihandashboard(){
        $data = ModelPelanggan::select('tbl_pelanggan.nama','tbl_pelanggan.nama',DB::raw('(SELECT count(tbl_tagihan.id) from tbl_tagihan where tbl_tagihan.lunas=0 and tbl_tagihan.id_pelanggan=tbl_pelanggan.id) as jml'))->where('id_cabang',Auth::user()->id)->take(5)->orderBy('jml','DESC')->get();
        return Response::json($data);
    }

    // get meter dashboard
    public function getMeterdashboard(){
        $data = ModelPelanggan::select('tbl_pelanggan.nama','tbl_pelanggan.nama',DB::raw('(SELECT SUM(tbl_tagihan.jml_meter) from tbl_tagihan where month(tbl_tagihan.created_at)=month(now()) and tbl_tagihan.id_pelanggan=tbl_pelanggan.id) as jml'))->where('id_cabang',Auth::user()->id)->take(5)->orderBy('jml','DESC')->get();
        return Response::json($data);
    }
}
