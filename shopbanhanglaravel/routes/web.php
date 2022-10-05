<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend 
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index');
Route::get('/404','HomeController@error_page');
Route::post('/tim-kiem','HomeController@search');
Route::get('/your-order','DonHangController@your_order');
Route::get('/dang-ky','ThanhToanController@register');
Route::get('/thong-tin-ca-nhan','ThanhToanController@profile');
Route::get('/your-order2/{orders}','DonHangController@your_order2');
Route::get('/rating-product/{product_id}/{order_code}','HomeController@rating_product');

Route::get('/your-order4/{order_code}','DonHangController@your_order4');

Route::get('/home-order/{od}','HomeController@home_order');
Route::post('/search-order','HomeController@search_order');

Route::post('/save-rating','HomeController@save_rating');
Route::post('/update-view','HomeController@update_view');

Route::get('/yeu-thich','HomeController@view_wishlist');

Route::post('/check-email','HomeController@check_email');
Route::post('/check-email3','HomeController@check_email3');
Route::post('/check-email4','HomeController@check_email4');
Route::get('/view-all/{customer_id}','HomeController@view_all');

Route::post('/view-cart','GioHangController@view_cart');
Route::post('/view-cart2','GioHangController@view_cart2');

//Danh muc san pham trang chu
Route::get('/danh-muc/{slug_category_product}','DanhMucController@show_category_home');
Route::get('/danh-muc-sx/{slug_category_product}/{od}','DanhMucController@show_category_home_order');

Route::get('/thuong-hieu/{brand_slug}','ThuongHieuController@show_brand_home');
Route::get('/thuong-hieu-sx/{brand_slug}/{od}','ThuongHieuController@show_brand_home_order');

Route::get('/chi-tiet/{product_slug}','SanPhamController@details_product');


Route::get('/test','PayPalTestController@index');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::get('/logout-auth','AuthController@logout_auth');
Route::post('/admin-dashboard','AdminController@dashboard');

Route::post('/fafabell','AdminController@fafabell');
//hien thi tong so tin
Route::post('/fafabell2','AdminController@fafabell2');

Route::post('/filter-by-date','AdminController@filter_by_date');
Route::post('/dashboard-filter','AdminController@dashboard_filter');
Route::post('/days-order','AdminController@days_order');
//Category Product
Route::get('/add-category-product','DanhMucController@add_category_product');
Route::get('/edit-category-product/{category_product_id}','DanhMucController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','DanhMucController@delete_category_product');
Route::get('/all-category-product','DanhMucController@all_category_product');

Route::post('/export-csv','DanhMucController@export_csv');
Route::post('/import-csv','DanhMucController@import_csv');


Route::get('/unactive-category-product/{category_product_id}','DanhMucController@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','DanhMucController@active_category_product');

//Send Mail 
Route::get('/send-mail','HomeController@send_mail');

//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//Login google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

Route::post('/save-category-product','DanhMucController@save_category_product');
Route::post('/update-category-product/{category_product_id}','DanhMucController@update_category_product');

//Brand Product
//Route::group(['middleware' => 'roles', 'roles'=>['admin','product']], function () {
	

Route::get('/add-brand-product','ThuongHieuController@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','ThuongHieuController@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','ThuongHieuController@delete_brand_product');
Route::get('/all-brand-product','ThuongHieuController@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','ThuongHieuController@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','ThuongHieuController@active_brand_product');

Route::post('/save-brand-product','ThuongHieuController@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','ThuongHieuController@update_brand_product');
// });

//Product
 // Route::group(['middleware' => 'roles', 'roles'=>['admin','product']], function () {

Route::get('/add-product','SanPhamController@add_product');
Route::get('/edit-product/{product_id}','SanPhamController@edit_product');
Route::get('/image-product/{product_id}','SanPhamController@image_product');
Route::post('/save-image-product','SanPhamController@save_image_product');

Route::get('/delete-image-product/{product_image_id}','SanPhamController@delete_image_product');

 // });
// Route::get('users',
// 		[
// 			'uses'=>'UserController@index',
// 			'as'=> 'Users',
// 			'middleware'=> 'roles'
// 			// 'roles' => ['admin','author']
// 		]);
Route::get('users','UserController@index');

Route::get('add-users','UserController@add_users');
Route::post('store-users','UserController@store_users');
Route::post('assign-roles','UserController@assign_roles');
Route::get('login-auth','AuthController@login_auth');
Route::post('login','AuthController@login');


