<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'KhachHang_id', 'VanChuyen_id', 'DonHang_TrangThai','DonHang_id','created_at'
    ];
    protected $primaryKey = 'DonHang_Ma';
 	protected $table = 'tbl_donhang';

 
}
