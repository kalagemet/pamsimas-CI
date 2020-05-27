<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Indonesia;
use App\ModelUser;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class PublicController extends Controller
{
    //
    //get_kab
    public function get_kab(){
        $id = Input::get('state_id');
        $kab = Indonesia::findProvince($id, ['cities']);
        return Response::json($kab);
    }

    //get_kec
    public function get_kec(){
        $id = Input::get('kab_id');
        $kec = Indonesia::findCity($id, ['districts']);
        return Response::json($kec);
    }

    //get_desa
    public function get_desa(){
        $id = Input::get('kec_id');
        $des = Indonesia::findDistrict($id, ['villages']);
        return Response::json($des);
    }

    //get nama
    public function getNama(){
        $id = Input::get('id');
        $nama = null;
        if(strlen($id)==4){
            $nama = Indonesia::findCity($id);
        }
        if(strlen($id)==7){
            $nama = Indonesia::findDistrict($id);
        }
        if(strlen($id)==10){
            $nama = Indonesia::findVillage($id);
        }
        return Response::json($nama);
    }

    //get pic
    public function getPic(){
        $foto = Input::get('id_cab');
        if($foto==null){
            return null;
        }
        $foto = ModelUser::find($foto);
        return Image::make(storage_path('app\\public\\cabang\\pic\\100\\'.$foto->logo))->response();
    }
}
