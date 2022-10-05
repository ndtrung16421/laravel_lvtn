<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------Seo--------->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link rel="icon" href="{{URL::to('/public/favicon.ico')}}" type="image/ico">
    
    {{--   <meta property="og:image" content="{{$image_og}}" />  
      <meta property="og:site_name" content="http://localhost/tutorial_youtube/shopbanhanglaravel" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}
    <!--//-------Seo--------->
    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/style3.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
     <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link href="{{asset('public/frontend/css/xzoom.css')}}" rel="stylesheet">


</head><!--/head-->

<body>
     <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101106895514869");
      chatbox.setAttribute("attribution", "biz_inbox");
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v10.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                     
                    <div class="col-xs-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>

                    @if(Session::get('KhachHang_Ten'))
                    <div class="col-xs-3">

                                    <form>
                                    @csrf
                                    <input type="hidden" value="{{Session::get('KhachHang_id')}}" name="customer_id">

                                       

                                    <div class="dropdown11">
                                        <a href="#" onclick="myFunction()" class="fa fa-bell dropbtn11">
                                            <sup class="cart-num" id="nou-num" style="color: white!important;">
                                                
                                            </sup>
                                        </a>

                                        <div id="myDropdown11" class="dropdown-content11" style="width: 350px; max-height:500px !important;overflow-y:scroll!important;right: 0!important;">
                                                
                                          </div>
                                    </div>


                                
                                    </form>

                    </div>
                    @endif

                    <div class="col-xs-3 pull-right">
                    @if(Session::get('KhachHang_Ten'))
                    
                               
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle"  data-toggle="dropdown">
                                        <img style="border-radius: 25px;" src="{{url('/public/uploads/profile/')}} /{{Session::get('KhachHang_Anh')}}" height="30" width="30" alt="avatar" />
                                            {{Session::get('KhachHang_Ten')}}
                                    <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{URL::to('/thong-tin-ca-nhan')}}">
                                                Thông tin cá nhân
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{URL::to('/your-order')}}">
                                            Xem đơn hàng
                                            </a>
                                        </li>
                                        <li >
                                            <a href="{{URL::to('/yeu-thich')}}">
                                                Danh sách yêu thích
                                            </a>
                                        </li>
                                                    
                                        <li>
                                            <a href="{{URL::to('/logout-checkout')}}">
                                                Đăng xuất
                                            </a>
                                        </li>
                                    </ul>

                                </div>



                                
                    
                                @else
                                
                                
                                    <a href="{{URL::to('/dang-nhap')}}">

                                        <button type="button" class="btn btn-info">Đăng nhập</button>
                                    </a>
                                


                               
                                    <a href="{{URL::to('/dang-ky')}}">
                                        <button type="button" class="btn btn-success">Đăng ký</button>      
                                    </a>
                                    


                                @endif
                            
                    </div>
                    

                </div>
            </div>
        </div><!--/header_top-->


        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="logo pull-left">
                            <a style="font-size: 30px;color: white;" href="{{URL::to('/trang-chu')}}">
                                <img src="{{url('/public/frontend/images/NDTSHOP-COOLTEXT2.png')}}" height="80" width="100%" alt="" /> 
                                

                            </a>
                        </div>
                      
                    </div>

                    <div class="col-xs-6">
                       
                        <form action="{{URL::to('/tim-kiem')}}" method="POST" >
                                        {{csrf_field()}}
                                    
                            <input id="message" style="color: black;" class="input-se" type="text" name="keywords_submit" placeholder="Tìm sản phẩm"  />

                            <button type="submit" class="btn-se">Tìm</button>
                            <h4 class="btn btn-info hover-transform" style="background-color:#2E64FE;border: none;" id='btnTalk'>
                                <i id="microphone" style="font-size: 25px;" class="fa fa-microphone"></i>
                            </h4>
         
                        </form>
                        <script>
        var message = document.querySelector('#message');

        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
        var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

        var grammar = '#JSGF V1.0;'

        var recognition = new SpeechRecognition();
        var speechRecognitionList = new SpeechGrammarList();
        speechRecognitionList.addFromString(grammar, 1);
        recognition.grammars = speechRecognitionList;
        recognition.lang = 'vi-VN';
        recognition.interimResults = false;

        recognition.onresult = function(event) {
            var lastResult = event.results.length - 1;
            var content = event.results[lastResult][0].transcript;
            // message.textContent = 'Voice Input: ' + content ;

            
            var result9 = content.substring(0, content.length - 1);

            document.getElementById("message").value =result9;
            location.replace('http://localhost/shopbanhanglaravel/search-voice/'+result9);


        };

        recognition.onspeechend = function() {
            recognition.stop();
            var res = document.getElementById("microphone");
            res.style.color = "white";
        };

        recognition.onerror = function(event) {
            var res = document.getElementById("microphone");
            res.style.color = "white";
            message.textContent = 'Error occurred in recognition: ' + event.error;
        }

        document.querySelector('#btnTalk').addEventListener('click', function(){
            recognition.start();
            var res = document.getElementById("microphone");
            res.style.color = "red";
        });
    </script>
                    </div>
                    
                    
                    <div class="col-xs-3">
                        <div class="shop-menu pull-right">
                            
                            
                            <div class="dropdown2">
                              <a class="gioo-hang" style="background-color: #2E64FE;color: white;font-size: 35px;" href="{{URL::to('/gio-hang')}}"><i style="color: white;" class="fa fa-shopping-cart"></i>
                                
                                    
                                    
                                    @if(session::get('cart') == true)
                                        @php
                                            $i=0;
                                        @endphp

                                        @foreach(Session::get('cart') as $key => $cart)
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <sup class="cart-num" id="cart-num">
                                        {{$i}}
                                        </sup>

                                    @else
                                        <sup class="cart-num">
                                        0
                                        </sup>
                                    @endif
                                    
                                </a>
                                

                                <div class="dropdown-content2" style="right:0;border-radius: 15px;max-height: 400px;
                                    overflow-y: scroll;">


                                    @if(session::get('cart') == true)

                                        <table>
                                        @foreach(session::get('cart') as $key => $cart)

                                            <tr>
                                        <td>
                                            <a href="{{URL::to('/chi-tiet')}}/{{$cart['product_slug']}}">
                                        
                                                <img  src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="50" height="50" alt="{{$cart['product_name']}}" />
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{URL::to('/chi-tiet')}}/{{$cart['product_slug']}}">

                                            <h5 class="product_name_p">{{$cart['product_name']}} </h5>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{URL::to('/chi-tiet')}}/{{$cart['product_slug']}}">

                                            {{$cart['product_qty']}} x {{number_format($cart['product_price'],0,',','.')}}đ
                                        </a>
                                        </td>
                                    </tr>


                                        @endforeach
                                        </table>

                                        @php
                                            $total = 0;
                                        @endphp


                                        @foreach(Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price']*$cart['product_qty'];
                                                $total+=$subtotal;
                                            @endphp

                                        @endforeach
                                    

                                        <p class="pull-right" style="color: red;font-weight: bold;"> 
                                        {{number_format($total,0,',','.')}}đ
                                        </p>
                                    @else
                                    <h3>Giỏ hàng trống</h3>
                                    @endif

                                </div>
                            </div>

                            
                           
                           

                           


                        </div>

                    </div>
                    
                        
                   
                    
               
                 </div>

                

            </div>

                        

        </div><!--/header-middle-->
    
        
    </header><!--/header-->
    
    


    


    
    <section>
        <div class="container">
            <div class="row">
               
                
                <div class="col-xs-12">

                   @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    
                   
                    </div>
                    <div class="col-xs-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  @extends('js')

</body>
</html>