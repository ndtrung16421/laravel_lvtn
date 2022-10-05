<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VanChuyen_DonHang extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'NguoiNhan_Ten','DonHang_Ma', 'NguoiNhan_DiaChi', 'NguoiNhan_SDT','NguoiNhan_Email','NguoiNhan_GhiChu','NguoiNhan_ThanhToan'
    ];
    protected $primaryKey = 'VanChuyen_id';
 	protected $table = 'tbl_vanchuyen_donhang';
}
