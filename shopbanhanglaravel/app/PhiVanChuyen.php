<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhiVanChuyen extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'XaPhuong_id','PhiVanChuyen_Gia'
    ];
    protected $primaryKey = 'PhiVanChuyen_id';
 	protected $table = 'tbl_PhiVanChuyen';

 	
 	public function XaPhuongThiTran(){
 		return $this->belongsTo('App\XaPhuongThiTran', 'XaPhuong_id');
 	}
}
