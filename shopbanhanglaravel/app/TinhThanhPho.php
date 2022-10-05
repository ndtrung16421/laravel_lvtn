<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinhThanhPho extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'TinhThanhPho_Ten', 'TinhThanhPho_Loai'
    ];
    protected $primaryKey = 'TinhThanhPho_id';
 	protected $table = 'tbl_tinhthanhpho';
}
