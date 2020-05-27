<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTagihan extends Model
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
    protected $hidden = [];

    public $primaryKey = 'id';
    
    protected $table = 'tbl_tagihan';
}
