@extends('admin_layout')
@section('admin_content')

<ul class="nav nav-tabs nav-justified" >
      <li class="dropdown">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"  style="font-size: 20px;font-weight: bold;">
           ...
        </a>
        <ul class="dropdown-menu">
          <!--
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
          -->

          @foreach($order_status as $key => $os)
        @if( $os->TrangThaiDonHang_id==6 || $os->TrangThaiDonHang_id==7 || $os->TrangThaiDonHang_id==9 || $os->TrangThaiDonHang_id==10 || $os->TrangThaiDonHang_id==3 )

                <li >
                    <a href="{{URL::to('/manage-order/'.$os->TrangThaiDonHang_id)}}">{{$os->TrangThaiDonHang_Ten}}
                      @php 
                        $jj = 0;
                        @endphp

                        @foreach($customer_order_all as $key => $customer_order3)
                            @if ($os->TrangThaiDonHang_id==$customer_order3->TrangThaiDonHang_id)

                                @php 
                                  $jj++;
                                 @endphp
                                              
                          @endif
                        @endforeach
                        ({{$jj}})
                    </a>
                </li>
                @endif
            @endforeach




        </ul>
    </li>

     

    <li>
      @if($order_status_id== -99)
      <a class="btn btn-info active" style="font-size: 20px;color: white;font-weight: bold;border-bottom: 4px solid green;" href="{{URL::to('/manage-order2')}}">Tất cả
      </a>
      @else
        <a class="btn btn-info" style="font-size: 20px;color: white;font-weight: bold;" href="{{URL::to('/manage-order2')}}">Tất cả
        </a>
      @endif
  </li>

      

      @foreach($order_status as $key => $os)
                @if($os->TrangThaiDonHang_id==2 || $os->TrangThaiDonHang_id==1   || $os->TrangThaiDonHang_id==4 || $os->TrangThaiDonHang_id==5  ||$os->TrangThaiDonHang_id==8)
            <li >
              

          @if($os->TrangThaiDonHang_id == $order_status_id)

            <a class="btn btn-info active" style="font-size: 20px;color: white;font-weight: bold;border-bottom: 4px solid green;" href="{{URL::to('/manage-order/'.$os->TrangThaiDonHang_id)}}">

          
          @else
            <a class="btn btn-info" style="font-size: 20px;color: white;font-weight: bold;" href="{{URL::to('/manage-order/'.$os->TrangThaiDonHang_id)}}">
          @endif
        
                
                  @if( $os->TrangThaiDonHang_id==5  )
                    Đã giao
                  @elseif( $os->TrangThaiDonHang_id==8  )
                    Hoàn thành
                  @elseif( $os->TrangThaiDonHang_id==2  )
                    Đã xác nhận
                  @else
                  {{$os->TrangThaiDonHang_Ten}}
                  @endif

                  @php 
                    $jj = 0;
                    @endphp

                    @foreach($customer_order_all as $key => $customer_order3)
                        @if ($os->TrangThaiDonHang_id==$customer_order3->TrangThaiDonHang_id)

                            @php 
                              $jj++;
                            @endphp
                                              
                      @endif
                    @endforeach
                    ({{$jj}})
                
                </a>
            </li>
                     @endif
                @endforeach




    </ul>
<br><br>
<form action="{{URL::to('/search-od')}}" method="POST" class="pull-right">
  @csrf 
  <input type="text" name="order_code" placeholder="Nhập mã đơn hàng" />
  <button type="submit">Tìm</button>
</form>



<br>
<ul class="pagination pagination-sm m-t-none m-b-none">
{{ $customer_order->links() }}
</ul>

@foreach($order_status as $key => $os2)

  @if($os2->TrangThaiDonHang_id == $order_status_id)
  @if( $os2->TrangThaiDonHang_id==6 || $os2->TrangThaiDonHang_id==7 || $os2->TrangThaiDonHang_id==9 || $os2->TrangThaiDonHang_id==10 || $os2->TrangThaiDonHang_id==3 )
      <center><h3 class="h11">{{$os2->TrangThaiDonHang_Ten}} </h3> </center>

  @endif
  @endif
@endforeach
  

  

