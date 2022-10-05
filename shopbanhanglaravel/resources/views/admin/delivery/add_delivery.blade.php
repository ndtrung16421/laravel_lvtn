@extends('admin_layout')
@section('admin_content')


    

    <button class="add_d">abbc</button>


    <form style="width: 400px;">
                                    @csrf 
                             
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->TinhThanhPho_id}}">{{$ci->TinhThanhPho_Ten}} - {{$ci->TinhThanhPho_id}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                               
                                @if(!Auth::user()->hasAnyRoles(['delivery','admin']) || !Auth::user()->hasAnyRoles(['add','admin']) ) 
                                            
                                    <button type="button" name="" class="btn btn-info disabled">Thêm phí vận chuyển</button> 
                                    
                                @else
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>

                                @endif

                                </form>
                            </div>

                            <div id="load_delivery">
                                
                            </div>
@endsection