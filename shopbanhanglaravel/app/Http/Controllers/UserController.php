<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\VaiTro;
use App\Admin;
use Session;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (!Auth::user()->hasAnyRoles(['author','admin'])) {
            return Redirect::to('dashboard');
        }
        
        $admin = Admin::with('VaiTro')->orderBy('admin_id','DESC')->paginate(10);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function add_users(){
        if (!Auth::user()->hasAnyRoles(['author','admin'])) {
            return Redirect::to('dashboard');
        }
        return view('admin.users.add_users');
    }
    public function assign_roles(Request $request){
        if (!Auth::user()->hasAnyRoles(['author','admin'])) {
            return Redirect::to('dashboard');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->VaiTro()->detach();
        if($request['admin_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','admin')->first());     
        }
        if($request['author_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','author')->first());     
        }
        if($request['statistical_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','statistical')->first());     
        }
        if($request['slider_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','slider')->first());     
        }
        if($request['order_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','order')->first());     
        }
        if($request['coupon_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','coupon')->first());     
        }

        if($request['delivery_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','delivery')->first());     
        }
        
        if($request['product_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','product')->first());     
        }
        if($request['add_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','add')->first());     
        }
        if($request['update_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','update')->first());     
        }
        if($request['view_role']){
           $user->VaiTro()->attach(VaiTro::where('VaiTro_Ten','view')->first());     
        }
        return redirect()->back();
    }
    public function store_users(Request $request){
        if (!Auth::user()->hasAnyRoles(['author','admin'])) {
            return Redirect::to('dashboard');
        }
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_Ten = $data['admin_name'];
        $admin->admin_SDT = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        // $admin->roles()->attach(VaiTro::where('VaiTro_Ten','user')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
