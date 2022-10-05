<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'admin_email',  'admin_MatKhau',  'admin_Ten','admin_SDT'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';
 	
 	
}
