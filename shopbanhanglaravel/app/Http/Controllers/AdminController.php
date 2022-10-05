<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Social;
use Socialite;
use App\Login;
use App\Statistic;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Rules\Captcha;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
            $users = Socialite::driver('google')->stateless()->user(); 
            // // return $users->id;
            // return $users->name;
            // return $users->email;
            $authUser = $this->findOrCreateUser($users,'google');
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');  
    }
    public function fafabell2(Request $request){
         $data = $request->all();
        $output=0;
        $k=0;
        
         $tbl_customers = DB::table('tbl_order')->where('viewed',0)->get();
         foreach ($tbl_customers as $key => $tc) {
             $k++;
         }
        if ($k==0) {
            $k='';
        }
        $output=$k;

                echo $output;

        
    }
    public function fafabell(request $request){
        $data = $request->all();
        $output='';
        $uri = $_SERVER['HTTP_HOST'];
         $tbl_customers = DB::table('tbl_order')->where('viewed',0)->orderBy('order_id','DESC')->get();

        $tbl_order_status = DB::table('tbl_order_status')->get();
        $output.='<h5>Cập nhật đơn hàng</h5>';
         foreach ($tbl_customers as $key => $tc) {
             $customer_order_detail = DB::table('tbl_ChiTietDonHang')->join('tbl_order','tbl_order_details.order_code','=','tbl_order.order_code')->where('viewed',0)->where('tbl_order_details.order_code',$tc->order_code)->get();

            $tbl_product = DB::table('tbl_SanPham')->get();
            $imag=[];
           

            foreach ($tbl_product as $key => $tp){
                foreach ($customer_order_detail as $key => $cod){
                    if ($cod->product_id == $tp->product_id) {
                        array_push( $imag,$tp->product_image);
                        
                    }
                }
            }


            foreach ($tbl_order_status as $key => $tos){


                if ($tos->order_status_id == $tc->order_status ) {
                    # code...
                

                    $output.='
                        
                        
                            
                                    <a style="font-size: 18px;" href="/shopbanhanglaravel/view-order/'.$tc->order_code.'"  >
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
                            Đơn hàng '.$tc->order_code.': 
                        </p
                        <p>'.$tos->order_status_name.'. </p>
                        <p> Cập nhật: '.$tc->updated_at.'</p>

                                    </a>
                                
                       
                    ';
                }

            }
         }
        
        $output.=' <center>
                    <a style="color:blue;" href="/shopbanhanglaravel/view-all/" >Đọc tất cả</a>
                    </center>

                    ';

                echo $output;
    }
    public function dashboard_filter(request $request){
        $data = $request->all();
        $product_id = $data['product_id'];

        $from = 0;
        $to = 0;
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days =  Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days =  Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            
            $from = $sub7days;
            $to = $now;
        }
        elseif ($data['dashboard_value'] == 'thangtruoc') {
           
            $from = $dau_thangtruoc;
            $to = $cuoi_thangtruoc;
        }
        elseif ($data['dashboard_value'] == 'thangnay') {
            
            $from = $dauthangnay;
            $to = $now;
        }
        else{
            

            $from = $sub365days;
            $to = $now;
        }

        if ($product_id != -1) {
             # code...
         

        $get = DB::table('tbl_ChiTietDonHang')
         ->select(DB::raw('tbl_donhang.NgayTao as order_date,sum(tbl_donhang.TongTien) as sales,SUM(tbl_chitietdonhang.SoLuongBan_CTDH) as quantity, COUNT(tbl_donhang.DonHang_Ma) as total_order'))->join('tbl_donhang', 'tbl_donhang.DonHang_Ma', '=', 'tbl_chitietdonhang.DonHang_Ma')
         ->where('tbl_chitietdonhang.SanPham_id',$product_id)
           ->whereBetween('tbl_donhang.NgayTao',[$from,$to])
            ->groupBy('tbl_donhang.NgayTao')
            ->get();

        }else{


        
            $get = DB::table('tbl_ChiTietDonHang')
         ->select(DB::raw('tbl_donhang.NgayTao as order_date,sum(tbl_donhang.TongTien) as sales,SUM(tbl_chitietdonhang.SoLuongBan_CTDH) as quantity, COUNT(tbl_donhang.DonHang_Ma) as total_order'))->join('tbl_donhang', 'tbl_donhang.DonHang_Ma', '=', 'tbl_chitietdonhang.DonHang_Ma')
         
           ->whereBetween('tbl_donhang.NgayTao',[$from,$to])
            ->groupBy('tbl_donhang.NgayTao')
            ->get();
        }


        $chart_data[] = array(
                    'period' => '0',
                    'order' => '0',
                    'sales' => '0',
                    
                    'quantity' => '0'
                );


    if ($get) {
        # code...
    
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'sales' => $val->sales,
                'order' => $val->total_order,
                
                
                'quantity' => $val->quantity
            );
        }
    }
         $data2 = json_encode($chart_data);
        echo $data2;

    }
    public function filter_by_date(request $request){
        $data = $request->all();

         $from_date = $data['from_date'];
         $to_date = $data['to_date'];
         $product_id = $data['product_id'];

         if ($product_id != -1) {
             # code...
         

        $get = DB::table('tbl_ChiTietDonHang')
         ->select(DB::raw('tbl_donhang.NgayTao as order_date,sum(tbl_donhang.TongTien) as sales,SUM(tbl_chitietdonhang.SoLuongBan_CTDH) as quantity, COUNT(tbl_donhang.DonHang_Ma) as total_order'))->join('tbl_donhang', 'tbl_donhang.DonHang_Ma', '=', 'tbl_chitietdonhang.DonHang_Ma')
         ->where('tbl_chitietdonhang.SanPham_id',$product_id)
           ->whereBetween('tbl_donhang.NgayTao',[$from_date,$to_date])
            ->groupBy('tbl_donhang.NgayTao')
            ->get();

        }else{


        
            $get = DB::table('tbl_ChiTietDonHang')
         ->select(DB::raw('tbl_donhang.NgayTao as order_date,sum(tbl_donhang.TongTien) as sales,SUM(tbl_chitietdonhang.SoLuongBan_CTDH) as quantity, COUNT(tbl_donhang.DonHang_Ma) as total_order'))->join('tbl_donhang', 'tbl_donhang.DonHang_Ma', '=', 'tbl_chitietdonhang.DonHang_Ma')
         
           ->whereBetween('tbl_donhang.NgayTao',[$from_date,$to_date])
            ->groupBy('tbl_donhang.NgayTao')
            ->get();
        }


        $chart_data[] = array(
                    'period' => '0',
                    'order' => '0',
                    'sales' => '0',
                    
                    'quantity' => '0'
                );

        if ($get) {
            # code...
        
            foreach ($get as $key => $val) {
                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    
                    'quantity' => $val->quantity
                );
            }
             
        }
            
        
        $data2 = json_encode($chart_data);
        echo $data2;
        //echo($chart_data);
        
    }
    public function days_order(request $request){
        $data = $request->all();

        
        $sub30days =  Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        
        
        //$time =$order->updated_at;
        //$time2 = date("Y-m-d",$time);

        

        $get = DB::table('tbl_ChiTietDonHang')
         ->select(DB::raw('tbl_donhang.NgayTao as order_date,sum(tbl_donhang.TongTien) as sales,SUM(tbl_chitietdonhang.SoLuongBan_CTDH) as quantity, COUNT(tbl_donhang.DonHang_Ma) as total_order'))->join('tbl_donhang', 'tbl_donhang.DonHang_Ma', '=', 'tbl_chitietdonhang.DonHang_Ma')
         
           ->whereBetween('tbl_donhang.NgayTao',[$sub30days,$now])
            ->groupBy('tbl_donhang.NgayTao')
            ->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                
                'quantity' => $val->quantity
            );
        }
         $data2 = json_encode($chart_data);
        echo $data2;
        //echo($chart_data);
        
    }

    public function findOrCreateUser($users, $provider){
            $authUser = Social::where('provider_user_id', $users->id)->first();
            if($authUser){

                return $authUser;
            }
          
            $hieu = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email',$users->email)->first();

                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
                        'admin_phone' => '',
                        'admin_status' => 1
                        
                    ]);
                }

            $hieu->login()->associate($orang);
                
            $hieu->save();

            $account_name = Login::where('admin_id',$hieu->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id); 
          
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');


    }


    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''
                    
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
    	return view('admin.custom_auth.login_auth');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        $product = DB::table('tbl_SanPham')->get();
        $product_category = DB::table('tbl_DanhMuc')->get();
    	return view('admin.dashboard')->with('product',$product)->with('product_category',$product_category);
    }
    public function dashboard(Request $request){
        //$data = $request->all();
        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required',
            'admin_password' => 'required',
            'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        ]);

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return Redirect::to('/admin');
        }
       

    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
