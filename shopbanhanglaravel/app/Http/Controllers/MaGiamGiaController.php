<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\MaGiamGia;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use DB;

class MaGiamGiaController extends Controller
{
	public function unset_coupon(){
        
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            
            foreach(Session::get('coupon') as $key => $cou) {
            $coupon = MaGiamGia::where('MaGiamGia_Ma',$cou['coupon_code'])->first();
            $x = $coupon->MaGiamGia_SoLan +1;
                $coupon->MaGiamGia_SoLan = $x;
                
                $coupon->save();
            }
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    public function insert_coupon(){
        if (!Auth::user()->hasAnyRoles(['coupon','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
    	return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
        if (!Auth::user()->hasAnyRoles(['admin'])) {
            return Redirect::to('dashboard');
        }
    	$coupon = MaGiamGia::find($coupon_id);
        $coupon->MaGiamGia_SoLan = 0;
    	$coupon->update();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function update_coupon2(Request $request){
        if (!Auth::user()->hasAnyRoles(['admin'])) {
            return Redirect::to('dashboard');
        }
        $coupon = MaGiamGia::find($request->coupon_code);
        $coupon->MaGiamGia_SoLan = $request->coupon_time;
        $coupon->MaGiamGia_Ten = $request->coupon_name;
        $coupon->MaGiamGia_Loai = $request->coupon_condition;
        $coupon->MaGiamGia_GiaTri = $request->coupon_number;
        $coupon->update();
        Session::put('message','Cập nhật thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
        if (!Auth::user()->hasAnyRoles(['coupon','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
    	$coupon = DB::table('tbl_MaGiamGia')->orderby('MaGiamGia_Ma','DESC')->paginate(9);
    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }


    public function update_coupon($coupon_id){
        if (!Auth::user()->hasAnyRoles(['coupon','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        $coupon = DB::table('tbl_MaGiamGia')->where('MaGiamGia_Ma',$coupon_id)->first();
        return view('admin.coupon.capnhat_magiamgia')->with(compact('coupon'));
    }

    public function insert_coupon_code(Request $request){
        if (!Auth::user()->hasAnyRoles(['coupon','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
    	$data = $request->all();

        $check = MaGiamGia::where('MaGiamGia_Ma',$data['coupon_code'])->first();
        if ($check) {
            Session::put('message','Mã giảm giá không được trùng tên');
            return Redirect::to('insert-coupon');
        }

    	$coupon = new MaGiamGia;

    	$coupon->MaGiamGia_Ten = $data['coupon_name'];
    	$coupon->MaGiamGia_GiaTri = $data['coupon_number'];
    	$coupon->MaGiamGia_Ma = $data['coupon_code'];
    	$coupon->MaGiamGia_SoLan = $data['coupon_time'];
    	$coupon->MaGiamGia_Loai = $data['coupon_condition'];
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');


    }
}
