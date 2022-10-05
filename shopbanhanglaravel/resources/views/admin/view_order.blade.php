@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đăng nhập
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin vận chuyển hàng
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
             <td>{{$shipping->shipping_phone}}</td>
             <td>{{$shipping->shipping_email}}</td>
             <td>{{$shipping->shipping_notes}}</td>
             <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
            
          
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho còn</th>
            <th>Mã giảm giá</th>
            <th>Phí ship hàng</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
        @foreach($order_details as $key => $details)

          @php 
          $i++;
          $subtotal = $details->product_price*$details->product_sales_quantity;
          $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
           
            <td><i>{{$i}}</i></td>

            <td><img src="{{url('/public/uploads/product/')}} /{{$details->product->product_image}}" height="70" width="70" alt="avatar" />
            </td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
                @else 
                  Không mã
                @endif
            </td>
            <td>{{number_format($details->product_feeship ,0,',','.')}}đ</td>
            <td>
              {{$details->product_sales_quantity}}
              <input type="hidden" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

             <!-- @if($order_status!=2) 

              <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập nhật abc</button>

            @endif -->

            </td>
            <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
          </tr>
        @endforeach
          <tr>
            <td colspan="2">  
            @php 
                $total_coupon = 0;
              @endphp
              @if($coupon_condition==1)
                  @php
                  $total_after_coupon = ($total*$coupon_number)/100;
                  echo 'Tổng giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                  $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
                  @endphp
              @else 
                  @php
                  echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').'k'.'</br>';
                  $total_coupon = $total + $details->product_feeship - $coupon_number ;

                  @endphp
              @endif

              Phí ship : {{number_format($details->product_feeship,0,',','.')}}đ</br> 
             Thanh toán: {{number_format($total_coupon,0,',','.')}}đ 
            </td>
          </tr>
          <tr>
            <td colspan="6">

              @foreach($order as $key => $or)
                 @if($or->order_status==1)
                  <h4 style="color: blue;">Chưa xác nhận</h4>
                @endif
                @if($or->order_status==2)
                  <h4 style="color: blue;">Đã xác nhận</h4>
                @endif
                @if($or->order_status==3)
                  <h4 style="color: blue;">Đã giao cho đơn vị vận chuyển</h4>
                @endif
                @if($or->order_status==4)
                  <h4 style="color: blue;">Đang giao hàng</h4>
                @endif
                @if($or->order_status==5)
                  <h4 style="color: blue;">Đã giao hàng thành công (Chờ khách xác nhận hoặc đợi 48h)</h4>
                @endif
                @if($or->order_status==6)
                  <h4 style="color: blue;">Trả hàng</h4>
                @endif
                @if($or->order_status==7)
                  <h4 style="color: blue;">Hủy đơn hàng</h4>
                @endif
                  <h4 style="color: blue;">Cập nhật: {{$or->updated_at}}</h4>

                @if($or->order_status ==1 )
                  <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="2">Xác nhận</option>
                    
                  </select>
                </form>
                @endif
                @if($or->order_status ==2 )
                  <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    
                    <option id="{{$or->order_id}}" value="3">Đã giao cho đơn vị vận chuyển</option>
                    <option id="{{$or->order_id}}" value="4">Đang giao</option>
                  </select>
                </form>
                @endif
                @if($or->order_status ==3 )
                  <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="4">Đang giao hàng</option>
                    
                  </select>
                </form>
                @endif
                 @if($or->order_status ==4 )
                  <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="5">Đã giao hàng</option>
                    
                  </select>
                </form>
                @endif
                @if($or->order_status ==5 )
                  <?php 
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    $time = strtotime($or->updated_at);
                   $time2 = date("Y-m-d h:i:s",$time+86400*2);

                   $now = date("Y-m-d h:i:s", time());

                   // echo ("now:" .$now);
                   // echo "<br>";
                   // echo $time2;
                    
                  ?>
                  @if ($time2 < $now)
                    
                  
                  
                  <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="8">Hoàn tất đơn hàng</option>
                    
                  </select>
                </form>
                @endif
                @endif

                <!-- @if($or->order_status !=9 && $or->order_status !=10 && $or->order_status !=6 && $or->order_status !=7 )
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="7">Đã hủy đơn hàng</option>
                    <option id="{{$or->order_id}}" value="2">Đã xác nhận</option>
                    <option id="{{$or->order_id}}" value="3">Đã giao cho đơn vị vận chuyển</option>
                    <option id="{{$or->order_id}}" value="4">Đang giao hàng</option>
                    <option id="{{$or->order_id}}" value="5">Đã giao hàng thành công</option>
                    
                  </select>
                </form>


                @endif -->

                @if($or->order_status ==10)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    
                    
                    <option id="{{$or->order_id}}" value="7">Đã hủy đơn hàng</option>
                    
                  </select>
                </form>


                @endif


                @if($or->order_status ==9)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option selected value="">----Chọn hình thức đơn hàng-----</option>
                    
                    <option id="{{$or->order_id}}" value="6">Đã trả hàng</option>
                    <option id="{{$or->order_id}}" value="8">Hoàn tất đơn hàng</option>
                    
                  </select>
                </form>


                @endif

               


                @endforeach


            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>
   
  </div>
</div>
@endsection