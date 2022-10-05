<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'QuanHuyen_Ten', 'QuanHuyen_Loai', 'TinhThanhPho_id'
    ];
    protected $primaryKey = 'QuanHuyen_id';
 	protected $table = 'tbl_quanhuyen';
}
