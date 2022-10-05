@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm mã giảm giá
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-coupon2')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" value="{{$coupon->MaGiamGia_Ten}}" >

                                    <input type="hidden" name="coupon_code" class="form-control" id="exampleInputEmail1" value="{{$coupon->MaGiamGia_Ma}}" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                      <input type="number" min="1" name="coupon_time" class="form-control" id="exampleInputEmail1" value="{{$coupon->MaGiamGia_SoLan}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại</label>
                                     <select name="coupon_condition" class="form-control input-sm m-bot15">
                            
                                
                    @if($coupon->MaGiamGia_Loai == 1)
                        <option selected value="1">Giảm theo phần trăm</option>
                                            <option value="2">Giảm theo tiền</option>
                    @else
                        <option value="1">Giảm theo phần trăm</option>
                                            <option selected value="2">Giảm theo tiền</option>
                    @endif

                            
                                        
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                     <input type="number" name="coupon_number" class="form-control" id="exampleInputEmail1" value="{{$coupon->MaGiamGia_GiaTri}}">
                                </div>
                               
                               
                                <button type="submit" name="add_coupon" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection