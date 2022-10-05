<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\MaGiamGia;
use App\PhiVanChuyen;
session_start();
class GioHangController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = DB::table('tbl_magiamgia')->where('MaGiamGia_Ma',$data['coupon'])->first();
        if($coupon){
           
            $cou[] = array(
                            'coupon_code' => $coupon->MaGiamGia_Ma,
                            'coupon_condition' => $coupon->MaGiamGia_Loai,
                            'coupon_number' => $coupon->MaGiamGia_GiaTri,
                        );

                    
            Session::put('coupon',$cou);
                   
                
            Session::save();

        // $brand = new Brand();
            $x = $coupon->MaGiamGia_SoLan -1;
             $data = array();
            $data9['MaGiamGia_SoLan'] = $x;
                
            DB::table('tbl_magiamgia')->where('MaGiamGia_Ma',$coupon->MaGiamGia_Ma)->update($data9);
                
                
            return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }   
    public function gio_hang(Request $request){
         //seo 
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();
        //--seo
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        $product = DB::table('tbl_sanpham')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('product',$product);
    }

    public function view_rating(Request $request){
        $data = $request->all();
        
        $rating2[] = array(
                
                'product_id' => $data['product_id'],
                'order_code' => $data['order_code'],
                
                );
                Session::put('rating2',$rating2);
        
    }

    public function view_cart(){
        
        $product = DB::table('tbl_sanpham')->get();
        $output = '';
        $output.='      
               <table > 
                <tr>
                    <td class="pull-right">
                        <h3 ><a href=# style="color: black;">Đóng<a></h3> 
                    </td>
                </tr>

               </table>
                ';
        $output .= '<div class="table-responsive">  
            <table id="bang-gio-hang" style="background-color: white;position: absolute;z-index: 9999999;" class="table table-bordered">
                <thread> 
                    <tr>
                    <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th> 

                        
                    </tr>  
                </thread>
                <tbody>
                ';

                foreach(Session::get('cart') as $key => $cart){

                    foreach($product as $key => $pro){
                        if($pro->SanPham_id == $cart['product_id']){
                            
                            $output.='
                            <tr style="height:200px"> 
                <td ><a href="http://localhost/shopbanhanglaravel/chi-tiet/'.$pro->SanPham_slug.'"> <img src="http://localhost/shopbanhanglaravel/public/uploads/product/'.$cart['product_image'].'" width="50px" height="50px"></td>
                                                                               ';
                                    }
                                  
                    }


                    $output.='
                        
                            <td>'.$cart['product_name'].'</td>
                            <td>'.$cart['product_price'].'</td>
                           
                        </tr>
                        ';
                }

                $output.='      
                </tbody>
                </table></div>
                ';

                echo $output;
        
        
    }
    public function view_cart2(){
        
        
        $output = '';
        

                echo $output;
        
        
    }


    public function add_wi(Request $request){
        // Session::forget('cart');
        $data2 = $request->all();
        

        //$data = array();
       //$data['customer_id'] = $data2['id_c'];
       //$data['customer_phone'] = $data['cart_product_id'];
        
        // DB::table('tbl_yeuthich')->insert($data);
        $data[] = array(
                
                'KhachHang_id' => $data2['id_c'],
                'SanPham_id' => $data2['cart_product_id'],
                
                );
        $tbl_wishlist =  DB::table('tbl_yeuthich')->get();
        $i=0;
        foreach ($tbl_wishlist as $key => $value) {
            if($value->KhachHang_id ==  $data2['id_c'] && $value->SanPham_id ==  $data2['cart_product_id']) {
                $i=1;
            }
        }

        if ($i==0) {
            # code...
        
        DB::table('tbl_yeuthich')->insert($data);
        }
            
    }   
    public function de_wi(Request $request){
        // Session::forget('cart');
        $data2 = $request->all();
        

        //$data = array();
       //$data['customer_id'] = $data2['id_c'];
       //$data['customer_phone'] = $data['cart_product_id'];
        
        // DB::table('tbl_yeuthich')->insert($data);
        $data[] = array(
                
                'customer_id' => $data2['id_c'],
                'product_id' => $data2['cart_product_id'],
                
                );
        $tbl_wishlist =  DB::table('tbl_yeuthich')->get();
        
        
        DB::table('tbl_yeuthich')->where('KhachHang_id',$data2['id_c'])->where('SanPham_id',$data2['cart_product_id'])->delete();
        
            
    }   

    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_slug' => $data['cart_product_slug'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_slug' => $data['cart_product_slug'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

        
        // $i=0;
                                       
        
        // foreach(Session::get('cart') as $key => $cart){
        //     $i++;
                  
        // }
                                           
        // echo $i;         
                                        

    }   
    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p>';

                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p>';
                    }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_sanpham')->where('SanPham_id',$productId)->first(); 

    
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] = $product_info->SanPham_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');
     //Cart::destroy();
       
    }
    public function show_cart(Request $request){
        //seo 
        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //--seo
        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get();  
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
    
}
