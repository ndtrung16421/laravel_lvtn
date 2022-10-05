@extends('admin_layout')
@section('admin_content')

 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
                    
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
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
           

            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Loại giảm giá</th>
            <th>Số giảm</th>
            <th></th>
            <th>Cập nhật SL</th>
          
            
           
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
          
            <td>{{ $cou->MaGiamGia_Ten }}</td>
            <td>{{ $cou->MaGiamGia_Ma }}</td>

            <td>
              {{ $cou->MaGiamGia_SoLan }}
              
            </td>

            <td><span class="text-ellipsis">
              <?php
               if($cou->MaGiamGia_Loai==1){
                ?>
                Giảm theo %
                <?php
                 }else{
                ?>  
                Giảm theo tiền
                <?php
               }
              ?>
            </span>
          </td>
             <td><span class="text-ellipsis">
              <?php
               if($cou->MaGiamGia_Loai==1){
                ?>
                Giảm {{$cou->MaGiamGia_GiaTri}} %
                <?php
                 }else{
                ?>  
                Giảm {{$cou->MaGiamGia_GiaTri}} k
                <?php
               }
              ?>
            </span></td>
           
            <td>
             
              <a onclick="return confirm('Đặt số lượng mã giảm giá = 0?')" href="{{URL::to('/delete-coupon/'.$cou->MaGiamGia_Ma)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
            <td>
              <a  href="{{URL::to('/update-coupon/'.$cou->MaGiamGia_Ma)}}" class="active styling-edit" ui-toggle-class="">
                Cập nhật
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
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
             {!!$coupon->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
   
@endsection