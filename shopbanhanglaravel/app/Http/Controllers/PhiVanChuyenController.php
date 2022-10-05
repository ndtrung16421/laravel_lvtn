<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\TinhThanhPho;
use App\QuanHuyen;
use App\XaPhuongThiTran;
use App\PhiVanChuyen;
use Session;
class PhiVanChuyenController extends Controller
{
	public function update_fee(Request $request){
		if (!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
		
		$data2 = array();
        $data2['PhiVanChuyen_Gia'] = $request->fee_number;
        
        DB::table('tbl_phivanchuyen')->where('PhiVanChuyen_id',$request->fee_code)->update($data2);
        Session::put('message','Cập nhật thành công');
        return redirect()->back(); 


	}
	public function delete_fee($fee_code){
		if (!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
		
		
        
        DB::table('tbl_phivanchuyen')->where('PhiVanChuyen_id',$fee_code)->delete();
        Session::put('message','Xóa thành công');
        return redirect()->back(); 


	}
	public function list_delivery(){
		if (!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
		
        $tinh =  DB::table('tbl_tinhthanhpho')->get();
        $quan=  DB::table('tbl_quanhuyen')->get();
        $xa =  DB::table('tbl_xaphuongthitran')->get();

		$list = DB::table('tbl_phivanchuyen')->orderby('PhiVanChuyen_id','asc')->get();

        return view('admin.delivery.danhsach_vanchuyen')->with('list',$list)->with('tinh',$tinh)->with('xa',$xa)->with('quan',$quan);

		
	}
	public function insert_delivery(Request $request){
		if (!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
		$data = $request->all();
		$fee = DB::table('tbl_phivanchuyen')->get();
		$diem = 0;
		foreach ($fee as $key => $value) {
			if ($value->XaPhuong_id== $data['wards']) {
				$diem = 1;
			}
		}
		
			# code...
		if ($diem == 0) {
			# code...
		
		$fee_ship = new PhiVanChuyen();
		
		$fee_ship->XaPhuong_id= $data['wards'];
		$fee_ship->PhiVanChuyen_Gia = $data['fee_ship'];
		$fee_ship->save();
		}

	}
    public function delivery(Request $request){
    	if (!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }

    	$city = db::table('tbl_tinhthanhpho')->get();

    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
    	
    	$data = $request->all();
    	$output='';


    if($data['action']){
    	if($data['action']=="city"){
    			$select_province =db::table('tbl_quanhuyen')->where('TinhThanhPho_id',(int)$data['ma_id'])->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->QuanHuyen_id.'">'.$province->QuanHuyen_Ten.' - '.$province->QuanHuyen_id.'</option>';
    			}

    	}else{

    			$select_wards = db::table('tbl_xaphuongthitran')->where('QuanHuyen_id',(int)$data['ma_id'])->get();
    				$output.='<option>---Chọn Xã Phườngggg---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->XaPhuong_id.'">'.$ward->XaPhuong_Ten.'</option>';
    			}
    			
    		}
    }
    	echo $output;
    	
    }

    public function select_cate(Request $request){
    	
    	$data = $request->all();
    	$output="abc";

    	$select = DB::table('tbl_product')->where('category_id',$data['ma_id'])->orderby('product_id','DESC')->get();

    	$output.='<option selected value ="-1">---Tất cả sản phẩm---</option>';
    			foreach($select as $key => $pro){

    				$output.='<option value="'.$pro->product_id.'">'.$pro->product_name.'</option>';
    			}

    		echo $output;
    }

}
