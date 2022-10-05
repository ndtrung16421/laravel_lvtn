@extends('layout_not_slider')



@section('content')
<div style="height: 100px;" class="row">
	<a href="{{URL::to('/')}}">
		<i class="fa fa-home" style="font-size: 30px;"></i>
		Trang chủ / Đơn hàng của bạn
	</a>
	
</div>


    <ul class="nav nav-tabs nav-justified" >
    	<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="font-size: 20px;color: black;font-weight: bold;">
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
		                <a href="{{URL::to('/your-order2/'.$os->TrangThaiDonHang_id)}}">{{$os->TrangThaiDonHang_Ten}}
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
    	<a class="btn btn-info active" style="font-size: 20px;color: white;font-weight: bold;border-bottom: 4px solid green;" href="{{URL::to('/your-order')}}">Tất cả
    	</a>
    	@else
    		<a class="btn btn-info" style="font-size: 20px;color: white;font-weight: bold;" href="{{URL::to('/your-order')}}">Tất cả
    		</a>
    	@endif
	</li>

      

      @foreach($order_status as $key => $os)
                @if($os->TrangThaiDonHang_id==2 || $os->TrangThaiDonHang_id==1   || $os->TrangThaiDonHang_id==4 || $os->TrangThaiDonHang_id==5  ||$os->TrangThaiDonHang_id==8)
            <li >
            	

					@if($os->TrangThaiDonHang_id == $order_status_id)

						<a class="btn btn-info active" style="font-size: 20px;color: white;font-weight: bold;border-bottom: 4px solid green;" href="{{URL::to('/your-order2/'.$os->TrangThaiDonHang_id)}}">

					
					@else
						<a class="btn btn-info" style="font-size: 20px;color: white;font-weight: bold;" href="{{URL::to('/your-order2/'.$os->TrangThaiDonHang_id)}}">
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
<form action="{{URL::to('/search-od-customer')}}" method="POST" class=" pull-right">
  @csrf 
  <input type="text" name="order_code" placeholder="Nhập mã đơn hàng" />
  <button class="btn btn-success" type="submit">Tìm</button>
</form>
<br>




<ul class="pagination pagination-sm m-t-none m-b-none">
{{ $customer_order->links() }}
</ul>
<center>
@foreach($order_status as $key => $os2)

	@if($os2->TrangThaiDonHang_id == $order_status_id)
	@if( $os2->TrangThaiDonHang_id==6 || $os2->TrangThaiDonHang_id==7 || $os2->TrangThaiDonHang_id==9 || $os2->TrangThaiDonHang_id==10 || $os2->TrangThaiDonHang_id==3 )
			<center><h3 class="h11">{{$os2->TrangThaiDonHang_Ten}} </h3> </center>

	@endif
	@endif
@endforeach
	



@foreach($customer_order as $key => $customer_order)

	@if($customer_order->KhachHangDaXem == 1)
		<div  style="background-color: #F2F2F2; border-radius: 25px;box-shadow: 3px 3px ">
	@endif

	@if($customer_order->KhachHangDaXem == 0)
		<div  style="background-color: #CEECF5; border-radius: 25px;box-shadow: 3px 3px ">
	@endif

	<table  style="background-color: ;width: 100%;border-radius: 20px;color: ;box-shadow: 10px;">
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
				
				<a href="{{URL::to('/view-order-customer/'.$customer_order->DonHang_Ma)}}"class=" btn btn-info btn-sm" style="font-size: 15px;">
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
	<hr class="hr_oder">

	<table style="font-size: 20px;" >
		
	
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
			@if ($customer_order->TrangThaiDonHang_id == 1 )
			<br>
			x {{$cod->SoLuongBan_CTDH}}
			@endif
		</td>

		@if ($customer_order->TrangThaiDonHang_id == 1 )
		<td >

			<input style="width: 60px !important;" type="number" min="1"  class="quan_{{$customer_order->DonHang_Ma}}" value="{{$cod->SoLuongBan_CTDH}}" name="product_sales_quantity_{{$customer_order->DonHang_Ma}}" >
			x &nbsp;
		</td>
		@else
			<td>
			<input style="width: 60px !important;" type="hidden" min="1"  class="quan_{{$customer_order->DonHang_Ma}}" value="{{$cod->SoLuongBan_CTDH}}" name="product_sales_quantity_{{$customer_order->DonHang_Ma}}">

			{{$cod->SoLuongBan_CTDH}} x &nbsp;
			</td>
		@endif

		<td width='100' style="color: #DF0101;"> 
			
			{{number_format($cod->DonGia_CTDH,0,',','.')}}đ  
		</td>

		@php
			$diem=0;
		@endphp
		@if ($customer_order->TrangThaiDonHang_id == 8 )
				

				@foreach($tbl_rating as $key => $tbl_r)

					@if(($cod->DonHang_Ma == $tbl_r->DonHang_Ma )&& ($cod->SanPham_id == $tbl_r->SanPham_id ) && (session::get('KhachHang_id')==$tbl_r->KhachHang_id))
						@php
						$diem=1;
						@endphp
					@endif

				@endforeach

				@if ($diem == 0)
					<td>
						<a style="font-weight: bold;" class="btn-b" href="{{URL::to('/rating-product/'.$cod->SanPham_id,$cod->DonHang_Ma)}}">Đánh giá</a>
						</td>

				@else
					<td>

							



						@foreach($product as $key => $pro)
						@if($pro->SanPham_id == $cod->SanPham_id)
							
							<a   class="my-1 btn btn-success btn-block" href="{{URL::to('/chi-tiet/'.$pro->SanPham_slug)}}" >Xem đánh giá
							</a>

						@endif

						@endforeach
						

						



						</td>
				@endif





		@endif



		</tr>
		<tr>
			<td></td>
			<td >
				<hr class="hr-tr">
			</td>
			<td></td>
		</tr>

		

              		

        

        <input type="hidden" name="pro_id_{{$customer_order->DonHang_Ma}}" class="pro_id_{{$customer_order->DonHang_Ma}}" value="{{$cod->SanPham_id}}">
		
		@php
			$co= $customer_order->MaGiamGia_Ma;
			$fee = $customer_order->DonHang_PhiVanChuyen;
		@endphp    
	@endif

	
	        
	@endforeach
