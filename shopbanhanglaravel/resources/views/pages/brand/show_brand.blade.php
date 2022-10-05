@extends('layout_not_slider')
@section('content')
<div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                   <nav class="navbar navbar-default"  >

                      <div class="container-fluid" >
                        <div class="navbar-header">

                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                          </button>
                         
                        </div>

                        <div class="collapse navbar-collapse" id="myNavbar" style="max-height: 2200px!important;">
                          <ul class="nav navbar-nav">
                            <!-- <li ><a href="#">Home</a></li> -->

                            <li class="dropdown">
                                
                                  <a class="btn btn-info" style="font-size: 15px;font-weight: bold;color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#">Danh mục sản phẩm 
                                    <span class="caret"></span>
                                  </a>

                              <ul class="dropdown-menu">
                                @foreach($category as $key => $cate)
                           
                            
                                <li>
                                    <a class="panel-title"><a href="{{URL::to('/danh-muc/'.$cate->DanhMuc_slug)}}" class="btn btn-info" style="font-size: 20px;font-weight: bold;color: white;">{{$cate->DanhMuc_Ten}}</a>
                                </li>
                               
                                @endforeach
                              </ul>
                            </li>

                            <li class="dropdown">
                                <a class="btn btn-info" style="font-size: 15px;font-weight: bold;color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Thương hiệu sản phẩm 
                                    <span class="caret"></span>
                                </a>
                              <ul class="dropdown-menu">
                                    @foreach($brand as $key => $brand)
                                        <li>
                                            <a href="{{URL::to('/thuong-hieu/'.$brand->ThuongHieu_slug)}}" class="btn btn-info" style="font-size: 20px;font-weight: bold;color: white;"> {{$brand->ThuongHieu_Ten}}
                                            </a>
                                        </li>
                                    @endforeach
                              </ul>
                            </li>

                            
                          </ul>
                          
                          <ul class="nav navbar-nav navbar-right">
                             <!-- <li>
                                  <form>
                                    @csrf
                                    <input type="hidden" value="{{session::get('customer_id')}}" name="customer_id">

                                       

                                    <div class="dropdown11">
                                        <a href="#" onclick="myFunction()" class="fa fa-bell dropbtn11">
                                            <sup class="cart-num" id="nou-num" style="color: white!important;">
                                                
                                            </sup>
                                        </a>

                                        <div id="myDropdown11" class="dropdown-content11" style="width: 350px; max-height:500px !important;overflow-y:scroll!important;right: 0!important;">
                                                
                                          </div>
                                    </div>


                                
                                    </form>
                              </li>
                            <li class="dropdown">
                                
                                <button class="btn btn-info dropdown-toggle"  data-toggle="dropdown">
                                        <img style="border-radius: 25px;" src="{{url('/public/uploads/profile/')}} /{{Session::get('customer_image')}}" height="30" width="30" alt="avatar" />
                                            {{Session::get('customer_name')}}
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
                            </li> -->
                            <li>
                                
                                <div class="dropdown">
                                  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp
                                  <span class="caret">
                                      
                                  </span></button>

                                  <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{URL::to('/thuong-hieu-sx/'.$brand_slug,$od='ASC')}}"  >
                                            Giá tăng dần
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/thuong-hieu-sx/'.$brand_slug,$od='DESC')}}"  >
                                            Giá giảm dần
                                        </a>
                                    </li>
                                    
                                  </ul>
                                </div>
                            </li>

                            <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
            </div>
        </div><!--/header-bottom-->
<div class="features_items"><!--features_items-->

                        @foreach($brand_name as $key => $name)
                       
                        <h2 class="title text-center">{{$name->ThuongHieu_Ten}}</h2>

                        @endforeach
                        @foreach($brand_by_id as $key => $product)
                         <div class="col-sm-4">
                            <div class="product-image-wrapper">
                           
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form style="align-content: center;">
                                                @csrf
                                            <input type="hidden" value="{{session::get('KhachHang_id')}}" class="customer_id">
                                            <input type="hidden" value="{{$product->SanPham_id}}" class="cart_product_id_{{$product->SanPham_id}}">


                                            <input type="hidden" value="{{$product->SanPham_Ten}}" class="cart_product_name_{{$product->SanPham_id}}">
                                          
                                            <input type="hidden" value="{{$product->SanPham_SoLuong}}" class="cart_product_quantity_{{$product->SanPham_id}}">
                                            
                                            <input type="hidden" value="{{$product->SanPham_AnhChinh}}" class="cart_product_image_{{$product->SanPham_id}}">


                                            <input type="hidden" value="{{$product->SanPham_Gia}}" class="cart_product_price_{{$product->SanPham_id}}">

                                            <input type="hidden" value="{{$product->SanPham_slug}}" class="cart_product_slug_{{$product->SanPham_id}}">


                                            

                                            <a href="{{URL::to('/chi-tiet/'.$product->SanPham_slug)}}">
                                                <img  src="{{URL::to('public/uploads/product/'.$product->SanPham_AnhChinh)}}" alt="" />
                                                <h2>{{number_format($product->SanPham_Gia,0,',','.').' '.'VNĐ'}}</h2>
                                                <p class="product_name_p">{{$product->SanPham_Ten}}</p>
                                                <p class="star-p">
                                                    @php
                                                        $total_pro = 0;
                                                        $total_start = 0;
                                                    @endphp

                                                    @foreach($rating_product as $key => $rating_pro)

                                                        @php
                                                            if($rating_pro->SanPham_id == $product->SanPham_id) {

                                                                $total_start += $rating_pro->DanhGiaSP_start ;
                                                                $total_pro++;

                                                            }

                                                        @endphp

                                                    @endforeach

                                                        @php
                                                            if($total_pro == 0)
                                                                $total_pro = 1;
                                                        @endphp

                                                    
                                                    {{number_format($total_start /$total_pro,2,',','.').' '.''}}<i class="fa fa-star"></i>
                                                </p>

                                             
                                             </a>
                                             
                                             

                                            <input style="
                                              " 




                                            type="button" value="Thêm giỏ hàng" class="add-to-cart" data-id_product="{{$product->SanPham_id}}" name="add-to-cart">



                                            
                                            
                                        </div>
                                        <center>
                                        
                                        </center>
                                      
                                </div>
                           
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">

                            @if(session::get('KhachHang_id'))

                                    
                                        
                                        @php
                                            $w=0;
                                        @endphp
                                    @foreach($tbl_wishlist as $key=> $tbl_wl)

                                        @if($tbl_wl->SanPham_id == $product->SanPham_id)
                                            @php
                                                $w=1;
                                            @endphp
                                        @endif
                                    @endforeach

                                        <li></li>
                                        @if($w ==0)

                                        <li class="add-wishlist" data-id_product="{{$product->SanPham_id}}" >
                                             <input type="button" value="Yêu thích" class="btn btn-info btn-sm">
                                        </li>
                                        @else

                                        <li  class="delete-wishlist" data-id_product="{{$product->SanPham_id}}">
                                             <input type="button" value="Xóa yêu thích" class="btn btn-info btn-sm disabled">
                                        </li>

                                        @endif
                            
                            @else
                                <li></li>
                                <li class="login-add-wishlist" >
                                             <input type="button" value="Yêu thích" class="btn btn-info btn-sm">
                                </li>
                            @endif

                                        
                                        <li><input style="height:40px;width: 60px;font-size: 20px;" id="number_1" type="number" min="1" value="1" class="cart_product_qty_{{$product->SanPham_id}}"></li>
                                    </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$brand_by_id->links()!!}
                      </ul>

        <!--/recommended_items-->
@endsection