<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Slider;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class SanPhamController extends Controller
{
    public function AuthLogin(){
        
            
        
    }
    public function add_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
         $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 
 
       

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
    public function all_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
        
    	$all_product = DB::table('tbl_SanPham')
        ->join('tbl_danhmuc','tbl_danhmuc.danhmuc_id','=','tbl_sanpham.danhmuc_id')
        ->join('tbl_thuonghieu','tbl_thuonghieu.ThuongHieu_id','=','tbl_sanpham.ThuongHieu_id')
        ->orderby('tbl_sanpham.SanPham_id','desc')->paginate(20);
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
    	$data = array();
    	$data['SanPham_Ten'] = $request->product_name;
        $data['SanPham_SoLuong'] = $request->product_quantity;
        $data['SanPham_slug'] = $request->product_slug;
    	$data['SanPham_Gia'] = $request->product_price;
    	$data['SanPham_MoTa'] = $request->product_desc;
        
        $data['DanhMuc_id'] = $request->product_cate;
        $data['ThuongHieu_id'] = $request->product_brand;
        $data['SanPham_DaBan'] = 0;
        $data['SanPham_TrangThai'] = $request->product_status;
        $data['SanPham_AnhChinh'] = '';

        $data['SanPham_AnhChinh2'] = null;
        $data['SanPham_AnhChinh3'] = null;
        $data['SanPham_AnhChinh4'] = null;
        $data['SanPham_AnhChinh5'] = null;
        $data['SanPham_AnhChinh6'] = null;
        $get_image = $request->file('product_image');
        $get_image2 = $request->file('product_image2');
        $get_image3 = $request->file('product_image3');
        $get_image4 = $request->file('product_image4');
        $get_image5 = $request->file('product_image5');
        $get_image6 = $request->file('product_image6');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['SanPham_AnhChinh'] = $new_image;
            
        }
        if($get_image2){
            $get_name_image2 = $get_image2->getClientOriginalName();
            $name_image2 = current(explode('.',$get_name_image2));
            $new_image2 =  $name_image2.rand(0,99).'.'.$get_image2->getClientOriginalExtension();
            $get_image2->move('public/uploads/product',$new_image2);
            $data['SanPham_AnhChinh2'] = $new_image2;
            
        }
        if($get_image3){
            $get_name_image3 = $get_image3->getClientOriginalName();
            $name_image3 = current(explode('.',$get_name_image3));
            $new_image3 =  $name_image3.rand(0,99).'.'.$get_image3->getClientOriginalExtension();
            $get_image3->move('public/uploads/product',$new_image3);
            $data['SanPham_AnhChinh3'] = $new_image3;
            
        }
        if($get_image4){
            $get_name_image4 = $get_image4->getClientOriginalName();
            $name_image4 = current(explode('.',$get_name_image4));
            $new_image4 =  $name_image4.rand(0,99).'.'.$get_image4->getClientOriginalExtension();
            $get_image4->move('public/uploads/product',$new_image4);
            $data['SanPham_AnhChinh4'] = $new_image4;
            
        }
        if($get_image5){
            $get_name_image5 = $get_image5->getClientOriginalName();
            $name_image5 = current(explode('.',$get_name_image5));
            $new_image5 =  $name_image5.rand(0,99).'.'.$get_image5->getClientOriginalExtension();
            $get_image5->move('public/uploads/product',$new_image5);
            $data['SanPham_AnhChinh5'] = $new_image5;
            
        }
        if($get_image6){
            $get_name_image6 = $get_image6->getClientOriginalName();
            $name_image6 = current(explode('.',$get_name_image6));
            $new_image6 =  $name_image6.rand(0,99).'.'.$get_image6->getClientOriginalExtension();
            $get_image6->move('public/uploads/product',$new_image6);
            $data['SanPham_AnhChinh6'] = $new_image6;
            
        }
        
    	DB::table('tbl_SanPham')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->update(['SanPham_TrangThai'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->update(['SanPham_TrangThai'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function image_product($product_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        
 

        $image_pro = DB::table('tbl_HinhAnhSP')->where('SanPham_id',$product_id)->get();

        $pro = DB::table('tbl_sanpham')->where('SanPham_id',$product_id)->first();

        return view('admin.image_product')->with('image_pro', $image_pro)->with('pro', $pro);
    }

    public function save_image_product(Request $request){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }

        

        
        
        
        for($i=0 ; $i < count( $request->file("file")); $i++)
             {
               $get_image  =$request->file('file')[$i];

               if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/image_product',$new_image);

                    $data = array();
                    $data['SanPham_id'] = $request->product_id;
                    $data['HinhAnhSP_Ten'] = $new_image;

                     DB::table('tbl_HinhAnhSP')->insert($data);
        
                }
                
             }

        

        Session::put('message','Cập nhật sản phẩm thành công');

       
        return Redirect::back();
        
            
        
    }
    public function delete_image_product($product_image_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }

        
        DB::table('tbl_HinhAnhSP')->where('HinhAnhSP_id',$product_image_id)->delete();
        
                
        

        Session::put('message','Xóa thành công');

       
       return Redirect::back();
        
            
        
    }


    public function edit_product($product_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
         $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 
 

        $edit_product = DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
         if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }

        $pro = DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->first();

        $data = array();
        $data['SanPham_Ten'] = $request->product_name;
        $data['SanPham_SoLuong'] = $request->product_quantity + $pro->SanPham_SoLuong;
        $data['SanPham_slug'] = $request->product_slug;
        $data['SanPham_Gia'] = $request->product_price;
        $data['SanPham_MoTa'] = $request->product_desc;
        
        $data['DanhMuc_id'] = $request->product_cate;
        $data['ThuongHieu_id'] = $request->product_brand;
        $data['SanPham_TrangThai'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['SanPham_AnhChinh'] = $new_image;
        }
        // $data['SanPham_AnhChinh2'] = null;
        // $data['SanPham_AnhChinh3'] = null;
        // $data['SanPham_AnhChinh4'] = null;
        // $data['SanPham_AnhChinh5'] = null;
        // $data['SanPham_AnhChinh6'] = null;
        
        $get_image2 = $request->file('product_image2');
        $get_image3 = $request->file('product_image3');
        $get_image4 = $request->file('product_image4');
        $get_image5 = $request->file('product_image5');
        $get_image6 = $request->file('product_image6');
      
        
        if($get_image2){
            $get_name_image2 = $get_image2->getClientOriginalName();
            $name_image2 = current(explode('.',$get_name_image2));
            $new_image2 =  $name_image2.rand(0,99).'.'.$get_image2->getClientOriginalExtension();
            $get_image2->move('public/uploads/product',$new_image2);
            $data['SanPham_AnhChinh2'] = $new_image2;
            
        }
        if($get_image3){
            $get_name_image3 = $get_image3->getClientOriginalName();
            $name_image3 = current(explode('.',$get_name_image3));
            $new_image3 =  $name_image3.rand(0,99).'.'.$get_image3->getClientOriginalExtension();
            $get_image3->move('public/uploads/product',$new_image3);
            $data['SanPham_AnhChinh3'] = $new_image3;
            
        }
        if($get_image4){
            $get_name_image4 = $get_image4->getClientOriginalName();
            $name_image4 = current(explode('.',$get_name_image4));
            $new_image4 =  $name_image4.rand(0,99).'.'.$get_image4->getClientOriginalExtension();
            $get_image4->move('public/uploads/product',$new_image4);
            $data['SanPham_AnhChinh4'] = $new_image4;
            
        }
        if($get_image5){
            $get_name_image5 = $get_image5->getClientOriginalName();
            $name_image5 = current(explode('.',$get_name_image5));
            $new_image5 =  $name_image5.rand(0,99).'.'.$get_image5->getClientOriginalExtension();
            $get_image5->move('public/uploads/product',$new_image5);
            $data['SanPham_AnhChinh5'] = $new_image5;
            
        }
        if($get_image6){
            $get_name_image6 = $get_image6->getClientOriginalName();
            $name_image6 = current(explode('.',$get_name_image6));
            $new_image6 =  $name_image6.rand(0,99).'.'.$get_image6->getClientOriginalExtension();
            $get_image6->move('public/uploads/product',$new_image6);
            $data['SanPham_AnhChinh6'] = $new_image6;
            
        }


        DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
        
            
        
    }
    public function delete_product($product_id){
        if (!Auth::user()->hasAnyRoles(['admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_SanPham')->where('SanPham_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_slug , Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_thuonghieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        $details_product = DB::table('tbl_SanPham')
        ->join('tbl_danhmuc','tbl_danhmuc.danhmuc_id','=','tbl_sanpham.danhmuc_id')
        ->join('tbl_thuonghieu','tbl_thuonghieu.ThuongHieu_id','=','tbl_sanpham.ThuongHieu_id')
        ->where('tbl_sanpham.SanPham_slug',$product_slug)->get();

        $id_product = DB::table('tbl_SanPham')
    
        ->where('SanPham_slug',$product_slug)->first();

        $rating_product= DB::table('tbl_danhgiasanpham')
        ->where('SanPham_id',$id_product->SanPham_id)->get();

        $total_rating_product = 1;
        $total_rating_product= DB::table('tbl_danhgiasanpham')
        ->where('SanPham_id',$id_product->SanPham_id)->count();

        if ($total_rating_product == 0) {
            $total_rating_product = 1;
        }

        $start = 0;
        foreach ($rating_product as $key => $rating_p) {
            $start += $rating_p->DanhGiaSP_start;
        }
        $average_start = $start / $total_rating_product;

        $tbl_customers = DB::table('tbl_khachhang')->get();


        foreach($details_product as $key => $value){
            $category_id = $value->DanhMuc_id;
                //seo 
                $meta_desc = $value->SanPham_MoTa;
                $meta_keywords = $value->SanPham_slug;
                $meta_title = $value->SanPham_Ten;
                $url_canonical = $request->url();
                //--seo
            }
       
        $related_product = DB::table('tbl_SanPham')
        ->join('tbl_danhmuc','tbl_danhmuc.danhmuc_id','=','tbl_sanpham.danhmuc_id')
        ->join('tbl_thuonghieu','tbl_thuonghieu.ThuongHieu_id','=','tbl_sanpham.ThuongHieu_id')
        ->where('tbl_danhmuc.danhmuc_id',$category_id)->whereNotIn('tbl_sanpham.SanPham_slug',[$product_slug])->orderby(DB::raw('RAND()'))->paginate(9);

        $customer_id = session::get('KhachHang_id');
        $tbl_wishlist=DB::table('tbl_YeuThich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);

        $ima = DB::table('tbl_HinhAnhSP')->where('SanPham_id',$id_product->SanPham_id)->get();



        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('slider',$slider)->with('tbl_customers',$tbl_customers)->with('average_start',$average_start)->with('KhachHang_id',$customer_id)->with('tbl_wishlist',$tbl_wishlist)->with('ima',$ima);

    }
}
