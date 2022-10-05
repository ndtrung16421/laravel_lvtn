<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VaiTro;
use App\Admin;
use Auth;
class AuthController extends Controller
{
    public function register_auth(){
        
    }
    public function logout_auth(){
    	Auth::logout();
    	return view('admin.custom_auth.login_auth');
    }
    public function login_auth(){
    	return view('admin.custom_auth.login_auth');
    }
    public function login( Request $request){
    	$data = $request->all();
    	if(Auth::attempt(['admin_email'=> $request->admin_email,'admin_password'=> $request->admin_password])){

    		return redirect('/dashboard');
    	}else{
    		return redirect('/login-auth')->with('message','Nhập sai tài khoản hoặc mật khẩu');
    	}
    }
}
