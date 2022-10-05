<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'KhachHang_Ten', 'KhachHang_Email', 'KhachHang_MatKhau','KhachHang_SDT'
    ];
    protected $primaryKey = 'KhachHang_id';
 	protected $table = 'tbl_khachhang';
}
