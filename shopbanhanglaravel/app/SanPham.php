<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'SanPham_Ten', 'SanPham_slug','DanhMuc_id','ThuongHieu_id','SanPham_MoTa','SanPham_NoiDung','SanPham_Gia','SanPham_AnhChinh','SanPham_TrangThai','SanPham_SoLuong','SanPham_DaBan'
    ];
    protected $primaryKey = 'SanPham_id';
 	protected $table = 'tbl_SanPham';

 	public function ThuongHieu()
    {
        return $this->belongsTo('App\ThuongHieu');
    }
    public function DanhMuc()
    {
        return $this->belongsTo('App\DanhMuc');
    }
}
