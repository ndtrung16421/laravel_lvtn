<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

use App\PhiVanChuyen;
use App\VanChuyen_DonHang;
use App\DonHang;
use App\ChiTietDonHang;
use App\KhachHang;
use App\MaGiamGia;
use App\SanPham;





use PDF;

use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\TinhThanhPho;
use App\QuanHuyen;
use App\XaPhuongThiTran;

use App\Slider;



class DonHangController extends Controller
{
	// public function order_code(Request $request ,$order_code){
	// 	$order = DonHang::where('DonHang_Ma',$order_code)->first();
	// 	$order->delete();
	// 	 Session::put('message','Xóa đơn hàng thành công');
 //        return redirect()->back();

	// }
	public function update_qty(Request $request){
		$data = $request->all();
		

		foreach($data['order_product_id'] as $key => $product_id){
				
				$product = SanPham::find($product_id);
				$product_quantity = $product->SanPham_SoLuong;
				$product_sold = $product->SanPham_DaBan;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){

								$order_details = ChiTietDonHang::where('SanPham_id',$product_id)->where('DonHang_Ma',$data['order_code'])->first();

								if ( $order_details->SoLuongBan_CTDH != $qty && ($product_quantity + $order_details->SoLuongBan_CTDH) > $qty && $qty>0) {
									

									
									$order_details->SoLuongBan_CTDH = $qty;
									$order_details->save();

								}

								



						}
				}
		}

	}


	public function search_od_customer(Request $request ) {

		$data = $request->all();

        
        $ord = $data['order_code'];
        
		$customer_id = Session::get('KhachHang_id');
		$customer_order = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->where('DonHang_Ma',$ord)->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->where('DonHang_Ma',$ord)->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->where('tbl_donhang.KhachHang_id',$customer_id)->get();

		


		$slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
		$meta_desc = "Đơn hàng của bạn"; 
        $meta_keywords = "Đơn hàng của bạn";
        $meta_title = "Đơn hàng của bạn";
        $url_canonical = $request->url();

       $cate_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->orderby('ThuongHieu_id','desc')->get(); 


        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 

        $order_status_id=-99;
        $product = DB::table('tbl_SanPham')->get();
        $tbl_rating = DB::table('tbl_DanhGiaSanPham')->get();
        $tbl_coupon = DB::table('tbl_MaGiamGia')->get();
        

		return view('pages.donhang.donhangcuaban')->with('customer_order',$customer_order)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_rating',$tbl_rating)->with('tbl_coupon',$tbl_coupon);

	}

	

	
	public function your_order(Request $request ) {
		$customer_id = Session::get('KhachHang_id');
		$customer_order = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->orderby('DonHang_id','desc')->paginate(10);

		$customer_order_all = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->where('tbl_donhang.KhachHang_id',$customer_id)->get();

		


		$slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
		$meta_desc = "Đơn hàng của bạn"; 
        $meta_keywords = "Đơn hàng của bạn";
        $meta_title = "Đơn hàng của bạn";
        $url_canonical = $request->url();

       $cate_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->orderby('ThuongHieu_id','desc')->get(); 
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 

        $order_status_id=-99;
        $product = DB::table('tbl_SanPham')->get();
        $tbl_rating = DB::table('tbl_DanhGiaSanPham')->get();
        $tbl_coupon = DB::table('tbl_MaGiamGia')->get();
        

		return view('pages.donhang.donhangcuaban')->with('customer_order',$customer_order)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_rating',$tbl_rating)->with('tbl_coupon',$tbl_coupon);

	}
	public function your_order2(Request $request ,$order_status_id) {
		$customer_id = Session::get('KhachHang_id');
		$tbl_rating = DB::table('tbl_DanhGiaSanPham')->get();
		$customer_order = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->where('TrangThaiDonHang_id',$order_status_id)->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->where('KhachHang_id',$customer_id)->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->where('tbl_donhang.KhachHang_id',$customer_id)->where('TrangThaiDonHang_id',$order_status_id)->get();

		$product = DB::table('tbl_SanPham')->get();
		$tbl_coupon = DB::table('tbl_MaGiamGia')->get();

		$slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
		$meta_desc = "Đơn hàng của bạn"; 
        $meta_keywords = "Đơn hàng của bạn";
        $meta_title = "Đơn hàng của bạn";
        $url_canonical = $request->url();

       $cate_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->orderby('ThuongHieu_id','desc')->get(); 
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 


		return view('pages.donhang.donhangcuaban')->with('customer_order',$customer_order)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_rating',$tbl_rating)->with('tbl_coupon',$tbl_coupon);

	}

	public function your_order4(Request $request ,$order_code) {
		$customer_id = Session::get('KhachHang_id');
		$check_ = DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->first();
		if ($check_->KhachHang_id != $customer_id) {
			return Redirect::back();
		}



		$tbl_rating = DB::table('tbl_DanhGiaSanPham')->get();
		$customer_order = DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->where('DonHang_Ma',$order_code)->get();

		$product = DB::table('tbl_SanPham')->get();
		$tbl_coupon = DB::table('tbl_MaGiamGia')->get();

		$slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
		$meta_desc = "Đơn hàng của bạn"; 
        $meta_keywords = "Đơn hàng của bạn";
        $meta_title = "Đơn hàng của bạn";
        $url_canonical = $request->url();

        $order_status_id=-99;

       $cate_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->orderby('ThuongHieu_id','desc')->get(); 
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 


		return view('pages.donhang.donhangcuaban')->with('customer_order',$customer_order)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_rating',$tbl_rating)->with('tbl_coupon',$tbl_coupon);

	}

	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = DonHang::find($data['order_code']);
		$order->TrangThaiDonHang_id = $data['order_status'];
		$order->KhachHangDaXem=0;
		date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->updated_at = now();
        if($order->TrangThaiDonHang_id==8 || $order->TrangThaiDonHang_id==9 || $order->TrangThaiDonHang_id==10){

        	$order->AdminDaXem=0;

        }
		$order->save();
		
		if($order->TrangThaiDonHang_id==2 || $order->TrangThaiDonHang_id==3 || $order->TrangThaiDonHang_id==4 || $order->TrangThaiDonHang_id==5 || $order->TrangThaiDonHang_id==6){

			$name_status = DB::table("tbl_TrangThaiDonHang")->where('TrangThaiDonHang_id', $data['order_status'])->first();

			$data8 = array();
	        $data8['DonHang_Ma'] = $data['order_code'];
	        
	        $data8['admin_id'] = Auth::user()->admin_id;
	        $data8['NoiDung'] = $name_status->TrangThaiDonHang_Ten;
	        $data8['ThoiGianTao'] = now();
	        DB::table('tbl_lichsucapnhatdh')->insert($data8);

		}
        	
		
		if($order->TrangThaiDonHang_id==7 || $order->TrangThaiDonHang_id==6){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = SanPham::find($product_id);
				$product_quantity = $product->SanPham_SoLuong;
				$product_sold = $product->SanPham_DaBan;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->SanPham_SoLuong = $pro_remain;
								$product->SanPham_DaBan = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}


	}
	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = ChiTietDonHangwhere('DonHang_Ma',$checkout_code)->get();
		$order = DonHang::where('DonHang_Ma',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->KhachHang_id;
			$shipping_id = $ord->VanChuyen_id;
		}
		$customer = KhachHang::where('KhachHang_id',$customer_id)->first();
		$shipping = VanChuyen_DonHang::where('VanChuyen_id',$shipping_id)->first();

		$order_details_product = ChiTietDonHang::with('SanPham')->where('DonHang_Ma', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order->MaGiamGia_Ma;
		}
		if($product_coupon != null){
			$coupon =MaGiamGia::where('MaGiamGia_Ma',$product_coupon)->first();

		$coupon_condition = $coupon->MaGiamGia_Loai;
		$coupon_number = $coupon->MaGiamGia_GiaTri;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->KhachHang_Ten.'</td>
						<td>'.$customer->KhachHang_SDT.'</td>
						<td>'.$customer->KhachHang_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->NguoiNhan_Ten.'</td>
						<td>'.$shipping->NguoiNhan_DiaChi.'</td>
						<td>'.$shipping->NguoiNhan_SDT.'</td>
						<td>'.$shipping->NguoiNhan_email.'</td>
						<td>'.$shipping->NguoiNhan_GhiChu.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->SoLuongBan_CTDH;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không mã';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
						<td>'.$product->SoLuongBan_CTDH.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'</p>
					<p>Phí ship: '.number_format($product->product_feeship,0,',','.').'đ'.'</p>
					<p>Thanh toán : '.number_format($total_coupon + $product->product_feeship,0,',','.').'đ'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
	public function view_order2($order_code){
		$order99 = DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->first();
		$id = Session::get('KhachHang_id');
		if ($id != $order99->KhachHang_id) {
			return Redirect::back();
		}

		$order_status2 = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','desc')->get();
		$order_details = ChiTietDonHang::with('SanPham')->where('DonHang_Ma',$order_code)->get();
		$order = DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->first();

		

		
			$customer_id = $order->KhachHang_id;
			$shipping_id = $order->VanChuyen_id;
			$order_status = $order->TrangThaiDonHang_id;
		


		$data5 = array();
        
        $data5['KhachHangDaXem'] = 1;
        DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->update($data5);
		
		
		


		$cate_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->orderby('ThuongHieu_id','desc')->get();

		$slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
		$meta_desc = "abc"; 
        $meta_keywords = "abc";
        $meta_title = "abc";
        $url_canonical = "";
		$customer = KhachHang::where('KhachHang_id',$customer_id)->first();
		$shipping = VanChuyen_DonHang::where('VanChuyen_id',$shipping_id)->first();

		$order_details_product = ChiTietDonHang::with('SanPham')->where('DonHang_Ma', $order_code)->get();

		
		$product = DB::table('tbl_SanPham')->get();
		$lichsu = DB::table('tbl_lichsucapnhatdh')->where('DonHang_Ma',$order_code)->orderby('ThoiGianTao','desc')->get();
		
		return view('pages.donhang.view-order-customer')->with(compact('order_details','customer','shipping','order_details','order','order_status'))->with('order_status2',$order_status2)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product)->with('product',$product)->with('lichsu',$lichsu);

	}




	public function view_order($order_code){
		if (!Auth::user()->hasAnyRoles(['order','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }

		$order_status2 = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','desc')->get();
		$order_details = ChiTietDonHang::with('SanPham')->where('DonHang_Ma',$order_code)->get();
		$order = DonHang::where('DonHang_Ma',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->KhachHang_id;
			$shipping_id = $ord->VanChuyen_id;
			$order_status = $ord->TrangThaiDonHang_id;
		}
		

		$data5['viewed'] = 1;
        DB::table('tbl_DonHang')->where('DonHang_Ma',$order_code)->update($data5);
		$customer = KhachHang::where('KhachHang_id',$customer_id)->first();
		$shipping = VanChuyen_DonHang::where('VanChuyen_id',$shipping_id)->first();

		$order_details_product = ChiTietDonHang::with('SanPham')->where('DonHang_Ma', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon =MaGiamGia::where('MaGiamGia_Ma',$product_coupon)->first();
			$coupon_condition = $coupon->MaGiamGia_Loai;
			$coupon_number = $coupon->MaGiamGia_GiaTri;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'))->with('order_status2',$order_status2);

	}
    public function manage_order($order_status_id){
    	if (!Auth::user()->hasAnyRoles(['order','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }

    	$customer_order = DB::table('tbl_DonHang')->where('TrangThaiDonHang_id',$order_status_id)->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->get();

		$ship = DB::table('tbl_VanChuyen_DonHang')->get();


		$tbl_coupon = DB::table('tbl_MaGiamGia')->get();

       
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 

        
        $product = DB::table('tbl_SanPham')->get();

		return view('admin.manage_order')->with('customer_order',$customer_order)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_coupon',$tbl_coupon);;
    }
     public function manage_order2(){
    	if (!Auth::user()->hasAnyRoles(['order','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
		$customer_order = DB::table('tbl_DonHang')->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->get();

		

		$tbl_coupon = DB::table('tbl_MaGiamGia')->get();
	

       
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 

        $order_status_id=-99;
        $product = DB::table('tbl_SanPham')->get();

		return view('admin.manage_order')->with('customer_order',$customer_order)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_coupon',$tbl_coupon);
    }

    public function search_od(Request $request){
    	if (!Auth::user()->hasAnyRoles(['order','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
        $data = $request->all();

        
        $ord = $data['order_code'];
        


		$customer_order = DB::table('tbl_DonHang')->where('DonHang_Ma',$ord)->orderby('DonHang_id','desc')->paginate(10);
		$customer_order_all = DB::table('tbl_DonHang')->where('DonHang_Ma',$ord)->get();

		$customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_chitietdonhang.DonHang_Ma','=','tbl_donhang.DonHang_Ma')->get();

		

		$tbl_coupon = DB::table('tbl_MaGiamGia')->get();
	

       
        $order_status = DB::table('tbl_TrangThaiDonHang')->orderby('TrangThaiDonHang_id','asc')->get(); 

        $order_status_id=-99;
        $product = DB::table('tbl_SanPham')->get();

		return view('admin.manage_order')->with('customer_order',$customer_order)->with('customer_order_detail',$customer_order_detail)->with('order_status',$order_status)->with('order_status_id',$order_status_id)->with('product',$product)->with('customer_order_all',$customer_order_all)->with('tbl_coupon',$tbl_coupon);;
    }
}
