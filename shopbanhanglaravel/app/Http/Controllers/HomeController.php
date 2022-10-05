<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Mail;
use App\Slider;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function error_page(){
        return view('errors.404');
    }
    public function send_mail(){
         //send mail
                $to_name = " Nguyễn";
                $to_email = "ttt157085@gmail.com";//send to this email
               
             
                $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
                
                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

                    $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
                // return redirect('/')->with('message','');
                //--send mail
    }
    // public function ra(){
    //     $re="chao ban";
    //      Session::put('cus',$re);
    //      session::save();
          
    // }
    // public function update_view(Request $request){
    //      $data = $request->all();
        
         
    //      $output = '<h4> abccc </h4>';
         
        
        

    //     echo $output;

        
    // }
    public function view_all( $customer_id){
        

        $tbl_order = DB::table('tbl_donhang')->where('KhachHang_id',$customer_id)->get();
        foreach ($tbl_order as $key => $tc) {
            $data = array();
        
            $data['customer_viewed'] = 1;
            DB::table('tbl_donhang')->where('KhachHang_id',$customer_id)->update($data);
        }
        return Redirect::to('trang-chu');
    }
    public function check_email3(Request $request){
         $data = $request->all();
        $output='';
        $uri = $_SERVER['HTTP_HOST'];
         $tbl_customers = DB::table('tbl_donhang')->where('KhachHang_id',$data['customer_id'])->where('KhachHangDaXem',0)->get();

         

       
    

        $tbl_order_status = DB::table('tbl_TrangThaiDonHang')->get();
        $output.='<h5>Cập nhật đơn hàng</h5>';
         foreach ($tbl_customers as $key => $tc) {
             $customer_order_detail = DB::table('tbl_chitietdonhang')->join('tbl_donhang','tbl_ChiTietDonHang.DonHang_Ma','=','tbl_DonHang.DonHang_Ma')->where('tbl_DonHang.KhachHang_id',$data['customer_id'])->where('KhachHangDaXem',0)->where('tbl_ChiTietDonHang.DonHang_Ma',$tc->DonHang_Ma)->get();

            $tbl_product = DB::table('tbl_SanPham')->get();
            $imag=[];
           

            foreach ($tbl_product as $key => $tp){
                foreach ($customer_order_detail as $key => $cod){
                    if ($cod->SanPham_id == $tp->SanPham_id) {
                        array_push( $imag,$tp->SanPham_AnhChinh);
                        
                    }
                }
            }


            foreach ($tbl_order_status as $key => $tos){


                if ($tos->TrangThaiDonHang_id == $tc->TrangThaiDonHang_id ) {
                    # code...
                

                    $output.='
                        
                        
                            
                                    <a style="font-size: 18px;border-bottom:1px solid black;" href="/shopbanhanglaravel/your-order4/'.$tc->DonHang_Ma.'"  >

                    ';

                    $kk=0;
                    foreach ($imag as $value) {
                        if ($kk<10) {
                            # code...
                        
                    
                             $output.='
                                <img src="/shopbanhanglaravel/public/uploads/product/'.$value.'" height="50" width="50" alt="avatar" />
                            ';
                        }
                        $kk++;
                    }            
                    $output.='               
                                    <p style="color:blue;">
                                    Đơn hàng '.$tc->DonHang_Ma.': 
                                    </p
                                    <p>
                                    '.$tos->TrangThaiDonHang_Ten.'. Cập nhật: '.$tc->updated_at.'
                                    </p>
                                    </a>
                                
                       
                    ';
                }

            }
         }
        
        $output.=' <center>
                    <a style="color:blue;" href="/shopbanhanglaravel/view-all/'.$data['customer_id'].'" >Đọc tất cả</a>
                    </center>

                    ';

                echo $output;

        
    }
    public function check_email4(Request $request){
         $data = $request->all();
        $output=0;
        $k=0;
        
         $tbl_customers = DB::table('tbl_donhang')->where('KhachHang_id',$data['customer_id'])->where('KhachHangDaXem',0)->get();
         foreach ($tbl_customers as $key => $tc) {
             $k++;
         }
        if ($k==0) {
            $k='';
        }
        $output=$k;

                echo $output;

        
    }

    public function check_email(Request $request){
         $data = $request->all();
         $tbl_customers = DB::table('tbl_KhachHang')->get();
         $i=0;
         $output = '';
         foreach ($tbl_customers as $key => $tc) {
             if ($tc->customer_email == $data['username']) {
                 $i=1;
             }
         }


        if ($i == 0) {
            $output = '<font color="blue";>Tài khoản này chưa có người sử dụng </font>';
        }
        if ($i == 1) {
            $output = '<font color="red">Tài khoản này đã tồn tại</font>';
        }
        
        

                echo $output;

        
    }




    public function view_wishlist(Request $request){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện Điện thoại"; 
        $meta_keywords = "phu kien dien thoai";
        $meta_title = "Phụ kiện điện thoại chính hãng";
        $url_canonical = $request->url();
        //--seo
        
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        // $all_product = DB::table('tbl_SanPham')
        // ->join('tbl_DanhMuc','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        $all_product = DB::table('tbl_SanPham')->where('SanPham_TrangThai','0')->get(); 
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first();
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);

        return view('pages.sanpham.yeuthich')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist);
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }
    public function index(Request $request){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(10)->get();
        //seo 
        $meta_desc = "Chuyên bánphụ kiện Điện Thoại"; 
        $meta_keywords = "Phu kien dien thoai";
        $meta_title = "NDT - Phụ kiện Điện thoại";
        $url_canonical = $request->url();
        //--seo
        
    	$cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        // $all_product = DB::table('tbl_SanPham')
        // ->join('tbl_DanhMuc','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        $all_product = DB::table('tbl_SanPham')->where('SanPham_TrangThai','0')->orderby('SanPham_id','desc')->paginate(9); 
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first(); 
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->get();

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist);
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }
    public function home_order($od){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(10)->get();
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,thiết bị game"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical ="";
        //--seo
        
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        // $all_product = DB::table('tbl_SanPham')
        // ->join('tbl_DanhMuc','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        $all_product = DB::table('tbl_SanPham')->where('SanPham_TrangThai','0')->orderby('SanPham_Gia',$od)->paginate(9); 
        
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first(); 
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist);
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }
     public function profile (){

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        //seo 
        $meta_desc = "Thông tin cá nhân"; 
        $meta_keywords = "Thông tin cá nhân";
        $meta_title = "Thông tin cá nhân";
        $url_canonical = "";
        //--seo 

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get();
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 


        $customer_id = session::get("customer_id");
        $profile = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first();
        $city = DB::table('tbl_tinhthanhpho')->get();
        


        return view('pages.profile')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('profile',$profile)->with('city',$city);
    }
     public function rating_product($product_id ,$order_code){

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        //seo 
        $meta_desc = "Thông tin cá nhân"; 
        $meta_keywords = "Thông tin cá nhân";
        $meta_title = "Thông tin cá nhân";
        $url_canonical = "";
        //--seo 

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get();
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 


        $customer_id = session::get("customer_id");
        $product = DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->first();

        return view('pages.donhang.danhgiasp')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('KhachHang_id',$customer_id)->with('product',$product)->with('order_code',$order_code);
    }

    public function view_rating(Request $request){
        $data = $request->all();
        $rating2 = DB::table('tbl_danhgiasanpham')->where('SanPham_id',$data['cart_product_id'])->where('order_code',$data['order_code'])->first();

        Session::put('$rating2',$rating2);
        Session::save();
        
    }


    public function save_rating(Request $request){
        
        $data = array();

        $data['DanhGiaSP_start'] = $request->rating;
        $data['KhachHang_id'] = Session::get('KhachHang_id');
        $data['SanPham_id'] = $request->product_id;
        $data['DanhGiaSP_NoiDung'] = $request->rating_content;
        $data['DonHang_Ma'] = $request->order_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['ThoiGianTao'] = now();

       

        


        if ($request->file('rating_image1')){
            
        
            $get_image = $request->file('rating_image1');
        
            
        
        
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/profile',$new_image);
            $data['DanhGiaSP_Anh1'] = $new_image;

        
        }
         if ($request->file('rating_image2')){
            
        
            $get_image = $request->file('rating_image2');
        
            
        
        
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/profile',$new_image);
            $data['DanhGiaSP_Anh2'] = $new_image;

        
        }
         if ($request->file('rating_image3')){
            
        
            $get_image = $request->file('rating_image3');
        
            
        
        
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/profile',$new_image);
            $data['DanhGiaSP_Anh3'] = $new_image;

        
        }


        DB::table('tbl_danhgiasanpham')->insert($data);

        return Redirect::to('/your-order');
    }


    public function search(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,thiết bị game"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical = $request->url();
        //--seo
        
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        // $all_product = DB::table('tbl_SanPham')
        // ->join('tbl_DanhMuc','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $keywords = $request->keywords_submit;
        $all_product = DB::table('tbl_SanPham')->where('SanPham_Ten','like','%'.$keywords.'%')->paginate(9);
        $repl = 0;
        if (count($all_product) < 1 ) {
            $repl =1;
            $piece = explode(" ", $keywords);
            foreach ($piece as $key => $value) {
                $all_product = DB::table('tbl_SanPham')->where('SanPham_Ten','like','%'.$value.'%')->paginate(9);
                if (count($all_product) > 0) {
                    break;
                }
            }
        }



        
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first(); 
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->get();


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('keywords',$keywords)->with('repl',$repl);

    }

    public function search_voice($result9){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,thiết bị game"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical = "";
        //--seo
        
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        // $all_product = DB::table('tbl_SanPham')
        // ->join('tbl_DanhMuc','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $keywords = $result9;
        $all_product = DB::table('tbl_SanPham')->where('SanPham_Ten','like','%'.$keywords.'%')->paginate(9);
        $repl = 0;
        if (count($all_product) < 1 ) {
            $repl =1;
            $piece = explode(" ", $keywords);
            foreach ($piece as $key => $value) {
                $all_product = DB::table('tbl_SanPham')->where('SanPham_Ten','like','%'.$value.'%')->paginate(9);
                if (count($all_product) > 0) {
                    break;
                }
            }
        }



        
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first(); 
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->get();


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('keywords',$keywords)->with('repl',$repl);

    }

    public function search_order(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,thiết bị game"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical = $request->url();
        //--seo
        
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        $data = $request->all();

        
        $keywords = $data['key'];
        $od = $data['od'];


        
        $all_product = DB::table('tbl_SanPham')->where('SanPham_Ten','like','%'.$keywords.'%')->orderby('SanPham_Gia',$od)->paginate(9);
        
        $rating_product= DB::table('tbl_danhgiasanpham')->get();
        $customer_id = Session::get('KhachHang_id');
        $customer = DB::table('tbl_KhachHang')->where('KhachHang_id',$customer_id)->first(); 
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->get();


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('keywords',$keywords);

    }
}
