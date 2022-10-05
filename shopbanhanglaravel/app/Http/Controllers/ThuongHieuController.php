<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\ThuongHieu;
use App\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ThuongHieuController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Auth::id();
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('admin')->send();
    //     }
    // }
    public function add_brand_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
    	return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['view','admin'])) {
            return Redirect::to('dashboard');
        }
    	//$all_brand_product = DB::table('tbl_ThuongHieu')->get(); //static huong doi tuong
        // $all_brand_product = ThuongHieu::all(); 
        $all_brand_product = ThuongHieu::orderBy('ThuongHieu_Ten','ASC')->paginate(10);
    	$manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);


    }
    public function save_brand_product(Request $request){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','admin'])) {
            return Redirect::to('dashboard');
        }
        $data = $request->all();

        $brand = new ThuongHieu();
        $brand->ThuongHieu_Ten = $data['brand_product_name'];
        $brand->ThuongHieu_slug = $data['brand_slug'];
        $brand->ThuongHieu_MoTa = $data['brand_product_desc'];
        $brand->ThuongHieu_TrangThai = $data['brand_product_status'];
        $brand->save();
       
    	// $data = array();
    	// $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->ThuongHieu_slug;
    	// $data['brand_desc'] = $request->brand_product_desc;
    	// $data['brand_status'] = $request->brand_product_status;
    	// DB::table('tbl_ThuongHieu')->insert($data);
        
    	Session::put('message','Thêm thương hiệu sản phẩm thành công');
    	return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_ThuongHieu')->where('ThuongHieu_id',$brand_product_id)->update(['ThuongHieu_TrangThai'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_ThuongHieu')->where('ThuongHieu_id',$brand_product_id)->update(['ThuongHieu_TrangThai'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function edit_brand_product($brand_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }

        // $edit_brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_id',$brand_product_id)->get();
        $edit_brand_product = ThuongHieu::where('ThuongHieu_id',$brand_product_id)->get();
        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) {
            return Redirect::to('dashboard');
        }
        $data = $request->all();
        $brand = ThuongHieu::find($brand_product_id);
        // $brand = new ThuongHieu();
        $brand->ThuongHieu_Ten = $data['brand_product_name'];
        $brand->ThuongHieu_slug = $data['brand_product_slug'];
        $brand->ThuongHieu_MoTa = $data['brand_product_desc'];
        $brand->ThuongHieu_TrangThai = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->ThuongHieu_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_ThuongHieu')->where('ThuongHieu_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        if (!Auth::user()->hasAnyRoles(['admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_ThuongHieu')->where('ThuongHieu_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page
     
     public function show_brand_home(Request $request, $brand_slug){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_Ten','desc')->get(); 
        
        
        $brand_by_id = DB::table('tbl_SanPham')->join('tbl_ThuongHieu','tbl_SanPham.ThuongHieu_id','=','tbl_ThuongHieu.ThuongHieu_id')->where('tbl_ThuongHieu.ThuongHieu_slug',$brand_slug)->paginate(10);

        $brand_name = DB::table('tbl_ThuongHieu')->where('tbl_ThuongHieu.ThuongHieu_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->ThuongHieu_MoTa; 
            $meta_keywords = $val->ThuongHieu_MoTa;
            $meta_title = $val->ThuongHieu_Ten;
            $url_canonical = $request->url();
            //--seo
        }
        $customer_id = Session::get('KhachHang_id');
         $rating_product= DB::table('tbl_DanhGiaSanPham')->get();
         $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('brand_slug',$brand_slug);
    }

    public function show_brand_home_order(Request $request, $brand_slug, $od){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 
        
        
        $brand_by_id = DB::table('tbl_SanPham')->join('tbl_ThuongHieu','tbl_SanPham.ThuongHieu_id','=','tbl_ThuongHieu.ThuongHieu_id')->where('tbl_ThuongHieu.ThuongHieu_slug',$brand_slug)->orderby('product_price',$od)->paginate(9);

        $brand_name = DB::table('tbl_ThuongHieu')->where('tbl_ThuongHieu.ThuongHieu_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->ThuongHieu_MoTa; 
            $meta_keywords = $val->ThuongHieu_MoTa;
            $meta_title = $val->ThuongHieu_Ten;
            $url_canonical = $request->url();
            //--seo
        }
        $customer_id = Session::get('KhachHang_id');
         $rating_product= DB::table('tbl_DanhGiaSanPham')->get();
         $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('brand_slug',$brand_slug);
    }
}
