<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'MaGiamGia_Ten', 'MaGiamGia_id', 'MaGiamGia_SoLan','MaGiamGia_GiaTri', 'MaGiamGia_Loai'
    ];
    protected $primaryKey = 'MaGiamGia_Ma';
 	protected $table = 'tbl_MaGiamGia';
}
