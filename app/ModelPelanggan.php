<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPelanggan extends Model
{
    //
    protected $fillable = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'id_cabang'];

    public $primaryKey = 'id';
    
    protected $table = 'tbl_pelanggan';
}