</table >

<div class="text-right" style="font-size: 20px;">
	@php
		$x=0;
	@endphp

	@if($co != null )
        	@php
        			$x = $total + $customer_order->DonHang_PhiVanChuyen - $customer_order->TongTien;

        			
        	@endphp
        	
	@endif
	

	@if($co ==null)
		Phí ship : {{number_format($fee,0,',','.')}}đ</br> 
	            Thanh toán: {{number_format($total,0,',','.')}}đ <br>
	    <h3 style="font-size: 20px;color: #FE2E2E;font-weight: bold;">
	             Tổng : {{number_format($customer_order->TongTien,0,',','.')}}đ
	    </h3>
	@else
		Phí ship : {{number_format($fee,0,',','.')}}đ</br> 
	            Thanh toán: {{number_format($total,0,',','.')}}đ <br>
	            Mã giảm giá {{$co}}: - {{number_format($x,0,',','.')}}đ <br>
	    <h3 style="font-size: 20px;color: #FE2E2E ;font-weight: bold;">     
	             Tổng : {{number_format($customer_order->TongTien,0,',','.')}}đ
	     </h3>
	           
	@endif

</div>
<div class="container">
	<div class="row">

		<div class="col-sm-3"> 
			 
            @if($customer_order->TrangThaiDonHang_id ==1)
            	<form>
                   @csrf
                   
                	
					
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   

              	 <p data-order_code="{{$customer_order->DonHang_Ma}}" data-order_status="7" data-action_name="Bạn muốn hủy đơn hàng này ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Hủy đơn hàng</p>
                  
                </form>


                

                
                
            
            @elseif($customer_order->TrangThaiDonHang_id ==2)
            	<form>
                   @csrf
                   
                	<
					
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


              		 <!-- <p data-order_code="{{$customer_order->DonHang_Ma}}" data-order_status="10" data-action_name="Yêu cầu hủy đơn hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Yêu cầu hủy đơn hàng</p> -->
                  
                </form>
            @else
            <p> </p>
            @endif
        </div>
        

        <div class="col-sm-3">
				@if($customer_order->TrangThaiDonHang_id ==5)
				
            	<form>
                   @csrf
                   
                	
					
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


              		 <p data-order_code="{{$customer_order->DonHang_Ma}}" data-order_status="9" data-action_name="Yêu cầu trả hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Yêu cầu trả hàng</p>
                  
                </form>
                @endif
       	</div>

       	<div class="col-sm-3">
            	@if($customer_order->TrangThaiDonHang_id ==5)
            	<!-- <form action="{{URL::to('/update-order-qty')}}" method="POST">
            		@csrf 
            		<input type="text" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">
            		<input type="text" name="order_status" class="order_status" value='8'>

            		<button type="submit" class="btn btn-default">Gửi</button>
            	</form> -->
                <form>
                   @csrf
                   
                	
					
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   


              		 <p data-order_code="{{$customer_order->DonHang_Ma}}" data-order_status="8" data-action_name="Bạn đã nhận được hàng ?" style="font-weight: bold;font-size: 20px;" class="btn btn-success cancel-order-pose" style="color: white;">Đã nhận hàng</p>
                  
                </form>
            	
            @endif

            @if($customer_order->TrangThaiDonHang_id ==1)
            	

        	
                <form>
                   @csrf
                   
                	
					
                   <input type="hidden" name="order_id" class="order_id" value="{{$customer_order->DonHang_id}}">

                   

              	 <p data-order_code="{{$customer_order->DonHang_Ma}}"  style="font-weight: bold;font-size: 20px;" class="btn btn-info update_quantity_order" style="color: white;"> Cập nhật SL</p>
                  
                </form>
            
        @endif
        </div>



</div>
</div>
	


</div>


 			<br>
             <br>
             

@endforeach
    

@endsection