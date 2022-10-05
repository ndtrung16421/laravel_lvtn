<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'DonHang_Ma', 'SanPham_id', 'SanPham_Ten_CTDH','DonGia_CTDH','SoLuongBan_CTDH','MaGiamGia_CTDH','PhiVanChuyen_CTDH'
    ];
    protected $primaryKey = 'ChiTietDonHang_id';
 	protected $table = 'tbl_chitietdonhang';

 	public function SanPham(){
 		return $this->belongsTo('App\SanPham','SanPham_id');
 	}
}
