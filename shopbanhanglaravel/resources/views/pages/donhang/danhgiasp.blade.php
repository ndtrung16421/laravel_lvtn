@extends('layout')
@section('content')

<form class="ln" action="{{URL::to('/save-rating')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

<h1>Đánh giá sản phẩm {{$product->SanPham_Ten}}
  <img src="{{url('/public/uploads/product/')}} /{{$product->SanPham_AnhChinh}}" height="50" width="50" alt="avatar" />
</h1>

    <!--
    <label><img src="{{url('/public/frontend/images/start.png')}} " height="40" width="40" alt="avatar" /></label>

               <select  name="rating_start">
                <option value=5> 5</option>
                <option value=4> 4</option>
                 <option value=3> 3</option>
                  <option value=2> 2</option>
                   <option value=1> 1</option>
                  
                  </select>
    -->
    <center>
  <div id="rating">
    <input type="radio" id="star5" name="rating" value="5" />
    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
 
    <input type="radio" id="star4" name="rating" value="4" />
    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
 
    <input type="radio" id="star3" name="rating" value="3" />
    <label class = "full" for="star3" title="Meh - 3 stars"></label>
 
    <input type="radio" id="star2" name="rating" value="2" />
    <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
 
    <input type="radio" id="star1" name="rating" value="1" />
    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
</div>    
  </center>
  <label>Nội dung đánh giá</label>
  <textarea rows="5" name="rating_content"> </textarea>

  <label>Ảnh 1</label>
  <img id="blah1"  width="100" height="100"  />
  <input type="file" name="rating_image1" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
  

  <label>Ảnh 2</label>
  <img id="blah2"  width="100" height="100"  />
  <input type="file" name="rating_image2" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
  


  <label>Ảnh 3</label>
  <img id="blah3"  width="100" height="100"  />
  <input type="file" name="rating_image3" onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])">
  

              
  <input type="hidden" value="{{$order_code}}"  name="order_code">
  
  <input type="hidden" value="{{$product->SanPham_id}}"  name="product_id">

             
              
              
    <button  type="submit" class="btn btn-default"   onclick="return confirm('Đánh giá?');">Đánh giá</button>
</form>
            
    





@endsection