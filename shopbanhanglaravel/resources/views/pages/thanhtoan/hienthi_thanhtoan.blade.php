@extends('layout_not_slider')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

					@if(session()->has('message'))
			                    <div class="alert alert-success">
			                        {!! session()->pull('message') !!}
			                    </div>
			                    	
			        @elseif(session()->has('error'))
			                     <div class="alert alert-danger">
			                        {!! session()->pull('error') !!}
			                    </div>

			        @endif

	
<div class="row">
	<div class="col-xs-12 ">

        	



					
				


        
							<form class="ln" style="width: 70%" action="{{URL::to('/save-customer2')}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                             
                               
                            
                            <label>Số điện thoại</label>
                            <input type="text" name="customer_phone" value="{{$profile->KhachHang_SDT}}"/>
                            
                            

                             
                              <center><label>---Địa chỉ hiện tại---</label></center>


                           

                            <input type="hidden" name="address_id" value="{{$address_info->DiaChi_id}}">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">
                                        @foreach($city as $key=>$ci)
                                            @if($ci->TinhThanhPho_id == $tinh_info->TinhThanhPho_id)
                                                {{$ci->TinhThanhPho_Ten}}
                                            @endif
                                        @endforeach

                                    </label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city2">
                                    
                                            <option selected value="{{$tinh_info->TinhThanhPho_id}}">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->TinhThanhPho_id}}">{{$ci->TinhThanhPho_Ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">
                                         @foreach($quan as $key=>$q)
                                            @if($q->QuanHuyen_id == $huyen_info->QuanHuyen_id)
                                                {{$q->QuanHuyen_Ten}}
                                            @endif
                                        @endforeach

                                    </label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province2 choose">
                                            <option selected value="{{$huyen_info->QuanHuyen_id}}">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">
                                     @foreach($xa as $key=>$ci)
                                            @if($ci->XaPhuong_id == $xa_info->XaPhuong_id)
                                                {{$ci->XaPhuong_Ten}}
                                            @endif
                                        @endforeach
                                </label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards2">
                                            <option selected value="{{$address_info->XaPhuong_id}}">--Chọn xã phường--</option>   
                                    </select>
                                </div>

                                <label>Địa chỉ chi tiết</label>
                                <textarea rows="5"  name="customer_address" > {{$address_info->DiaChi_Ten}}
                                </textarea>
                                 <button id="fee" type="submit" class="btn btn-default"   onclick="return confirm('Lưu thay đổi?');">Cập nhật</button>
                                 
                            </form>

				</div>
				<div class="dropdown">
				  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Thêm địa chỉ
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu" style="width: auto;">
				    <form  style="width:auto;" action="{{URL::to('/add-address')}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                             
                               
                            
                                <div class="form-group">
                                    
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose2 city2">
                                    
                                            <option selected value="">--Chọn tỉnh thành phố--</option>
                                            @foreach($city as $key => $ci)
                                            <option value="{{$ci->TinhThanhPho_id}}">{{$ci->TinhThanhPho_Ten}}--{{$ci->TinhThanhPho_id}}</option>
                                        	@endforeach
                                        
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    
                                      <select name="province" id="province2" class="form-control input-sm m-bot15 province2 choose2">
                                            <option selected value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                   
                                      <select name="wards" id="wards2" class="form-control input-sm m-bot15 wards2">
                                            <option selected value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>

                                <label>Địa chỉ chi tiết</label>
                                <textarea rows="5"  name="customer_address" >
                                </textarea>
                                <center>
                                 <button id="fee" type="submit" class="btn btn-default"   onclick="return confirm('Lưu thay đổi?');">Thêm địa chỉ</button>
                                 </center>
                                 
					</form>
					
				  </ul>
				</div>


				<div class="dropdown">
				  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Đổi địa chỉ
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
				    @php
							$diem =0;
						@endphp
						
						@foreach($address_change as $key => $ac)


							@foreach($xa as $key => $xaa)
								@if($xaa->XaPhuong_id == $ac->XaPhuong_id)

										@php
                                            $name_xaphuong = $xaa->XaPhuong_Ten;
                                                	$id_quan = $xaa->QuanHuyen_id;
                                        @endphp
								@endif

							@endforeach

							@foreach($quan as $key => $quann)
								@if($quann->QuanHuyen_id == $id_quan)

										@php
                                            $name_quanhuyen = $quann->QuanHuyen_Ten;

                                            $id_tinh =  $quann->TinhThanhPho_id;
                                        @endphp
								@endif

							@endforeach

							@foreach($city as $key => $cityy)
								@if($cityy->TinhThanhPho_id == $id_tinh)

										@php
                                            $name_thanhpho = $cityy->TinhThanhPho_Ten;

                                            
                                        @endphp
								@endif

							@endforeach




							@php
								$diem++;
							@endphp
							@if($ac->DiaChi_id == $address_info->DiaChi_id)
								@php
									//continue;
								@endphp
							@endif
							<table style="background-color:#A9D0F5;border-radius: 8px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);font-size: 20px;width: 400px;">
								<tr>
									

									<td>
										{{$name_thanhpho}}
									</td>
									<td rowspan="4">
										<a href="{{URL::to('/choose-address/'.$ac->DiaChi_id)}}" class="btn btn-success">Chọn</a>
									</td>

									<td rowspan="4">
										<a href="{{URL::to('/del-address/'.$ac->DiaChi_id)}}" class="btn btn-danger" onclick="return confirm('Xóa địa chỉ : {{$ac->DiaChi_Ten}}, {{$name_thanhpho}},{{$name_quanhuyen}},{{$name_xaphuong}}');" >
											Xóa
										</a>
									</td>
								</tr>

								<tr>
									<td>
										{{$name_quanhuyen}}
									</td>
								</tr>

								<tr>
									<td>
										{{$name_xaphuong}}
									</td>
								</tr>
								<tr>
									<td>
										{{$ac->DiaChi_Ten}}
									</td>
								</tr>
							</table>
							<br>
						@endforeach
				  </ul>
				</div>
	
