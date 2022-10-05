@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Chi tiết ảnh sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
<div class="row">

    <div class="col-xs-6">
            <center>
         {{$pro->SanPham_Ten}}
         <br>
        <img id="blah1" src="{{URL::to('public/uploads/product/'.$pro->SanPham_AnhChinh)}}" height="100" width="100">
        <hr>
            </center>

        <table class="table">
        @foreach($image_pro as $key => $pr)
            <tr>
                <td>
                    
                    <a style="color: white;" href="#">
                        <img src="{{url('/public/uploads/image_product')}} /{{$pr->HinhAnhSP_Ten}}" height="100" width="100" alt="" /> 
                                

                    </a>
                </td>
                <td>
                    <a style="color: white;" href="{{URL::to('/delete-image-product/'.$pr->HinhAnhSP_id)}}">
                        <button class="btn btn-danger">Xóa</button>
                                

                    </a>
                </td>
            </tr>      
        @endforeach
        </table>
    </div>

    <div class="col-xs-6">
        <div style="">
        <center>
        <input type="button" onclick="add_file();" value="Thêm ảnh" class="btn btn-info" style="font-weight: bold;font-size: 20px;">
        </center>

        <div id="wrapper" style="margin:0 auto;
         padding:0px;
         text-align:center;
         width:auto;">

        <div id='menu_div'>

        <div id="form_div">
         <form method="post" action="{{URL::to('/save-image-product')}}" id="file_form" enctype="multipart/form-data">
            @csrf 
            <input type="hidden" name="product_id" value="{{$pro->SanPham_id}}">

          <div id="file_div"
          style="width:auto;
             padding:20px;
             margin-left:auto;
             
             margin-bottom:20px;">
           <div>
            <input type="file" name="file[]" >
            
            
            <br><br>
           </div>
          </div>
          <br><br>
          <input type="submit" class="btn btn-success" name="submit_file" value="SUBMIT">
         </form>
        </div>

        </div>


        </div>
        
    </div><!-- end-col-6 -->

</div>
                    </section>

            </div>
@endsection