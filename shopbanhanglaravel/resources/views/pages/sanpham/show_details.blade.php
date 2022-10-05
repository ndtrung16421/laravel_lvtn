@extends('layout_not_slider')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
  <div class="col-xs-6" style="background-color:#F2F2F2;">
    <center>
    <img class="xzoom" src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}" xoriginal="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}" width="80%"  />
    </center>
 

        <div class="xzoom-thumbs">

          <a href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}">

            <img class="xzoom-gallery" width="80" src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}"  xpreview="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}">

          </a>
          @foreach($ima as $key => $im)
            <a href="{{URL::to('/public/uploads/image_product/'.$im->HinhAnhSP_Ten)}}">

            <img class="xzoom-gallery" width="80" src="{{URL::to('/public/uploads/image_product/'.$im->HinhAnhSP_Ten)}}">

          </a>

          @endforeach



          

          

        </div>

              <!--
                <div class="dropdown11">
                  <button onclick="myFunction()" class="dropbtn11">Dropdown</button>
                  <div id="myDropdown11" class="dropdown-content11">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                  </div>
                </div>

              
                -->

                
                  <!-- <center>
                  <div class="content11">
                  <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh)}}" alt="" style="height: 300px;width: 270px;"></a>
                  
                  </div>
                  </center>
                <div id="similar-product" class="carousel slide" data-ride="carousel"> -->



                      
                  <!-- Wrapper for slides -->
                    <!-- <div class="carousel-inner">
                      

                    <div class="content11">
                      @if($value->SanPham_AnhChinh2)
                          
                        <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh2)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh2)}}" alt="" style="height:60px;width: 25%;"></a>
          
                        @endif
                        @if($value->SanPham_AnhChinh3)
                          
                        <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh3)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh3)}}" alt="" style="height:60px;width: 25%;"></a>
          
                        @endif
                        @if($value->SanPham_AnhChinh4)
                          
                        <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh4)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh4)}}" alt="" style="height:60px;width: 25%;"></a>
          
                        @endif
                    
        
                      @if($value->SanPham_AnhChinh5)
                          
                        <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh5)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh5)}}" alt="" style="height:60px;width: 25%;"></a>
          
                        @endif
                        @if($value->SanPham_AnhChinh6)
                          
                        <a data-fancybox="gallery" href="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh6)}}" data-caption="Caption for single image"><img src="{{URL::to('/public/uploads/product/'.$value->SanPham_AnhChinh6)}}" alt="" style="height:60px;width: 25%;"></a>
          
                        @endif
                          
                      
                    </div> -->
                        
                    
                    
                  

                  <!-- Controls -->
                  <!--
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                  </a>
                -->
              <!-- </div>

                
            </div> -->

  </div>

          
            <div class="col-xs-6">
              <div class="product-information" style="border: none!important;"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$value->SanPham_Ten}}</h2>
                <p>Mã ID: {{$value->SanPham_id}}</p>
                <img src="images/product-details/rating.png" alt="" />
                
                <form action="{{URL::to('/save-cart')}}" method="POST">
                  @csrf
                      <input type="hidden" value="{{$KhachHang_id}}" class="customer_id">
                      <input type="hidden" value="{{$value->SanPham_id}}" class="cart_product_id_{{$value->SanPham_id}}">
                      

                                            <input type="hidden" value="{{$value->SanPham_Ten}}" class="cart_product_name_{{$value->SanPham_id}}">

                                            <input type="hidden" value="{{$value->SanPham_AnhChinh}}" class="cart_product_image_{{$value->SanPham_id}}">

                                            <input type="hidden" value="{{$value->SanPham_SoLuong}}" class="cart_product_quantity_{{$value->SanPham_id}}">

                                            <input type="hidden" value="{{$value->SanPham_Gia}}" class="cart_product_price_{{$value->SanPham_id}}">

                                            <input type="hidden" value="{{$value->SanPham_slug}}" class="cart_product_slug_{{$value->SanPham_id}}">
                                          
                <span>
                  <span>{{number_format($value->SanPham_Gia,0,',','.').'VNĐ'}}</span>
                
                  <label>Số lượng:</label>
                  <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->SanPham_id}}"  value="1" />
                  <input name="productid_hidden" type="hidden"  value="{{$value->SanPham_id}}" />
                </span>
                <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->SanPham_id}}" name="add-to-cart">
              @if(session::get('KhachHang_id'))
                 @php
                                            $w=0;
                                        @endphp
                                    @foreach($tbl_wishlist as $key=> $tbl_wl)

                                        @if($tbl_wl->SanPham_id == $value->SanPham_id)
                                            @php
                                                $w=1;
                                            @endphp
                                        @endif
                                    @endforeach


                                        @if($w ==0)

                                        <p class="add-wishlist" data-id_product="{{$value->SanPham_id}}" >
                                             <input type="button" value="Yêu thích" class="btn btn-info btn-sm">
                                        </p>
                                        @else

                                        <p  class="delete-wishlist" data-id_product="{{$value->SanPham_id}}">
                                             <input type="button" value="Xóa yêu thích" class="btn btn-info btn-sm disabled">
                                        </p>

                                        @endif

                            @else
                                
                                <p class="login-add-wishlist" >
                                             <input type="button" value="Yêu thích" class="btn btn-info btn-sm">
                                </p>
                            @endif


                </form>

                <p><b>Tình trạng:</b> Còn hàng</p>
                <p><b>Điều kiện:</b> Mơi 100%</p>
                <p><b>Số lượng kho còn:</b> {{$value->SanPham_SoLuong}}</p>
                <p><b>Thương hiệu:</b> {{$value->ThuongHieu_Ten}}</p>
                <p><b>Danh mục:</b> {{$value->DanhMuc_Ten}}</p>
                <p><b>Đã bán:</b> {{$value->SanPham_SoLuong}}</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
              </div><!--/product-information-->
            </div>