@foreach($customer_order as $key => $customer_order)

  @if($customer_order->AdminDaXem == 1)
    <div class="all-your-order-table3" style="background-color: #F2F2F2;border-radius: 25px;">
  @endif

  @if($customer_order->AdminDaXem == 0)
    <div class="all-your-order-table3" style="background-color: #CEECF5;border-radius: 25px;">
  @endif

  <table class="your-order" >
    <tr>
      <td>
        <h3 class="text-primary text-bold">
        Đơn hàng: {{$customer_order->DonHang_Ma }}

        

        </h3>
      </td>

      <td >
        <h4>
          Ngày đặt hàng: {{$customer_order->ThoiGianTao }}
        </h4>
      </td>

      <td >
        <center>
        
        <a href="{{URL::to('/view-order/'.$customer_order->DonHang_Ma)}}"class=" btn btn-info btn-sm" style="font-size: 15px;">
          Xem chi tiết
        </a>

        @if($customer_order->PhuongThucThanhToan == 1)
          <h4 class="text-info">Thanh toán khi nhận hàng</h4>
        @else
          <h4 class="text-primary">Đã thanh toán online</h4>
        @endif
        </center>
      </td>
    </tr>
    <tr>
  

  @foreach ($order_status as $key => $os_status)
  @if ($customer_order->TrangThaiDonHang_id == $os_status->TrangThaiDonHang_id )

    <td style="display: inline;"> 
        
        @if ($customer_order->TrangThaiDonHang_id == 8 )
        <center>
        <i style="font-size: 20px;color:green;" class="fa fa-check-circle" aria-hidden="true">
          {{$os_status->TrangThaiDonHang_Ten}}
        </i>
        </center>

        @else
          <center>
          <h4 style="color: blue">{{$os_status->TrangThaiDonHang_Ten}}</h4>
          </center>
        @endif
      
    </td>
    <td><h4>Cập nhật: {{$customer_order->updated_at }}</h4> </td>

  
    
  @endif
  @endforeach
  <td>
      @if ($customer_order->TrangThaiDonHang_id == 5 )
        
      @endif
      @if ($customer_order->TrangThaiDonHang_id == 8 )
        
        
      @endif
  </td>

  </tr>
  </table>
  <br>








<table  class="your-order-table" >
    
  
    @php 
          
          $subtotal =0;
          $total =0;
         @endphp


@foreach($customer_order_detail as $key => $cod)
    @if($cod->DonHang_Ma == $customer_order->DonHang_Ma)
      @php 
          
            $subtotal = $cod->DonGia_CTDH*$cod->SoLuongBan_CTDH;
            $total+=$subtotal;
          @endphp

         @endif


  
  @if ($cod->DonHang_Ma == $customer_order->DonHang_Ma )
    
    <tr>
      
    
          @foreach($product as $key => $pro)
            @if($pro->SanPham_id == $cod->SanPham_id)
              <td >
                <a href="{{URL::to('/chi-tiet')}}/{{$pro->SanPham_slug}}"><img src="{{url('/public/uploads/product/')}} /{{$pro->SanPham_AnhChinh}}" height="70" width="70" alt="avatar" /></a> 

               </td>

            @endif

          @endforeach

     
    <td width='500'> {{$cod->SanPham_Ten_CTDH }}
      <br>
      x {{$cod->SoLuongBan_CTDH}}
    </td>

    <td width='100' style="color: #DF0101;"> 
      
      {{number_format($cod->DonGia_CTDH,0,',','.')}}đ  
    </td>

   
    <!-- @if ($customer_order->TrangThaiDonHang_id == 8 )
        

    @endif -->



    </tr>

    <input type="hidden" min="1"  class="order_qty_{{$cod->DonHang_id}}" value="{{$cod->SoLuongBan_CTDH}}" >

    <input type="hidden"   class="order_code_{{$cod->DonHang_id}}" value="{{$cod->DonHang_Ma}}" >

        

    <input type="hidden"  class="order_product_id_{{$cod->DonHang_id}}" value="{{$cod->SanPham_id}}">
    @php
      $co= $customer_order->MaGiamGia_Ma;
      $fee = $customer_order->DonHang_PhiVanChuyen;
    @endphp
  
  @endif

  
              
  @endforeach
</table>
<div class="text-right" style="font-size: 20px;">
  

  @if($co != null )
          @php
              $x = $total + $customer_order->DonHang_PhiVanChuyen - $customer_order->TongTien;

              
          @endphp
          
  @endif

  @if($co ==null)
    Phí ship : {{number_format($fee,0,',','.')}}đ</br> 
              Thanh toán: {{number_format($total,0,',','.')}}đ <br>
               Tổng : {{number_format($customer_order->TongTien,0,',','.')}}đ
  @else
    Phí ship : {{number_format($fee,0,',','.')}}đ</br> 
              Thanh toán: {{number_format($total,0,',','.')}}đ <br>
              Mã giảm giá {{$co}}:  {{number_format($x,0,',','.')}}đ <br>
               Tổng : {{number_format($customer_order->TongTien,0,',','.')}}đ
             
  @endif

