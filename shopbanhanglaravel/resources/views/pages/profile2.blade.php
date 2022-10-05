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

            



                    
                


        
                            <form class="ln" style="width: 70%" action="{{URL::to('/save-customer')}}" method="POST" enctype="multipart/form-data">
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

@endsection