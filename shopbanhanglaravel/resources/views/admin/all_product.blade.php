@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
                      
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
       
      </div>
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
            <!-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
 -->            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <!-- <th>Slug</th> -->
            <th>Giá</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            
            <th>Hiển thị</th>
            <th>Thao tác</th>
            <th></th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $pro->SanPham_Ten }}</td>
            <td>{{ $pro->SanPham_SoLuong }}</td>
            <!-- <td>{{ $pro->SanPham_slug }}</td> -->
            <td>{{ number_format($pro->SanPham_Gia,0,',','.') }}đ</td>
            <td><img src="public/uploads/product/{{ $pro->SanPham_AnhChinh }}" height="100" width="100"></td>
            <td>{{ $pro->DanhMuc_Ten  }}</td>
            <td>{{ $pro->ThuongHieu_Ten }}</td>

            <td><span class="text-ellipsis">
              <?php
               if($pro->SanPham_TrangThai==0){
                ?>
                <a class="btn btn-info" href="{{URL::to('/unactive-product/'.$pro->SanPham_id)}}">
                  Hiển thị
                </a>
                <?php
                 }else{
                ?>  
                 <a class="btn btn-danger" href="{{URL::to('/active-product/'.$pro->SanPham_id)}}">
                   Ẩn
                 </a>
                <?php
               }
              ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->SanPham_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              </td>
              <td>
                 <a  href="{{URL::to('/image-product/'.$pro->SanPham_id)}}"  ui-toggle-class="">
                <button class="btn btn-success">Ảnh SP</button>
              </a>
              </td>
              <td>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" href="{{URL::to('/delete-product/'.$pro->SanPham_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$all_product->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection