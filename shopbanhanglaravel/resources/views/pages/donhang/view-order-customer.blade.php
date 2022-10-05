@extends('layout_not_slider')
@section('content')

<h3 class="_back">
  <button class="btn btn-info">
    Quay lại
  </button>
</h3>
<div class="table-agile-info">
  <div class="panel-heading">
     <h3>Lịch sử cập nhật</h3>
  </div>

<center>
<table class="table-striped" style="font-size: 20px;">
        <thead>
          <tr>
           
            
          
            
            
          </tr>
        </thead>
        <tbody>
        
          @foreach($lichsu as $key => $ls)
            <tr>
              <td style="border-left: solid;
  border-width: 5px 5px;border-color: green;">
                {{$ls->ThoiGianTao}}
              </td>
              <td>
                <h2 style="color: blue;"> ---- </h2>
              </td>
              <td>
                {{$ls->NoiDung}}
              </td>
            </tr>

          @endforeach
          <tr>
            <td style="border-left: solid;
                        border-width: 5px 5px;
                        border-color: green;">
                {{$order->ThoiGianTao}}
            </td>
            <td>
                <h2 style="color: blue;"> ---- </h2>
            </td>
            <td>
                Khách đặt hàng
            </td>
            
          </tr>
     
        </tbody>
      </table>
      </center>
      <br>



  
  

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     <h3>Thông tin vận chuyển</h3>
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="tc" style="font-size: 20px;">
        <thead>
          <tr>
           
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          
            
            
          </tr>
        </thead>
        <tbody>
        
          <tr >
           
            <td>{{$shipping->NguoiNhan_Ten}}</td>
            <td>{{$shipping->NguoiNhan_DiaChi}}</td>
             <td>{{$shipping->NguoiNhan_SDT}}</td>
             <td>{{$shipping->NguoiNhan_email}}</td>
             <td>{{$shipping->NguoiNhan_GhiChu}}</td>
             <td>
              @if($order->PhuongThucThanhToan==0) Chuyển khoản 
              @else 
                Tiền mặt 
              @endif
            </td>
            
          
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
      <h3>Chi tiết đơn hàng</h3>
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
  
    
      <table class="tc" style="font-size: 20px !important;">
        <thead>
          <tr>
            <th>STT</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <!-- <th>Số lượng kho còn</th> -->
           
           
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            
            
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
          $subtotal = $details->DonGia_CTDH*$details->SoLuongBan_CTDH;
          $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->SanPham_id}}">
           
              <td>{{$i}}</td>
             
                
            @foreach($product as $key => $proo)
                  @if($proo->SanPham_id == $details->SanPham_id)
                    <td >
                      <a href="{{URL::to('/chi-tiet')}}/{{$proo->SanPham_slug}}">
                        <img src="{{url('/public/uploads/product/')}} /{{$details->SanPham->SanPham_AnhChinh}}" height="70" width="70" alt="avatar" /> 

                      </a> 

                     </td>

                  @endif

                @endforeach
            
            <td>{{$details->SanPham_Ten_CTDH}} x {{$details->SoLuongBan_CTDH}}</td>

            



            
            
            @if($order_status == 1)
            <td>
              <input style="width: 60px;" type="number" min="1"  class="quan_{{$details->DonHang_Ma}}" value="{{$details->SoLuongBan_CTDH}}" name="product_sales_quantity_{{$details->DonHang_Ma}}">
            @else
              <td>
              <input style="width: 60px;" type="hidden" min="1"  class="quan_{{$details->DonHang_Ma}}" value="{{$details->SoLuongBan_CTDH}}" name="product_sales_quantity_{{$details->DonHang_Ma}}">

              {{$details->SoLuongBan_CTDH}}
              </td>
            @endif

                  

        

        <input type="hidden" name="pro_id_{{$details->DonHang_Ma}}" class="pro_id_{{$details->DonHang_Ma}}" value="{{$details->SanPham_id}}">

             

            </td>
            <td>{{number_format($details->DonGia_CTDH ,0,',','.')}}đ</td>
            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
          </tr>
          <tr>
            <td colspan="8">
              <hr>
            </td>
          </tr>

        @endforeach
          
            <td colspan="2">  
  @php 
                
    $x=0;
  @endphp

  @if($order->MaGiamGia_Ma != null )
          @php
              $x = $total + $order->DonHang_PhiVanChuyen - $order->TongTien;

              
          @endphp
          
  @endif
  

  @if($order->MaGiamGia_Ma ==null)
    Phí ship : {{number_format($order->DonHang_PhiVanChuyen,0,',','.')}}đ</br> 
              Thanh toán: {{number_format($total,0,',','.')}}đ <br>
      <h3 style="font-size: 20px;color: #FE2E2E;font-weight: bold;">
               Tổng : {{number_format($order->TongTien,0,',','.')}}đ
      </h3>
  @else
    Phí ship : {{number_format($order->DonHang_PhiVanChuyen,0,',','.')}}đ</br> 
              Thanh toán: {{number_format($total,0,',','.')}}đ <br>
              Mã giảm giá {{$order->MaGiamGia_Ma}}: - {{number_format($x,0,',','.')}}đ <br>
      <h3 style="font-size: 20px;color: #FE2E2E ;font-weight: bold;">     
               Tổng : {{number_format($order->TongTien,0,',','.')}}đ
       </h3>
             
  @endif
            </td>
          </tr>
          <tr>
            <td colspan="6">

              
                 @if($order->TrangThaiDonHang_id==1)
                  <h4 style="color: blue;">Chưa xác nhận</h4>
                @endif
                @if($order->TrangThaiDonHang_id==2)
                  <h4 style="color: blue;">Đã xác nhận</h4>
                @endif
                @if($order->TrangThaiDonHang_id==3)
                  <h4 style="color: blue;">Đã giao cho đơn vị vận chuyển</h4>
                @endif
                @if($order->TrangThaiDonHang_id==4)
                  <h4 style="color: blue;">Đang giao hàng</h4>
                @endif
                @if($order->TrangThaiDonHang_id==5)
                  <h4 style="color: blue;">Đã giao hàng thành công</h4>
                @endif
                @if($order->TrangThaiDonHang_id==6)
                  <h4 style="color: blue;">Trả hàng</h4>
                @endif

                @if($order->TrangThaiDonHang_id==7)
                  <h4 style="color: blue;">Hủy đơn hàng</h4>
                @endif

                @if($order->TrangThaiDonHang_id==8)
                  <h4 style="color: blue;">Hoàn tất đơn hàng</h4>
                @endif

                 @if($order->TrangThaiDonHang_id==9)
                  <h4 style="color: blue;">Yêu cầu trả hàng</h4>
                @endif

                 @if($order->TrangThaiDonHang_id==10)
                  <h4 style="color: blue;">Yêu cầu hủy đơn hàng</h4>
                @endif


                  <h4 style="color: blue;">Cập nhật: {{$order->updated_at}}</h4>
            </td>
          </tr>

          <tr>
            <td>

                  @if($order->TrangThaiDonHang_id ==1) 
                <form>
                   @csrf

                   <input type="hidden" name="order_id" class="order_id" value="{{$order->DonHang_id}}">

                   <p data-order_code="{{$order->DonHang_Ma}}" data-TrangThaiDonHang_id="7" data-action_name="Bạn muốn hủy đơn hàng?" style="font-weight: bold;font-size: 20px;" class="btn btn-danger cancel-order-pose" style="color: white;"> Hủy đơn hàng</p>
                  
                </form>

                

                
                
                @endif


                   @if($order->TrangThaiDonHang_id == 2) 
                <form>
                   @csrf

                   <input type="hidden" name="order_id" class="order_id" value="{{$order->DonHang_id}}">

                   
              
                  
                </form>

                 <p data-order_code="{{$order->DonHang_Ma}}" data-TrangThaiDonHang_id="10" data-action_name="Yêu cầu hủy đơn hàng ?" style="font-weight: bold;font-size: 30px;" class="btn btn-danger cancel-order-pose" style="color: white;">Yêu cầu hủy đơn hàng</p> -->
                
                @endif
              </td>
              <td>
                @if($order->TrangThaiDonHang_id == 5) 
                <form>
                   @csrf

                   <input type="hidden" name="order_id" class="order_id" value="{{$order->DonHang_id}}">

                   
              
                  
                </form>

                <p data-order_code="{{$order->DonHang_Ma}}" data-TrangThaiDonHang_id="9" data-action_name="Yêu cầu trả hàng ?" style="font-weight: bold;font-size: 30px;" class="btn btn-danger cancel-order-pose" style="color: white;">Yêu cầu trả hàng</p>
                
                @endif
                </td>

                <td>

                @if($order->TrangThaiDonHang_id == 5) 
                <form>
                   @csrf

                   <input type="hidden" name="order_id" class="order_id" value="{{$order->DonHang_id}}">

                   
              
                  
                </form>

                <p data-order_code="{{$order->DonHang_Ma}}" data-TrangThaiDonHang_id="8" data-action_name="Bạn đã nhận hàng ?" style="font-weight: bold;font-size: 30px;" class="btn btn-success cancel-order-pose" style="color: white;">Đã nhận hàng</p>
                
                @endif
                </td>

                @if($order->TrangThaiDonHang_id == 1) 
                  <td>
                    <form>
                       @csrf
                       
                      
              
                       <input type="hidden" name="order_id" class="order_id" value="{{$order->DonHang_id}}">

                       
                      
                     <p data-order_code="{{$order->DonHang_Ma}}"  style="font-weight: bold;font-size: 20px;" class="btn btn-info update_quantity_order" style="color: white;"> Cập nhật SL</p>
                      
                    </form>
                  </td>
                @endif


               


                


            </td>
          </tr>
        </tbody>
      </table>


      
    </div>
   
  </div>
</div>

@endsection