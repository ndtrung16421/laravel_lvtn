@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
                       
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          
        </div>
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
            
            <th>Tên thương hiệu</th>
            <th>Brand Slug</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key => $brand_pro)
          <tr>
           
            <td>{{ $brand_pro->ThuongHieu_Ten }}</td>
            <td>{{ $brand_pro->ThuongHieu_slug }}</td>
            <td><span class="text-ellipsis">
              <?php
               if($brand_pro->ThuongHieu_TrangThai==0){
                ?>
                <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->ThuongHieu_id)}}">Hiển thị</a>
                <?php
                 }else{
                ?>  
                 <a style="color: red;" href="{{URL::to('/active-brand-product/'.$brand_pro->ThuongHieu_id)}}">Ẩn</a>
                <?php
               }
              ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->ThuongHieu_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này ko?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->ThuongHieu_id)}}" class="active styling-edit" ui-toggle-class="">
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
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 10 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
             {!!$all_brand_product->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection