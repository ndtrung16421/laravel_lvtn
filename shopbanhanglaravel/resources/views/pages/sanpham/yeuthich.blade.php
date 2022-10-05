@extends('layout_not_slider')
@section('content')
<div class="features_items"><!--features_items-->
                        <br><br>
                        <h2 class="title text-center">Danh mục yêu thích</h2>
                        
    @foreach($all_product as $key => $product)

        @foreach($tbl_wishlist as $key=> $tbl_wl)

            @if($tbl_wl->SanPham_id== $product->SanPham_id)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                           
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form style="align-content: center;">
                                                @csrf
                                            <input type="hidden" value="{{session::get('customer_id')}}" class="customer_id">
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
            @endif
        @endforeach


    @endforeach
                    </div><!--features_items-->
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$tbl_wishlist->links()!!}
                      </ul>
        <!--/recommended_items-->
@endsection