Route::get('/delete-product/{product_id}','SanPhamController@delete_product');

Route::get('/all-product','SanPhamController@all_product');

Route::get('/unactive-product/{product_id}','SanPhamController@unactive_product');
Route::get('/active-product/{product_id}','SanPhamController@active_product');
Route::post('/save-product','SanPhamController@save_product');
Route::post('/update-product/{product_id}','SanPhamController@update_product');

//Coupon
Route::post('/check-coupon','GioHangController@check_coupon');

Route::get('/unset-coupon','MaGiamGiaController@unset_coupon');
Route::get('/insert-coupon','MaGiamGiaController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','MaGiamGiaController@delete_coupon');
Route::get('/list-coupon','MaGiamGiaController@list_coupon');
Route::post('/insert-coupon-code','MaGiamGiaController@insert_coupon_code');

Route::get('/update-coupon/{coupon_id}','MaGiamGiaController@update_coupon');
Route::post('/update-coupon2','MaGiamGiaController@update_coupon2');

//Cart
Route::post('/update-cart-quantity','GioHangController@update_cart_quantity');

Route::post('/update-cart','GioHangController@update_cart');

Route::post('/save-cart','GioHangController@save_cart');
Route::post('/add-cart-ajax','GioHangController@add_cart_ajax');
Route::post('/add-wi','GioHangController@add_wi');
Route::post('/de-wi','GioHangController@de_wi');

Route::get('/show-cart','GioHangController@show_cart');
Route::get('/gio-hang','GioHangController@gio_hang');
Route::get('/delete-to-cart/{rowId}','GioHangController@delete_to_cart');
Route::get('/del-product/{session_id}','GioHangController@delete_product');
Route::get('/del-all-product','GioHangController@delete_all_product');


Route::post('/view-rating-customer','GioHangController@view_rating');





//Checkout
Route::get('/dang-nhap','ThanhToanController@login_checkout');
Route::get('/del-fee','ThanhToanController@del_fee');

Route::get('/logout-checkout','ThanhToanController@logout_checkout');
Route::post('/add-customer','ThanhToanController@add_customer');
Route::post('/order-place','ThanhToanController@order_place');
Route::post('/login-customer','ThanhToanController@login_customer');
Route::get('/checkout','ThanhToanController@checkout');
Route::get('/payment','ThanhToanController@payment');
Route::post('/save-checkout-customer','ThanhToanController@save_checkout_customer');
Route::post('/calculate-fee','ThanhToanController@calculate_fee');

Route::post('/select-delivery-home','ThanhToanController@select_delivery_home');

Route::post('/confirm-order','ThanhToanController@confirm_order');

Route::post('/paypal','ThanhToanController@buyAction');

Route::post('/save-customer','ThanhToanController@save_customer');
Route::post('/save-customer2','ThanhToanController@save_customer2');

Route::post('/add-address','ThanhToanController@add_address');
Route::get('/choose-address/{address_id}','ThanhToanController@choose_address');
Route::get('/del-address/{address_id}','ThanhToanController@del_address');
//Order
Route::get('/delete-order/{order_code}','DonHangController@order_code');
Route::get('/print-order/{checkout_code}','DonHangController@print_order');
Route::get('/manage-order2','DonHangController@manage_order2');
Route::get('/manage-order/{order_status_id}','DonHangController@manage_order');
Route::post('/search-od','DonHangController@search_od');
Route::post('/search-od-customer','DonHangController@search_od_customer');

Route::get('/search-voice/{result9}','HomeController@search_voice');



Route::get('/view-order-customer/{order_code}','DonHangController@view_order2');
Route::get('/view-order/{order_code}','DonHangController@view_order');
Route::post('/update-order-qty','DonHangController@update_order_qty');
Route::post('/update-qty','DonHangController@update_qty');



//Delivery
Route::get('/list-delivery','PhiVanChuyenController@list_delivery');

Route::get('/delivery','PhiVanChuyenController@delivery');
Route::post('/select-delivery','PhiVanChuyenController@select_delivery');
Route::post('/insert-delivery','PhiVanChuyenController@insert_delivery');

Route::get('/delete-fee/{fee_code}','PhiVanChuyenController@delete_fee');
Route::post('/update-fee','PhiVanChuyenController@update_fee');

Route::post('/select-cate','PhiVanChuyenController@select_cate');

//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');


