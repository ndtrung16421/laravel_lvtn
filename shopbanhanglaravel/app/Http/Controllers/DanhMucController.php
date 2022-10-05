<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\Slider;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use Excel;
use CategoryProductModel;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class DanhMucController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Auth::id();
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('admin')->send();
    //     }
    // }
    public function add_category_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','Admin'])) {
            return Redirect::to('dashboard');
        }
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['view','Admin'])) {
            return Redirect::to('dashboard');
        }
    	$all_category_product = DB::table('tbl_DanhMuc')->orderby('DanhMuc_Ten','Asc')->paginate(10);
    	$manager_category_product  = view('admin.danhsach_danhmuc')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.danhsach_danhmuc', $manager_category_product);


    }
    public function save_category_product(Request $request){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['add','Admin'])) {
            return Redirect::to('dashboard');
        }
    	$data = array();

    	$data['DanhMuc_Ten'] = $request->category_product_name;
        
        $data['DanhMuc_slug'] = $request->slug_category_product;
    	$data['DanhMuc_MoTa'] = $request->category_product_desc;
    	$data['DanhMuc_TrangThai'] = $request->category_product_status;

    	DB::table('tbl_DanhMuc')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','Admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_DanhMuc')->where('DanhMuc_id',$category_product_id)->update(['DanhMuc_TrangThai'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','Admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_DanhMuc')->where('DanhMuc_id',$category_product_id)->update(['DanhMuc_TrangThai'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','Admin'])) {
            return Redirect::to('dashboard');
        }
        $edit_category_product = DB::table('tbl_DanhMuc')->where('DanhMuc_id',$category_product_id)->get();

        $manager_category_product  = view('admin.capnhat_danhmuc')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.capnhat_danhmuc', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){

        if (!Auth::user()->hasAnyRoles(['product','admin']) || !Auth::user()->hasAnyRoles(['update','Admin'])) {
            return Redirect::to('dashboard');
        }
        $data = array();
        $data['DanhMuc_Ten'] = $request->category_product_name;
        
        $data['DanhMuc_slug'] = $request->slug_category_product;
        $data['DanhMuc_MoTa'] = $request->category_product_desc;
        DB::table('tbl_DanhMuc')->where('DanhMuc_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        if (!Auth::user()->hasAnyRoles(['admin'])) {
            return Redirect::to('dashboard');
        }
        DB::table('tbl_DanhMuc')->where('DanhMuc_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home(Request $request ,$slug_category_product){
       //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

         $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 


        $category_by_id = DB::table('tbl_SanPham')->join('tbl_DanhMuc','tbl_SanPham.DanhMuc_id','=','tbl_DanhMuc.DanhMuc_id')->where('tbl_DanhMuc.DanhMuc_slug',$slug_category_product)->paginate(9);
     
       $rating_product= DB::table('tbl_DanhGiaSanPham')->get();
        
        $category_name = DB::table('tbl_DanhMuc')->where('tbl_DanhMuc.DanhMuc_slug',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
                //seo 
                $meta_desc = $val->DanhMuc_MoTa; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->DanhMuc_Ten;
                $url_canonical = $request->url();
                //--seo
                }


        $customer_id = Session::get('KhachHang_id');
        
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);
         

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('slug_category_product',$slug_category_product);
    }
    public function show_category_home_order(Request $request ,$slug_category_product, $od){
       //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_TrangThai','1')->take(4)->get();

        $cate_product = DB::table('tbl_DanhMuc')->where('DanhMuc_TrangThai','0')->orderby('DanhMuc_id','desc')->get(); 
        $brand_product = DB::table('tbl_ThuongHieu')->where('ThuongHieu_TrangThai','0')->orderby('ThuongHieu_id','desc')->get(); 

        $category_by_id = DB::table('tbl_SanPham')->join('tbl_DanhMuc','tbl_SanPham.DanhMuc_id','=','tbl_DanhMuc.DanhMuc_id')->where('tbl_DanhMuc.DanhMuc_slug',$slug_category_product)->orderby('SanPham_Gia',$od)->paginate(9);
     
       $rating_product= DB::table('tbl_DanhGiaSanPham')->get();
        
        $category_name = DB::table('tbl_DanhMuc')->where('tbl_DanhMuc.DanhMuc_slug',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
                //seo 
                $meta_desc = $val->DanhMuc_MoTa; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->DanhMuc_Ten;
                $url_canonical = $request->url();
                //--seo
                }


        $customer_id = Session::get('KhachHang_id');
        
        $tbl_wishlist=DB::table('tbl_yeuthich')->where('KhachHang_id',$customer_id)->orderby('SanPham_id','desc')->paginate(9);
         

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('rating_product',$rating_product)->with('tbl_wishlist',$tbl_wishlist)->with('slug_category_product',$slug_category_product);
    }



    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }
  

}
