@extends('layout_not_slider')
@section('content')

	
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a  href="{{URL::to('/')}}">
				  	<i class="fa fa-home" style="font-size: 20px;"></i>
				  </a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			  @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
			<div class="table-responsive cart_info">

				<form action="{{url('/update-cart')}}" method="POST">
					@csrf
				<table class="tc">
					<thead>
						<tr class="cart_menu">
							<th class="image">Hình ảnh</th>
							<th class="description">Tên sản phẩm</th>
							<th class="description">Số lượng tồn</th>
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
								

								@foreach($product as $key => $pro)
									@if($pro->SanPham_id == $cart['product_id'])
										<a href="{{URL::to('/chi-tiet')}}/{{$pro->SanPham_slug}}"><img  src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" /> </a>
									@endif

								@endforeach


							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_quantity']}}</p>



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
							
							<td><a style="font-size: 20px;" class="btn-b" href="{{url('/del-all-product')}}">Xóa tất cả</a></button></td>

							<td>
							<button class="btn-b" type="submit" ><a style="font-size: 20px;"  name="update_qty">Cập nhật SL</a></button>

							</td>
							<td>
								@if(Session::get('coupon'))
	                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
							</td>

							<td>
								@if(Session::get('KhachHang_id'))
								
	                          	<a style="font-size: 20px;" class="btn-b" href="{{url('/checkout')}}">Đặt hàng</a>

	                          	@else 

	                          	<a style="font-size: 20px;" class="btn-b" href="{{url('/dang-nhap')}}">Đặt hàng</a>
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
												echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</li></p>';
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format($total-$total_coupon,0,',','.')}}đ</li></p>
										@elseif($cou['coupon_condition']==2)
											Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
											<p>
												@php 
												$total_coupon = $total - $cou['coupon_number'];
								
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}}đ</li></p>
										@endif
									@endforeach
								


							</li>
							@endif 
						{{-- 	<li>Thuế <span></span></li>
							<li>Phí vận chuyển <span>Free</span></li> --}}
							
							
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
					@if(Session::get('cart'))
					<tr><td>

							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
	                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
	                          	
                          		</form>
                          	</td>
					</tr>
					@endif

				</table>

			</div>
		</div>
	



@endsection