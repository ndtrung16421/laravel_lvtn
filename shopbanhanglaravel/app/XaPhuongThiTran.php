<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XaPhuongThiTran extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'XaPhuong_Ten', 'XaPhuong_Loai', 'QuanHuyen_id'
    ];
    protected $primaryKey = 'XaPhuong_id';
 	protected $table = 'tbl_xaphuongthitran';
}
