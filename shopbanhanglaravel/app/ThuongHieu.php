<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ThuongHieu_Ten', 'ThuongHieu_slug', 'ThuongHieu_MoTa','ThuongHieu_TrangThai'
    ];
    protected $primaryKey = 'ThuongHieu_id';
 	protected $table = 'tbl_ThuongHieu';

 	public function SanPham()
    {
        return $this->hasMany('App\SanPham');
    }

}