</div>




			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						
				
								<form>
									@csrf

									<input type="hidden" name="city" id="city" class="form-control input-sm m-bot15 choose city2" value="{{$tinh_info->TinhThanhPho_id}}">

									<input type="hidden" name="province" id="province" class="form-control input-sm m-bot15 province2 choose" value="{{$huyen_info->QuanHuyen_id}}">

									<input type="hidden" name="wards" id="wards" class="form-control input-sm m-bot15 wards2" value="{{$xa_info->XaPhuong_id}}">

								</form>




								

							
					</div>
					<hr>
					<div class="col-sm-12 clearfix">
						  
						<div class="table-responsive cart_info">

							<form action="{{url('/update-cart')}}" method="POST">
								@csrf
							<table class="tc">
								<thead>
									<tr class="cart_menu">
										<th class="image">Hình ảnh</th>
										<th class="description">Tên sản phẩm</th>
										<th class="price">Giá sản phẩm</th>
										<th class="quantity">Số lượng</th>
										<th class="total">Thành tiền</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(Session::get('cart')==true)
									@php
											$total = 0;
									@endphp
									@foreach(Session::get('cart') as $key => $cart)
										@php
											$subtotal = $cart['product_price']*$cart['product_qty'];
											$total+=$subtotal;
										@endphp

									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
											
											
												<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
											
												
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}}đ
												
											</p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									
									@endforeach
									<tr>
										
										<td><button class="btn-b"><a class="" href="{{url('/del-all-product')}}">Xóa tất cả</a></button></td>
										
										<td>
											<button  class="btn-b" name="update_qty">Cập nhật SL</button>
											
										</td>
										<td>
											@if(Session::get('coupon'))
				                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif
										</td>

										
										<td colspan="2">
										<li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
										@if(Session::get('coupon'))
										<li>
											
												@foreach(Session::get('coupon') as $key => $cou)
													@if($cou['coupon_condition']==1)
														Mã giảm : {{$cou['coupon_number']}} %
														<p>
															@php 
															$total_coupon = ($total*$cou['coupon_number'])/100;
														
															@endphp
														</p>
														<p>
														@php 
															$total_after_coupon = $total-$total_coupon;
														@endphp
														</p>
													@elseif($cou['coupon_condition']==2)
														Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
														<p>
															@php 
															$total_coupon = $total - $cou['coupon_number'];
														
															@endphp
														</p>
														@php 
															$total_after_coupon = $total_coupon;
														@endphp
													@endif
												@endforeach

												@if($total_after_coupon <0)
													@php
														$total_after_coupon=0;
													@endphp
												@endif
											
											

										</li>
										@endif

										@if(Session::get('fee'))
										<li>	
											<!--
											<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-bell"></i></a>
											-->

											Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li> 
											<?php $total_after_fee = $total + Session::get('fee'); ?>
										@endif 
										<li>Tổng còn:
										@php 
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').'đ';
											}

										@endphp
										</li>
										
									</td>
									</tr>
									@else 
									<tr>
										<td colspan="5"><center>
										@php 
										echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
										@endphp
										</center></td>
									</tr>
									@endif
								</tbody>

								

							</form>
							</table>
							<br><br>
								@if(Session::get('cart'))
								

										


			            <form method="POST" action="{{url('/check-coupon')}}" class="ln">
							<h1>Nhập mã giảm giá</h1>
							{{csrf_field()}}
							<input type="text" name="coupon" placeholder="Nhập mã giảm giá" required="" />
							

							<button  type="submit" class="check_coupon" name="check_coupon" value="Tính mã giảm giá">Tính mả giảm giá</button>

							
							
						</form>

						@foreach($city as $key=>$ci)
                                            @if($ci->TinhThanhPho_id == $tinh_info->TinhThanhPho_id)
                                                
                                                @php
                                                	$thanhpho = $ci->TinhThanhPho_Ten;
                                                @endphp
                                            @endif
                                    @endforeach

                                    @foreach($quan as $key=>$q)
                                            @if($q->QuanHuyen_id == $huyen_info->QuanHuyen_id)
                                            	@php
                                                	$quanhuyen= $q->QuanHuyen_Ten;
                                                @endphp
                                            @endif
                                    @endforeach

                                    @foreach($xa as $key=>$ci)
                                            @if($ci->XaPhuong_id == $xa_info->XaPhuong_id)
                                            	@php
                                                	$xaphuong = $ci->XaPhuong_Ten;
                                                @endphp
                                            @endif
                            @endforeach


						<form  class="ln" action="{{URL::to('/confirm-order')}}" method="POST" enctype="multipart/form-data" name="myF" id="myF">
									<h1>Điền thông tin gửi hàng</h1>
									@csrf
									<input id="shipping_email" type="hidden" name="shipping_email" class="shipping_email" value="{{$customer_info->KhachHang_email}}">

									<input type="hidden" id="shipping_name" name="shipping_name" class="shipping_name" value="{{$customer_info->KhachHang_Ten}}">

									<input type="hidden" id="shipping_address" name="shipping_address" class="shipping_address"value="{{$address_info->DiaChi_Ten}}, {{$thanhpho}}, {{$quanhuyen}}, {{$xaphuong}} ">
									<br>
									<h5>
										Địa chỉ: {{$address_info->DiaChi_Ten}}, {{$thanhpho}}, {{$quanhuyen}}, {{$xaphuong}}
									</h5>
									<br>

									<input type="hidden" id="shipping_phone" name="shipping_phone" class="shipping_phone" value="{{$customer_info->KhachHang_SDT}}" >

									<textarea id="shipping_notes" name="shipping_notes" class="shipping_notes"  rows="5">Ghi chú</textarea>
									
									@if(Session::get('fee'))
										<input id="order_fee" type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else 
										<input id="order_fee" type="hidden" name="order_fee" class="order_fee" value="25000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input id="order_coupon" type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input id="order_coupon" type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif
									
										<input id="total-dh" type="hidden" name="total" class="total-dh" value="{{$total_after}}">
									
									
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>

		                                      <select id="sendmoney" name="shipping_method"  class="form-control input-sm m-bot15 payment_select">

		                                      		<option id="tien" value="1">Tiền mặt</option> 
		                                      	
		                                            <option id="tructuyen" value="0">Qua chuyển khoản</option>

		                                              
		                                    </select>
		                                </div>
									</div>
									
									
									<center>
									<h3   id="send" name="send_order" class="send_order btn-b">Đặt hàng</h3>
									<!-- <input id="myform" type="submit" name="send_order" class="send_order" > -->
									</center>
								</form>
								@php
									$usd = $total_after/23000;
								@endphp
								<input type="hidden" id="usd" value="{{round($usd,2)}}">

<center><div style="display: none;" id="paypal-button"></div></center>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
	var usd = document.getElementById("usd").value;
	// document.write(usd);
	
	

  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AfaGmAlNTeWQdUyvFlremfoYPUCLjM4Bj9jQzepCSEVt_bz0UNyHDdqV-Jl7nGujquojm1igKkFMdHsb',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: `${usd}`,
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
      	
      	//document.getElementById('myform').submit();
      	 window.alert('Cám ơn bạn đã mua hàng !!!');
      	 document.myF.submit();
        




      });
    }
  }, '#paypal-button');

</script>
			                         
								@endif

							

						</div>
					</div>
									
				</div>
			</div>
		

			
			
		</div>
	</section> <!--/#cart_items-->

@endsection