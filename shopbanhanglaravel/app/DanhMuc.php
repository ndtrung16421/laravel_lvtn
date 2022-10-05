<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'meta_keywords', 'DanhMuc_Ten', 'DanhMuc_slug','DanhMuc_MoTa','DanhMuc_TrangThai'
    ];
    protected $primaryKey = 'DanhMuc_id';
 	protected $table = 'tbl_DanhMuc';

 	public function SanPham()
    {
        return $this->hasMany('App\SanPham');
    }
}
