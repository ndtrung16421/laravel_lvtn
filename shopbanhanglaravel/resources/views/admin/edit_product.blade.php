@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
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
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->SanPham_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$pro->SanPham_Ten}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thêm Số Lượng sản phẩm</label>
                                    <input type="number" min="0" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control"  value="0">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="convert_slug" value="{{$pro->SanPham_slug}}">
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value="{{$pro->SanPham_Gia}}" name="product_price" class="form-control" id="exampleInputEmail1" >
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">

                                    <img id="blah1" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh)}}" height="100" width="100">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm 2</label>
                                    <input type="file" name="product_image2" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="blah2" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh2)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm 3</label>
                                    <input type="file" name="product_image3" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="blah3" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh3)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm 4</label>
                                    <input type="file" name="product_image4" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah4').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="blah4" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh4)}}" height="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm 5</label>
                                    <input type="file" name="product_image5" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah5').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="blah5" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh5)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm 6</label>
                                    <input type="file" name="product_image6" class="form-control" id="exampleInputEmail1" onchange="document.getElementById('blah6').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="blah6" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh6)}}" height="100" width="100">
                                </div>







                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor2">{{$pro->SanPham_MoTa}}</textarea>
                                </div>
                                 
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->DanhMuc_id==$pro->DanhMuc_id)
                                            <option selected value="{{$cate->DanhMuc_id}}">{{$cate->DanhMuc_Ten}}</option>
                                            @else
                                            <option value="{{$cate->DanhMuc_id}}">{{$cate->DanhMuc_Ten}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                             @if($brand->ThuongHieu_id==$pro->ThuongHieu_id)
                                            <option selected value="{{$brand->ThuongHieu_id}}">{{$brand->ThuongHieu_Ten}}</option>
                                             @else
                                            <option value="{{$brand->ThuongHieu_id}}">{{$brand->ThuongHieu_Ten}}</option>
                                             @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection