@extends('layout_not_slider')
@section('content')

						<form class="ln" action="{{URL::to('/add-customer')}}" method="POST" enctype="multipart/form-data"  name="form-re" onsubmit="return kiemtra()">
							{{ csrf_field() }}
							
                            <h1>Đăng ký tài khoản</h1>
                            <div id="baoloitendangnhap"></div>
							<input id="check_email" type="email" name="customer_email" placeholder="Địa chỉ email" required/>
                            <div >
                                <p id="check_result"></p>
                            </div>

							<input type="password" name="customer_password" placeholder="Mật khẩu" required/>
                            <div id="baoloimatkhau"></div>
                            <input type="password" name="customer_password2" placeholder="Xác nhận mật khẩu" required/>
                            <div id="xacnhan"></div>
                            <br>
                            <input type="text" name="customer_name" placeholder="Họ và tên" required/>
							<input type="text" name="customer_phone" placeholder="Số điện thoại" required/>
							
                             &emsp;  &ensp;
                            <img id="blah" alt="Ảnh đại diện" width="100" height="100" style="font-weight: bold;" />
							<input type="file" name="customer_image" required onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"  />
                            
                            

                            
                             <textarea rows="5"  name="customer_address" placeholder="Địa chỉ" required>Địa chỉ 
                                </textarea>


                                    <br><br>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city2" required>
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}" required>{{$ci->name_city}} - {{$ci->matp}}</option>
                                        @endforeach
                                            
                                    </select>
                               
                                    <label for="exampleInputPassword1">
                                    
                                    	

                                	</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province2 choose" required>
                                            <option value="" >--Chọn quận huyện--</option>
                                           
                                    </select>
                               
                                    <label for="exampleInputPassword1">
                                    	

                                	</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards2" required>
                                            <option value="" >--Chọn xã phường--</option>   
                                    </select>
                                









                            <br><br>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					
                    <br><br><br><br>
				

@endsection