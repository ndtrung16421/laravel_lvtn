<?php


namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\TinhThanhPho;
use App\QuanHuyen;
use App\XaPhuongThiTran;
use App\PhiVanChuyen;
use App\Slider;
use App\VanChuyen_DonHang;
use App\DonHang;
use App\ChiTietDonHang;
use App\KhachHang;






class ThanhToanController extends Controller
{   
    
    
    public function confirm_order(Request $request){
         $data = $request->all();
         $checkout_code = substr(md5(microtime()),rand(0,26),5);
         
        

         $shipping = new VanChuyen_DonHang();
         $shipping->DonHang_Ma = null;
         $shipping->NguoiNhan_Ten = $data['shipping_name'];
         $shipping->NguoiNhan_email = $data['shipping_email'];
         $shipping->NguoiNhan_SDT = $data['shipping_phone'];
         $shipping->NguoiNhan_DiaChi = $data['shipping_address'];
         $shipping->NguoiNhan_GhiChu = $data['shipping_notes'];
         
         $shipping->save();

         $shipping_id = $shipping->VanChuyen_id;


         



         

  
         $order = new DonHang;
         $order->KhachHang_id = Session::get('KhachHang_id');
         $order->VanChuyen_id= $shipping_id;
         $order->TrangThaiDonHang_id = 1;
         $order->DonHang_Ma = $checkout_code;
         $order->PhuongThucThanhToan = $data['shipping_method'];
         $order->KhachHangDaXem=0;
         $order->AdminDaXem=0;
         $order->DonHang_PhiVanChuyen = $data['order_fee'];
         $order->TongTien = $data['total'];
        if ($data['order_coupon'] == 'no') {
             # code...
         
         $order->MaGiamGia_Ma =null;
        }else{
            $order->MaGiamGia_Ma =$data['order_coupon'];
        }
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->ThoiGianTao = now();
         $order->NgayTao = date('y-m-d');
         $order->save();

         $order_c = $order->DonHang_Ma;
         $data99 = array();
        $data99['DonHang_Ma'] = $checkout_code;
       
        DB::table('tbl_vanchuyen_donhang')->where('VanChuyen_id',$shipping_id)->update($data99);

     
         # code...
     

         
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new ChiTietDonHang;
                $order_details->DonHang_Ma = $checkout_code;
                $order_details->SanPham_id = $cart['product_id'];
                $order_details->SanPham_Ten_CTDH= $cart['product_name'];
                $order_details->DonGia_CTDH = $cart['product_price'];
                $order_details->SoLuongBan_CTDH = $cart['product_qty'];
                $order_details->MaGiamGia_CTDH =  $data['order_coupon'];
                
                $order_details->NgayTao = date('y-m-d');
                $order_details->save();

            }
            
                


            
            
         
         Session::forget('coupon');
         