</div><!--/product-details-->

          <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                
              
                <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade active in" id="details" >
                <p>{!!$value->SanPham_MoTa!!}</p>
                
              </div>
              
              
              
              <div class="tab-pane fade" id="reviews" >
                <div class="col-sm-12">
                  
                  <ul>
                    <h2><li  >{{$average_start}}<img src="{{url('/public/frontend/images/start.png')}} " height="20" width="20" alt="avatar" /></li></h2>
                    
                  </ul>


                  <ul>
                    
                    <!-- <li><a href=""><i class="fa fa-calendar-o"></i>
                      @php
                        echo date("Y-m-d");
                      @endphp


                    </a></li> -->
                  </ul>
                  <hr>
                  @foreach($rating_product as $key=>$rp)

                    
                  <table >
                    <tr>
                      
                        
                        @foreach($tbl_customers as $key=>$tbl_c)

                          @if($rp->KhachHang_id == $tbl_c->KhachHang_id)
                          <td >
                            <img src="{{url('/public/uploads/profile/')}} /{{$tbl_c->KhachHang_Anh}}" height="30" width="30" alt="avatar" />


                          
                          {{$tbl_c->KhachHang_Ten}}
                          </td>



                          @endif


                        @endforeach
                      
                        <tr>
                        <td>
                        @for($i=1; $i<=$rp->DanhGiaSP_start;$i++)
                          <img src="{{url('/public/frontend/images/start.png')}} " height="16" width="16" alt="avatar" />
                        @endfor
                        </td>
                        </tr>
                      
                    </tr>

                    <tr>
                      <td>
                        {{$rp->DanhGiaSP_NoiDung}}
                      </td>

                    </tr>
                    <tr>
                      <td>
                        @if($rp->DanhGiaSP_Anh1)
                        <a data-fancybox="rating_image" href="{{URL::to('/public/uploads/profile/')}} /{{$rp->DanhGiaSP_Anh1}}" data-caption="Caption for single image"><img src="{{url('/public/uploads/profile/')}}/{{$rp->DanhGiaSP_Anh1}}" alt="" style="height:70px;width: 70px;"></a>
                        @endif
                        @if($rp->DanhGiaSP_Anh2)
                        <a data-fancybox="rating_image" href="{{URL::to('/public/uploads/profile/')}} /{{$rp->DanhGiaSP_Anh2}}" data-caption="Caption for single image"><img src="{{url('/public/uploads/profile/')}}/{{$rp->DanhGiaSP_Anh2}}" alt="" style="height:70px;width:70px;"></a>
                        @endif
                        @if($rp->DanhGiaSP_Anh3)
                        <a data-fancybox="rating_image" href="{{URL::to('/public/uploads/profile/')}} /{{$rp->DanhGiaSP_Anh3}}" data-caption="Caption for single image"><img src="{{url('/public/uploads/profile/')}}/{{$rp->DanhGiaSP_Anh3}}" alt="" style="height:70px;width:70px;"></a>
                        @endif
                        
                      </td>
                      
                    </tr>
                    <tr>
                      <td>
                        {{$rp->ThoiGianTao}}
                      </td>
                    </tr>

                  </table>
                    <br>
                    <hr>
                  @endforeach




                  
                  
                </div>
              </div>
              
            </div>
          </div><!--/category-tab-->
  @endforeach
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Sản phẩm liên quan</h2>
            
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active">
              @foreach($relate as $key => $lienquan)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                       <div class="single-products">
                                            <div class="productinfo text-center product-related">
                                              <a href="{{URL::to('/chi-tiet/'.$lienquan->SanPham_slug)}}">
                                                  <img src="{{URL::to('public/uploads/product/'.$lienquan->SanPham_AnhChinh)}}" alt="" />
                                                  <h2>{{number_format($lienquan->SanPham_Gia,0,',','.').' '.'VNĐ'}}</h2>
                                                  <p>{{$lienquan->SanPham_Ten}}</p>
                                              </a>
                                             
                                            </div>
                                          
                                      </div>
                    </div>
                  </div>
              @endforeach   

                
                </div>
                  
              </div>
                  
            </div>
          </div><!--/recommended_items-->
          {{--   <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$relate->links()!!}
                      </ul> --}}

@endsection