</div>



<div class="container">
  <div class="row">
    @if (!Auth::user()->hasAnyRoles(['order','admin']) || !Auth::user()->hasAnyRoles(['update','admin'])) 
        
        <center><h2>...</h2></center>
    @else
        
    <div class="col-sm-3">
      @if($customer_order->TrangThaiDonHang_id ==1 )
                  <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    <option id="{{$customer_order->DonHang_id}}" value="2">Xác nhận</option>
                    
                  </select>
                </form>
                @endif
                @if($customer_order->TrangThaiDonHang_id ==2 )
                  <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    
                    <option id="{{$customer_order->DonHang_id}}" value="3">Đã giao cho đơn vị vận chuyển</option>
                    <option id="{{$customer_order->DonHang_id}}" value="4">Đang giao</option>
                  </select>
                </form>
                @endif
                @if($customer_order->TrangThaiDonHang_id ==3 )
                  <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    <option id="{{$customer_order->DonHang_id}}" value="4">Đang giao hàng</option>
                    
                  </select>
                </form>
                @endif
                 @if($customer_order->TrangThaiDonHang_id ==4 )
                  <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    <option id="{{$customer_order->DonHang_id}}" value="5">Đã giao hàng</option>
                    
                  </select>
                </form>
                @endif
                @if($customer_order->TrangThaiDonHang_id ==5 )
                  <?php 
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    $time = strtotime($customer_order->updated_at);
                   $time2 = date("Y-m-d h:i:s",$time+86400);

                   $now = date("Y-m-d h:i:s", time());

                   // echo ("now:" .$now);
                   // echo "<br>";
                   // echo $time2;
                    
                  ?>
                  @if ($time2 < $now)
                    
                  
                  
                  <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    <option id="{{$customer_order->DonHang_id}}" value="8">Hoàn tất đơn hàng</option>
                    
                  </select>
                </form>
                @endif
                @endif

                

                @if($customer_order->TrangThaiDonHang_id ==10)
                <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    
                    
                    <option id="{{$customer_order->DonHang_id}}" value="7">Đã hủy đơn hàng</option>
                    
                  </select>
                </form>


                @endif


                @if($customer_order->TrangThaiDonHang_id ==9)
                <form>
                   @csrf
                  <select class="form-control order_details" style="font-size:15px;font-weight: bold;border-color: rgba(201, 76, 76, 0.3);color: green">
                    <option selected value="">----Xử lý đơn hàng----</option>
                    
                    <option id="{{$customer_order->DonHang_id}}" value="6">Đã trả hàng</option>
                    <option id="{{$customer_order->DonHang_id}}" value="8">Hoàn tất đơn hàng</option>
                    
                  </select>
                </form>


                @endif
       @endif
            <!-- @if($customer_order->TrangThaiDonHang_id ==1)
              <form>
                   @csrf
                   
                  
          
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   

                 <p data-order_status="2" data-action_name="Bạn muốn hủy đơn hàng này ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Xác nhận</p>

                 <a href="#" class="cancel-order-pose">aaa</a>
                  
                </form>

                
                
            
            @elseif($customer_order->TrangThaiDonHang_id ==2)
              <form>
                   @csrf
                   
                  <
          
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


                   <p data-order_status="10" data-action_name="Yêu cầu hủy đơn hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Yêu cầu hủy đơn hàng</p>
                  
                </form>
            @else
            <p> </p>
            @endif -->
        </div>
            
    <div class="col-sm-3">
        <!-- @if($customer_order->TrangThaiDonHang_id ==5)
        
              <form>
                   @csrf
                   
                  
          
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


                   <p data-order_status="9" data-action_name="Yêu cầu trả hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Yêu cầu trả hàng</p>
                  
                </form>
                @endif -->
        </div>

        <div class="col-sm-3">
             <!--  @if($customer_order->TrangThaiDonHang_id ==5)
                <form>
                   @csrf
                   
                  
          
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


                   <p data-order_status="8" data-action_name="Bạn đã nhận được hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-success cancel-order-pose" style="color: white;">Đã nhận hàng</p>
                  
                </form>
              
            @endif -->
        </div>

     </div>
  
</div>
</div>


      <br>
             <hr class="hr_oder" />

@endforeach       

@endsection