         Session::forget('cart');
         return Redirect::to('/your-order');
     
    }
    
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    
}
     public function AuthLogin(){
        $customer_id = Session::get('KhachHang_id');
        if($customer_id){
            return Redirect::to('pages.profile');
        }else{
            return Redirect::to('pages.thanhtoan.dangnhap_thanhtoan')->send();
        }
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('XaPhuong_id',$data['Xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        // $tp = $data['ma_id'] + 0;
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                
                $select_province =  DB::table('tbl_quanhuyen')->where('TinhThanhPho_id',(int)$data['ma_id'])->get();

                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->QuanHuyen_id.'">'.$province->QuanHuyen_Ten.' -- '.$province->QuanHuyen_id.'</option>';
                }

            }else{

                // $select_wards = Wards::where('QuanHuyen_id',$data['ma_id'])->orderby('XaPhuong_id','ASC')->get();
                $select_wards =  DB::table('tbl_xaphuongthitran')->where('QuanHuyen_id',(int)$data['ma_id'])->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->XaPhuong_id.'">'.$ward->XaPhuong_Ten.'-'.$ward->XaPhuong_id.'</option>';
                }
            }
            echo $output;
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(8)->get();

        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 

    	

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

    	return view('pages.thanhtoan.dangnhap_thanhtoan')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }

    public function register (Request $request){

       $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
       

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        $city = DB::table('tbl_tinhthanhpho')->get();
         $quan = DB::table('tbl_quanhuyen')->get();
        $xa  = DB::table('tbl_xaphuongthitran')->get();

        return view('pages.register')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider)->with('quan',$quan)->with('xa',$xa);
    }


    public function add_customer(Request $request){

    	$data = array();
    	$data['KhachHang_Ten'] = $request->KhachHang_Ten;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);


        

        $tbl_customers = DB::table('tbl_khachhang')->get();
         $i=0;
         $output = '';
         foreach ($tbl_customers as $key => $tc) {
             if ($tc->customer_email == $data['customer_email']) {
                 $i=1;
             }
         }

         if ($i==0) {
             # code...
         

            $get_image = $request->file('KhachHang_Anh');
        
            
        
        
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/profile',$new_image);
            $data['customer_image'] = $new_image;

            $customer_id = DB::table('tbl_khachhang')->insertGetId($data);

            $data2 = array();
            $data2['KhachHang_id'] = $customer_id;
            
            $data2['XaPhuong_id'] = $request['wards'];
            $data2['DiaChi_Ten'] = $request['customer_address'];

            DB::table('tbl_DiaChi')->insert($data2);

            $data3 = array();
            $address_cus = DB::table('tbl_DiaChi')->where('KhachHang_id',$customer_id)->orderBy('DiaChi_id','DESC')->first();



        $data3['DiaChi_id'] = $address_cus->DiaChi_id;
        DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->update($data3);



            session::put('add_customer','Tạo thành công');
            
             return Redirect::to('/dang-nhap');
        }
        else{
            return Redirect::to('/dang-ky');
        }

       


    }

    public function add_address(Request $request){
        
        $data = $request->all();
        $customer_id = Session::get('KhachHang_id');
        
        
        $data2 = array();
        $data2['KhachHang_id'] = $customer_id;
        
        $data2['XaPhuong_id'] = $data['wards'];
        $data2['DiaChi_Ten'] = $data['customer_address'];

        DB::table('tbl_DiaChi')->insert($data2);

        $data3 = array();
        $address_cus = DB::table('tbl_DiaChi')->where('KhachHang_id',$customer_id)->orderBy('DiaChi_id','DESC')->first();



        $data3['DiaChi_id'] = $address_cus->DiaChi_id;
        DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->update($data3);



        
       
        

        if($data['city']){
            $feeship = PhiVanChuyen::where('XaPhuong_id',$data['wards'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }



        Session::put('message','Thêm thành công, địa chỉ mới đã được áp dụng');
        return Redirect::back();
    }


    public function choose_address($address_id){
        
        
        $customer_id = Session::get('KhachHang_id');
        $tbl_customers = DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->first();
        $tbl_address = DB::table('tbl_DiaChi')->where('DiaChi_id',$address_id)->first();
        if ($customer_id != $tbl_address->KhachHang_id  ) {
            Session::put('error','Lỗi');
            return Redirect::back();
        }

        if ($tbl_customers->DiaChi_id == $address_id ) {
            Session::put('message','Lỗi, bạn đang dùng địa chỉ này');
            return Redirect::back();
        }
        
        $data3 = array();
        $data3['DiaChi_id'] = $address_id;
        DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->update($data3);





        Session::put('message','Lưu thành công');
        return Redirect::back();
    }

    public function del_address($address_id){
        
        
        $customer_id = Session::get('KhachHang_id');

        $tbl_customers = DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->first();
        $tbl_address = DB::table('tbl_DiaChi')->where('DiaChi_id',$address_id)->first();
        if ($customer_id != $tbl_address->KhachHang_id) {
            Session::put('error','Lỗi');
            return Redirect::back();
        }
        if ($tbl_customers->DiaChi_id == $address_id ) {
            Session::put('error','Lỗi, bạn đang dùng địa chỉ này');
            return Redirect::back();
        }
        
       
        DB::table('tbl_DiaChi')->where('DiaChi_id',$address_id)->delete();





        Session::put('message','Xóa thành công');
        return Redirect::back();
    }


    public function save_customer2(Request $request){
        
        $data = $request->all();
        $customer_id = Session::get('KhachHang_id');
        $customer = customer::find($customer_id);
        
        $customer->customer_phone = $data['customer_phone'];
        // $customer->customer_address = $data['customer_address'];

        // $customer->matp = $data['city'];
        // $customer->QuanHuyen_id = $data['province'];
        // $customer->XaPhuong_id = $data['wards'];

        $customer->save();

        $data2 = array();
        
        $data2['XaPhuong_id'] =$data['wards'];
        $data2['DiaChi_Ten'] = $data['customer_address'];
        
        DB::table('tbl_DiaChi')->where('DiaChi_id', $data['address_id'])->update($data2);
       
        

        if($data['city']){
            $feeship = PhiVanChuyen::where('XaPhuong_id',$address_info->XaPhuong_id)->get();
       
      
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->PhiVanChuyen_Gia);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }



        Session::put('message','Lưu thành công');
        return Redirect::to('/checkout');
    }
    public function save_customer(Request $request){
        
        $data = $request->all();
        $customer_id = Session::get('KhachHang_id');
        $customer = customer::find($customer_id);
        $customer->KhachHang_Ten = $data['KhachHang_Ten'];
        $customer->customer_phone = $data['customer_phone'];
        

       
        $data2 = array();
       
        $data2['XaPhuong_id'] =$data['wards'];
        $data2['DiaChi_Ten'] = $data['customer_address'];
        
        DB::table('tbl_DiaChi')->where('DiaChi_id', $data['address_id'])->update($data2);


        if ($request->file('KhachHang_Anh')){
            
        
            $get_image = $request->file('KhachHang_Anh');
        
            
        
        
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/profile',$new_image);
            $data['customer_image'] = $new_image;

        $customer->KhachHang_Anh = $data['customer_image'];
        }

        $customer->save();

        
         Session::put('KhachHang_Ten',$customer->KhachHang_Ten);
        Session::put('KhachHang_Anh',$customer->KhachHang_Anh);
       

       if($data['city']){
            $feeship = PhiVanChuyen::where('XaPhuong_id',$address_info->XaPhuong_id)->get();
       
      
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->PhiVanChuyen_Gia);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }
        
        Session::put('message','Lưu thành công');
        return Redirect::to('/thong-tin-ca-nhan');
    }



    public function checkout(Request $request){
        $customer_id = Session::get('KhachHang_id');
        if(!$customer_id){
            return Redirect::to('/dang-nhap');
        }
         //seo 
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        $customer_id = Session::get('KhachHang_id');
        $customer_info = DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->first();

    	$cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        $city = DB::table('tbl_tinhthanhpho')->get();
         $quan = DB::table('tbl_quanhuyen')->get();
        $xa  = DB::table('tbl_xaphuongthitran')->get();

       
        $profile = DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->first();

        $address_info = DB::table('tbl_DiaChi')->where('DiaChi_id',$profile->DiaChi_id)->first();

        $xa_info  = DB::table('tbl_xaphuongthitran')->where('XaPhuong_id',$address_info->XaPhuong_id)->first();

        $huyen_info = DB::table('tbl_quanhuyen')->where('QuanHuyen_id',(int)$xa_info->QuanHuyen_id)->first();

        $tinh_info = DB::table('tbl_tinhthanhpho')->where('TinhThanhPho_id',(int)$huyen_info->TinhThanhPho_id)->first();


        $address_change = DB::table('tbl_DiaChi')->where('KhachHang_id',$customer_id)->get();

        $feeship = PhiVanChuyen::where('XaPhuong_id',$address_info->XaPhuong_id)->get();
       
      
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->PhiVanChuyen_Gia);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
                  
            
        

    	return view('pages.thanhtoan.hienthi_thanhtoan')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider)->with('customer_info',$customer_info)->with('quan',$quan)->with('xa',$xa)->with('profile',$profile)->with('address_info',$address_info)->with('address_change',$address_change)->with('xa_info',$xa_info)->with('huyen_info',$huyen_info)->with('tinh_info',$tinh_info);
    }

    public function profile(Request $request){
         //seo 
         //slide public function AuthLogin(){
        $customer_id = Session::get('KhachHang_id');
        if(!$customer_id){
            return Redirect::to('/dang-nhap');
        }

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $meta_desc = "Thông tin cá nhân"; 
        $meta_keywords = "Thông tin cá nhân";
        $meta_title = "Thông tin cá nhân";
        $url_canonical = $request->url();
        //--seo 
        $customer_id = Session::get('KhachHang_id');
        $profile = DB::table('tbl_khachhang')->where('KhachHang_id',$customer_id)->first();

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        $city = DB::table('tbl_tinhthanhpho')->get();
         $quan = DB::table('tbl_quanhuyen')->get();
        $xa  = DB::table('tbl_xaphuongthitran')->get();

        $address_info = DB::table('tbl_DiaChi')->where('DiaChi_id',$profile->DiaChi_id)->first();

        $address_change = DB::table('tbl_DiaChi')->where('KhachHang_id',$customer_id)->get();

         $xa_info  = DB::table('tbl_xaphuongthitran')->where('XaPhuong_id',$address_info->XaPhuong_id)->first();

        $huyen_info = DB::table('tbl_quanhuyen')->where('QuanHuyen_id',(int)$xa_info->QuanHuyen_id)->first();

        $tinh_info = DB::table('tbl_tinhthanhpho')->where('TinhThanhPho_id',(int)$huyen_info->TinhThanhPho_id)->first();



        return view('pages.profile2')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider)->with('profile',$profile)->with('quan',$quan)->with('xa',$xa)->with('address_info',$address_info)->with('address_change',$address_change)->with('xa_info',$xa_info)->with('huyen_info',$huyen_info)->with('tinh_info',$tinh_info);
    }



    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(Request $request){
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        return view('pages.thanhtoan.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
    public function order_place(Request $request){
        //insert payment_method
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['KhachHang_id'] = Session::get('KhachHang_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }elseif($data['payment_method']==2){
            Cart::destroy();

            $cate_product = DB::table('tbl_DanhMuc')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
            return view('pages.thanhtoan.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::forget('KhachHang_id');
        Session::forget('KhachHang_Ten');
    	return Redirect::to('/dang-nhap');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_khachhang')->where('KhachHang_email',$email)->where('KhachHang_MatKhau',$password)->first();
    	
    	
    	if($result){
           
    		Session::put('KhachHang_id',$result->KhachHang_id);
            Session::put('KhachHang_Ten',$result->KhachHang_Ten);
            Session::put('KhachHang_Anh',$result->KhachHang_Anh);
    		return Redirect::to('/trang-chu');
    	}else{
    		return Redirect::to('/dang-nhap');
    	}
        Session::save();

    }
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
