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
    <link href="{{asset('public/frontend/css/style7.css')}}" rel="stylesheet">
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
</head><!--/head-->

<body>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 0919053390</a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li>
                               @if(Session::get('customer_name'))
                               
                               
                               <a href="#"><img style="border-radius: 25px;" src="{{url('/public/uploads/profile/')}} /{{Session::get('customer_image')}}" height="40" width="40" alt="avatar" /></a>
                                
                                </li>
                                
                                
                                <li  class="dropdown"><a href="#">
                                    
                                    {{Session::get('customer_name')}}

                                    <i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        
                                        <li><a href="{{URL::to('/thong-tin-ca-nhan')}}"></i>Thông tin cá nhân</a></li>
                                        <li><a href="{{URL::to('/your-order')}}"></i>Xem đơn hàng</a></li>
                                        <li ><a href="{{URL::to('/yeu-thich')}}">Danh sách yêu thích</a></li>
                                        
                                        <li><a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                                        
                                    </ul>
                                </li> 
                                @else
                                <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <li><a href="{{URL::to('/dang-ky')}}"><i class="fa fa-lock"></i> Đăng ký</a></li>
                                @endif



                            </ul>
                        </div>
                    </div>


                    
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo pull-left">
                            <a style="font-size: 30px;color: white;" href="{{URL::to('/trang-chu')}}">
                                <img src="{{url('/public/frontend/images/NDTSHOP-COOLTEXT2.png')}}" height="70" width="200" alt="" /> 
                                

                            </a>
                        </div>
                      
                    </div>
                    <div class="col-sm-6">
                        <center>
                        <form action="{{URL::to('/tim-kiem')}}" method="POST" class="searchform">
                                        {{csrf_field()}}
                                    
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" style="width: 80%" />

                            <input type="submit" style="margin-top:0;color:white; width: 15%" name="search_items" class="btn btn-primary btn-sm" value="Tìm">

                                    
                                    </form>

                        
                        </center>

                        
                    </div>
                    <div class="col-sm-1">
                        
                    </div>
                    <div class="col-sm-2">
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

                                        ({{$i}})

                                    @endif

                                   

                                </a>
                              <div class="dropdown-content2" style="right:0;">
                                @php
                                        $i=0;
                                @endphp

                                @if(session::get('cart') == true)
                                @foreach(session::get('cart') as $key => $cart)
                                    @if($i<=4)
                                    <a href="{{URL::to('/chi-tiet')}}/{{$cart['product_slug']}}">
                                        
                                        <img  src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="30" height="30" alt="{{$cart['product_name']}}" />

                                        
        <p class="product_name_p">{{$cart['product_name']}} </p>
        {{$cart['product_qty']}} x {{number_format($cart['product_price'],0,',','.')}}đ
                                    


                                    </a>





                                    @if($i==4)
                                       <center> <h2>...</h2> </center>
                                    @endif

                                    @php
                                        $i++;
                                    @endphp

                                    @endif
                                @endforeach
                                @endif


                                @if(Session::get('cart')==true)
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

                                @endif
                                   
                              </div>
                            </div>

                            
                           
                           

                           


                        </div>

                    </div>
                </div>

                

            </div>

                        

        </div><!--/header-middle-->
    
        
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <br>
    <center>
        <div class="container">

            <div class="row">
                <div class="col-sm-9">
                    <center>
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <!--
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                            <li data-target="#slider-carousel" data-slide-to="4"></li>
                            -->
                        @php 
                            $k = 0;
                        @endphp
                        @foreach($slider as $key => $sli)
                            <li data-target="#slider-carousel" data-slide-to="{{$k}}" ></li>
                            @php 
                                $k++;
                            @endphp

                        @endforeach


                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 300px;
                            }
                        </style>
                        <div class="carousel-inner">
                        @php 
                            $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                            @php 
                                $i++;
                            @endphp

                            <div class="item {{$i==1 ? 'active' : '' }}">
                                
                                
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}"  class="img img-responsive img-slider" width="100%">
                                
                                
                            </div>

                        @endforeach  
                          
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </center>
                    
                </div>

                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/b1.png')}}" height="300" width="100%" alt="" />
                </div>
            </div>
            <br>
            <div class="row">
                
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                

                
            </div>



        </div>


        </center>
    </section><!--/slider-->

    <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                
                               
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                       
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->


    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                          @foreach($category as $key => $cate)
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc/'.$cate->slug_category_product)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                        @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                     
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">

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
                    <div class="col-sm-3">
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
                    <div class="col-sm-2">
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
                    <div class="col-sm-2">
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
                    <div class="col-sm-2">
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
                    <div class="col-sm-2">
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
                    <div class="col-sm-3 col-sm-offset-1">
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