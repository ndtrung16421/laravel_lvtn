<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_Ten','admin_SDT'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function VaiTro(){
 		return $this->belongsToMany('App\VaiTro');
 	}
 	public function getAuthPassword(){
 		return $this->admin_password;
 	}
 	public function hasAnyRoles($roles){
 		return null !== $this->VaiTro()->whereIn('VaiTro_Ten',$roles)->first();
 		// if(is_array($roles)){
 		// 	foreach($roles as $role){
 		// 		if($this->hasRole($role)){
 		// 			return true;
 		// 		}
 		// 	}
 		// }else{
 		// 	if($this->hasRole($roles)){
 		// 		return true;
 		// 	}
 		// }
 		// return false;
 	}
 	public function hasRole($role){
 		return null!== $this->VaiTro()->where('VaiTro_Ten',$role)->first();
 		// if($this->roles()->where('name',$role)->first()){
 		// 	return true;
 		// }
 		// return false;
 	}
 	
}
