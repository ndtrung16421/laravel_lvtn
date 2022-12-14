<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="{{asset('public/backend/css/style8.css')}}" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >

<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<link href="{{asset('public/backend/css/jquery.dataTables.min.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 


<!-- calendar -->
<!-- <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}"> -->
<!-- //calendar -->
<!-- //font-awesome icons -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

</head>
<body>

<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="col-xs-6 brand">
    <a target="_blank" href="{{url('/')}}" class="logo">
        Shop 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class='col-xs-3 '>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle fabell" type="button" data-toggle="dropdown">
            
          <i class="fa fa-bell"></i>
          <sup class="cart-num" id="nou-num" style="color: white!important;">
                                                
            </sup>
        </button >
          <ul class="dropdown-menu">
            <div id="myfafabell" style="height: 400px;width:300px; overflow-y: scroll;overflow-x: scroll;">
                
            </div>
          </ul>
        </div>
</div>
<div class=" top-nav clearfix" >
    
    

    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{url('/public/backend/images/2.png')}}">
                <span class="username">
                	<?php
					$name = Auth::user()->admin_Ten;
					if($name){
						echo $name;
						
					}
					?>

                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>????ng xu???t</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>T???ng quan</span>
                    </a>
                </li>

                @hasrole(['admin','slider'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-slider')}}">Li???t k?? slider</a></li>
                        <li><a href="{{URL::to('/add-slider')}}">Th??m slider</a></li>
                    </ul>
                </li>
               @endhasrole
                </li>

                @hasrole(['admin','order'])
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>????n h??ng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order2')}}">Qu???n l?? ????n h??ng</a></li>
						
                      
                    </ul>
                </li>
                @endhasrole

                @hasrole(['admin','coupon'])
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>M?? gi???m gi??</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/insert-coupon')}}">Qu???n l?? m?? gi???m gi??</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>
                    </ul>
                </li>
                @endhasrole

                @hasrole(['admin','delivery'])
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>V???n chuy???n</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Th??m v???n chuy???n</a></li>

                        <li><a href="{{URL::to('/list-delivery')}}">Danh s??ch v???n chuy???n</a></li>
                        
                        
                        
                      
                    </ul>
                </li>
                @endhasrole

                @hasrole(['admin','product'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh m???c s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Th??m danh m???c s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Li???t k?? danh m???c s???n ph???m</a></li>
                      
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Th????ng hi???u s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Th??m hi???u s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Li???t k?? th????ng hi???u s???n ph???m</a></li>
                      
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>S???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Th??m s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-product')}}">Li???t k?? s???n ph???m</a></li>
                      
                    </ul>
                </li>
                @endhasrole

                @hasrole(['author','admin'])
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Ph??n quy???n</span>
                    </a>
                    <ul class="sub">
                         <li><a href="{{URL::to('/add-users')}}">Th??m user</a></li>
                        <li><a href="{{URL::to('/users')}}">G??n quy???n user</a></li>
                      
                    </ul>
                </li>
                @endhasrole
               
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        

        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  
		  </div>
        </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>


<script src="{{asset('public/backend/js/jQuery.min.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>




<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
        $('.fabell').click(function(){
            
            var _token = $('input[name="_token"]').val();
                
                $.ajax({
                url : '{{url('/fafabell')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    //alert('b???n ch??a ????ng nh???p!');
                   $('#myfafabell').html(data);
                }
            });

        });

            
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_d').click(function(){
            
            alert('adaaadad');

        });

            
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){


        
        $('.add_delivery').click(function(){
            
           var city = $('.city').val();
           var province = $('.province').val();
           var wards = $('.wards').val();
           var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
           // alert(city);
           // alert(province);
           // alert(wards);
           // alert(fee_ship);
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(){
                    alert('Th??m th??nh c??ng');
                   location.reload();
                }
            });


        });
        $('.choose').on('change',function(){
            

            var action = $(this).attr('id');
            //alert(action);
            var ma_id = $(this).val();
            //alert(ma_id);
            var _token = $('input[name="_token"]').val();
           //alert(_token);
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
    })


</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var _token = $('input[name="_token"]').val();
        

        $.ajax({
                url : '{{url('/fafabell2')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    
                   $('#nou-num').html(data);
                }
            });



     });


</script>



