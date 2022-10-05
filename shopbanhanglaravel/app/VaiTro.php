<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'VaiTro_Ten'
    ];
    protected $primaryKey = 'VaiTro_id';
 	protected $table = 'tbl_VaiTro';

 	public function admin(){
 		return $this->belongsToMany('App\Admin');
 	}
}