<script type="text/javascript">
    
    $(document).ready(function(){

//     Morris.Bar({
//   element: 'myfirstchart',
//   data: [
//     { y: '2006', a: 100, b: 90 ,c:33},
//     { y: '2007', a: 75,  b: 65,c:44 },
//     { y: '2008', a: 50,  b: 40,c:66 },
//     { y: '2009', a: 75,  b: 65 },
//     { y: '2010', a: 50,  b: 40 },
//     { y: '2011', a: 75,  b: 65 },
//     { y: '2012', a: 100, b: 90 }
//   ],
//   xkey: 'y',
//   ykeys: ['a', 'b', 'c'],
//   labels: ['Series A', 'Series B', 'cc']
// });


    chart30daysorder();
      var chart = new  Morris.Bar({
      element: 'myfirstchart',
      hideHover: 'auto',
      behaveLikeLine: true,
      parseTime: false,
      pointFillColors: ['#ffffff'],
      
      
      xkey: 'period',
      ykeys: ['sales','order','quantity'],
      labels: ['Doanh thu','T???ng ????n h??ng','T???ng s???n ph???m']
    });

    function chart30daysorder(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url : '{{url('/days-order')}}',
                method: 'POST',
                dataType:"JSON",
                data:{_token:_token},
                success:function(data){
                   
                    chart.setData(data);
                    
                }
        });
    }

    $('.dashboard-filter').change(function() {
        $("#datepicker").val("");
        $("#datepicker2").val("");


        var dashboard_value = $(this).val();
        var product_id =  $('.product_id').val();
        var _token = $('input[name="_token"]').val();
        alert(dashboard_value);
        alert(product_id);
        alert(_token);
       // alert(dashboard_value);
        $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method: 'POST',
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token,product_id:product_id},
                success:function(data){
                    //alert(data);
                    chart.setData(data);
                    
                }
        });
    });
    $('.product_id').change(function() {

        

        var dashboard_value =  $('.dashboard-filter').val();
        var product_id =  $('.product_id').val();
        var _token = $('input[name="_token"]').val();
       // alert(dashboard_value);
        $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method: 'POST',
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token,product_id:product_id},
                success:function(data){
                    //alert(data);
                    chart.setData(data);
                    
                }
        });
    });

    $("#datepicker2").change(function(){
        $('.dashboard-filter').val(-1);
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        var product_id =  $('.product_id').val();
        // alert(_token);
        //  alert(from_date);
        // alert(to_date);
        $.ajax({
                url : '{{url('/filter-by-date')}}',
                method: 'POST',
                dataType:"JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token,product_id:product_id},
                success:function(data){
                   
                   //alert(data);

                   
                    chart.setData(data);
                    

                }

        });
    });
    $("#datepicker").change(function(){
        $('.dashboard-filter').val(-1);
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        var product_id =  $('.product_id').val();
        // alert(_token);
        //  alert(from_date);
        // alert(to_date);
        $.ajax({
                url : '{{url('/filter-by-date')}}',
                method: 'POST',
                dataType:"JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token,product_id:product_id},
                success:function(data){
                   
                   //alert(data);

                   
                    chart.setData(data);
                    

                }

        });
    });


}); 
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.pro_ca').on('change',function(){
            
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();

            // alert(ma_id);
            // alert(_token);
            
            $.ajax({
                url : '{{url('/select-cate')}}',
                method: 'POST',
                data:{ma_id:ma_id,_token:_token},
                success:function(data){
                   // alert('a');
                   $('#spi').html(data);     
                }
            });
        });
    });
</script>


<script type="text/javascript">
    // $("#btn-dashboard-filter").click(function(){
        
    //     var _token = $('input[name="_token"]').val();
    //     var from_date = $('#datepicker').val();
    //     var to_date = $('#datepicker2').val();
    //     // alert(_token);
    //     //  alert(from_date);
    //     // alert(to_date);
    //     $.ajax({
    //             url : '{{url('/filter-by-date')}}',
    //             method: 'POST',
    //             //dataType:"JSON",
    //             data:{from_date:from_date,to_date:to_date,_token:_token},
    //             success:function(data){
    //                alert(data);
    //                 chart.setData(data);     
    //             }
    //     });
    // });
</script>
<script type="text/javascript">
    $(function() {
        $("#datepicker").datepicker({
            dateFormat:"yy-mm-dd",
            //duration:"slow"
        });
         $("#datepicker2").datepicker({
        //     // prevText:"Th??ng tr?????c",
        //     // nextText:"Th??ng sau",
              dateFormat:"yy-mm-dd"
        //     // dayNamesMin:["Th??? 2","Th??? 3","Th??? 4","Th??? 5","Th??? 6","Th??? 7","Ch??? nh???t"],
        //     // duration:"slow"
         });

    });
</script>


<!-- <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script> -->
<!-- <script>
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
</script> -->
<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }
         

   
   
</script>
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : '{{url('/update-qty')}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
                 
                   location.reload();
                    
              
                    

                }
        });

    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){


    if (confirm('X??c nh???n?')) {
    
 
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        var order_code= $('.order_code_'+order_id).val();

        //lay ra so luong
        quantity = [];
                        $('.order_qty_'+order_id).each(function(){
                            quantity.push($(this).val());
                        });
                        //lay ra product id
        order_product_id = [];
                        $('.order_product_id_'+order_id).each(function(){
                            order_product_id.push($(this).val());
                        });

        // alert(order_status);
        // alert(order_id);
        // alert(quantity);
        // alert(order_product_id);
        // alert(order_code);

        j = 0;
        // for(i=0;i<order_product_id.length;i++){
        //     //so luong khach dat
        //     var order_qty = $('.order_qty_' + order_product_id[i]).val();
        //     //so luong ton kho
        //     var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

        //     if(parseInt(order_qty)>parseInt(order_qty_storage)){
        //         j = j + 1;
        //         if(j==1){
        //             alert('S??? l?????ng b??n trong kho kh??ng ?????');
        //         }
        //         $('.color_qty_'+order_product_id[i]).css('background','#000');
        //     }
        // }

        
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id,order_code:order_code},
                            success:function(data){
                                
                                location.reload();
                            }
                });
            
        }






    }
    else {
    
    location.reload();
    }

    });
</script>

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
</script>
<script type="text/javascript">
        $.validate({
            
        });
</script>
 <script>
       // Replace the <textarea id="editor1"> with a CKEditor
       // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('id4');
</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script type="text/javascript">
    var i=5
function add_file()
{
    i++;
 $("#file_div").append("<div><input  type='file' name='file[]'>                                            <input class='btn btn-danger' type='button' value='REMOVE' onclick=remove_file(this);></div><br>");
}
function remove_file(ele)
{
 $(ele).parent().remove();
}
</script>

</body>
</html>
