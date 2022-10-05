
<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    

    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
   {{--  <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
    <script>paypal.Buttons().render('body');</script> --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script  src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="{{asset('public/frontend/js/xzoom.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.hammer.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('public/frontend/js/setup.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {
   $('.content a').fancybox();
});
</script>

<script type="text/javascript">
    $(".xzoom").xzoom({mposition : fullscreen});
</script>

<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
</script>

<script> 
$(document).ready(function(){
  $("#flip2").click(function(){
    $("#panel2").slideToggle("slow");
  });
});
</script>


<script type="text/javascript">
$(document).ready(function() {
    $("#file").change(function () {
     swal('a');
    filePreview("imagee");
});
});
</script>

<script>
$(document).ready(function(){
  
      $("#sendmoney").change(function(){
        var val = $(this).val();
       //alert(val);
       if (val == 1) {
         $("#send").show();
         $("#paypal-button").hide();
       }

       if (val == 0) {
         $("#send").hide();
         $("#paypal-button").show();
       }
      });
  });
</script>


    <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var total = $('.total-dh').val();
                        var _token = $('input[name="_token"]').val();

                        // alert(shipping_email);
                        // alert(shipping_name);
                        // alert(shipping_address);
                        // alert(shipping_phone);
                        // alert(shipping_notes);
                        // alert(shipping_method);
                        // alert(order_fee);
                        // alert(order_coupon);
                        alert(total);
                        alert(order_coupon);

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method,total:total},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");

                               window.location.href = "{{url('/your-order')}}";
                            }
                        });

                        

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });

               
            });
        });
    

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                //alert(cart_product_id);

                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var cart_product_slug = $('.cart_product_slug_' + id).val();

                var _token = $('input[name="_token"]').val();
                
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity) || parseInt(cart_product_qty) < 1  ){
                    swal('Làm ơn đặt nhỏ hơn ' + cart_product_quantity+' và lớn hơn 0');
                }


                else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity,
                            cart_product_slug:cart_product_slug

                        },
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng"
                                });
                            window.location.reload();
                            // $('#cart-num').html(data);

                        }

                    });
                }

                
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            
                
            $('.login-add-wishlist').click(function(){
                swal('bạn chưa đăng nhập!');
            });

            
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-wishlist').click(function(){
               
                var id = $(this).data('id_product');
                 //alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                //alert(cart_product_id);
                var id_c = $('.customer_id').val();
               // alert(id_c);
                
                var _token = $('input[name="_token"]').val();
               
                swal({
                                    title: "Thêm yêu thích ",
                                    
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-info",
                                    confirmButtonText: "OK",

                                    cancelButtonText: "Đóng",
                                    closeOnConfirm: false,
                                    closeOnCancel: true
                                },
                        function(isConfirm) {
                            if (isConfirm) {
                                    // 
                                    $.ajax({
                                        url: '{{url('/add-wi')}}',
                                        method: 'POST',
                                        data:{cart_product_id:cart_product_id,id_c:id_c,_token:_token},
                                        success:function(){

                                          swal('Đã thêm !');
                                          window.location.reload();
                            
                            


                                        }

                                    });
                            }
                                    
                    });
                    // $.ajax({
                    //     url: '{{url('/add-wi')}}',
                    //     method: 'POST',
                    //     data:{cart_product_id:cart_product_id,id_c:id_c,_token:_token},
                    //     success:function(){

                    //          // swal('Đã thêm !');
                    //          // window.location.reload();
                            
                            


                    //     }

                    // });
                
                    
               
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete-wishlist').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var id_c = $('.customer_id').val();
                
                var _token = $('input[name="_token"]').val();
               

                    $.ajax({
                        url: '{{url('/de-wi')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,id_c:id_c,_token:_token},
                        success:function(){

                            swal('Đã xóa');
                            location.reload();

                        }

                    });
                
                    
               
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.update_view').click(function(){

                
                
                var _token = $('input[name="_token"]').val();
                var customer_id = $('input[name="customer_id"]').val();
                

                    $.ajax({
                        url: '{{url('/update-view')}}',
                        method: 'POST',
                        data:{customer_id:customer_id,_token:_token},
                        success:function(){
                           // swal('aaa');
                            $('#update-view-data').html(data);

                            

                        }

                    });
                
                    
               
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#viewed-all').click(function(){
                swal('abc');
                
                
                
                
                    
               
            });
        });
    </script>



    <script type="text/javascript">
        $(document).ready(function(){
            $('.view-rating').click(function(){
                    
                var product_id = $('.product_id_').val();
                var order_code = $('.order_code_').val();


            


            $.ajax({
                url : '{{url('/view-rating-customer')}}',
                method: 'POST',
                data:{product_id:product_id,order_code:order_code},
                success:function(data){
                   alert('aaa');     
                }
                
            });
        });
        });
          
    </script>



    
   



    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose2').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province2';
            }else{
                result = 'wards2';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
    
    <script type="text/javascript">
        $('#feebb').click(function(){
                
                var matp = $('.city2').val();
                var maqh = $('.province2').val();
                var xaid = $('.wards2').val();
                var _token = $('input[name="_token"]').val();
                

                if(matp != '' && maqh !='' && xaid !=''){
                   
                
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                        
                    }
                    });
                } 
        
    });
    


    
    </script>


    
    <script type="text/javascript">
    $(document).ready(function(){
    $('.btn-block').change(function(){
        
        
              

                        var order_status = $(this).val();
                        var order_id = $(this).children(":selected").attr("id");
                        var _token = $('input[name="_token"]').val();

                        //lay ra so luong
                        quantity = [];
                        $("input[name='product_sales_quantity']").each(function(){
                            quantity.push($(this).val());
                        });
                        //lay ra product id
                        order_product_id = [];
                        $("input[name='order_product_id']").each(function(){
                            order_product_id.push($(this).val());
                        });
                        j = 0;
                        /*
                        for(i=0;i<order_product_id.length;i++){
                            //so luong khach dat
                            var order_qty = $('.order_qty_' + order_product_id[i]).val();
                            //so luong ton kho
                            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                            if(parseInt(order_qty)>parseInt(order_qty_storage) || parseInt(order_qty)<1){
                                j = j + 1;
                                if(j==1){
                                    swal('Lỗi');
                                }
                                $('.color_qty_'+order_product_id[i]).css('background','#000');
                            }
                        } */

                        
                        if(j==0){

                            swal({
                                    title: "Xác nhận ?",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Hủy",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Xác nhận",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                if (isConfirm) {







                          
                                $.ajax({
                                        url : '{{url('/update-order-qty')}}',
                                            method: 'POST',
                                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                                            success:function(data){
                                                
                                                location.reload();
                                            }
                                });



                                } 
              
                             });
                        


                        }

                        


                        

                
       



                                    
        

     

    });
     });


</script>


<script type="text/javascript">
    $(document).ready(function(){
    $('.cancel-order').click(function(){
        
        
              

                        var order_status = 7;
                        var order_id = $('input[name="order_id"]').val();
                        var _token = $('input[name="_token"]').val();

                        //lay ra so luong
                        quantity = [];
                        $("input[name='product_sales_quantity']").each(function(){
                            quantity.push($(this).val());
                        });
                        //lay ra product id
                        order_product_id = [];
                        $("input[name='order_product_id']").each(function(){
                            order_product_id.push($(this).val());
                        });

                        j = 0;
                        /*
                        for(i=0;i<order_product_id.length;i++){
                            //so luong khach dat
                            var order_qty = $('.order_qty_' + order_product_id[i]).val();
                            //so luong ton kho
                            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                            if(parseInt(order_qty)>parseInt(order_qty_storage) || parseInt(order_qty)<1){
                                j = j + 1;
                                if(j==1){
                                    swal('Lỗi');
                                }
                                $('.color_qty_'+order_product_id[i]).css('background','#000');
                            }
                        } */

                        
                        if(j==0){

                            swal({
                                    title: "Xác nhận ?",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Hủy",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Xác nhận",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                if (isConfirm) {







                          
                                $.ajax({
                                        url : '{{url('/update-order-qty')}}',
                                            method: 'POST',
                                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                                            success:function(data){
                                                
                                                location.reload();
                                            }
                                });



                                } 
              
                             });
                        


                        }

     
     

    });
     });


</script>


<script type="text/javascript">
    $(document).ready(function(){
    $('.update_quantity_order').click(function(){
        


        var order_code = $(this).data('order_code');
        var _token = $('input[name="_token"]').val();

        quantity = [];
        $('.quan_'+order_code).each(function(){
                            quantity.push($(this).val());
                        });
                        //lay ra product id
        order_product_id = [];
        $('.pro_id_'+order_code).each(function(){
                            order_product_id.push($(this).val());
                        });

        //  alert(quantity);
        // alert(order_product_id);
        //  alert(order_code);
        //  alert(_token);
        

        // $.ajax({
        //                                 url : '{{url('/update-qty')}}',

        //                                 method: 'POST',

        //                                 data:{_token:_token, order_product_id:order_product_id, quantity:quantity ,order_code:order_code},
        //                                 // dataType:"JSON",
        //                                 success:function(data){

        //                                      swal('Cập nhật số lượng thành công');
                                         
        //                                    location.reload();
                        
                  
                        

        //                                 }
        //                              });
        swal({
                                    title: 'Cập nhật đơn hàng',
                                    text: "" ,
                                    showCancelButton: true,
                                    cancelButtonText: "Hủy",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Xác nhận",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                if (isConfirm) {

                                    $.ajax({
                                        url : '{{url('/update-qty')}}',

                                        method: 'POST',

                                        data:{_token:_token, order_product_id:order_product_id, quantity:quantity ,order_code:order_code},
                                        // dataType:"JSON",
                                        success:function(data){

                                             swal('Cập nhật số lượng thành công');
                                         
                                           location.reload();
                        
                  
                        

                                        }
                                     });



                                } 
              
                             });

        

    });
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $('.cancel-order-pose').click(function(){
        
        
                        var order_status = $(this).data('order_status');
                        var order_code = $(this).data('order_code');
                        var action_name = $(this).data('action_name');
                        
                        var order_id = $('input[name="order_id"]').val();
                        var _token = $('input[name="_token"]').val();

                        alert(order_status);
                        alert(order_code);
                        alert(action_name);
                        alert(order_id);
                        alert(_token);

                        

                        //lay ra so luong
                         quantity = [];
                        $('.quan_'+order_code).each(function(){
                            quantity.push($(this).val());
                        });
                        //lay ra product id
                         order_product_id = [];
                        $('.pro_id_'+order_code).each(function(){
                            order_product_id.push($(this).val());
                        });
                        // quantity = $(this).data('quan');
                        // order_product_id = $(this).data('pro_id');


                        alert(quantity);
                        alert(order_product_id);
                        j = 0;
                       
                        
                        if(j==0){

                            swal({
                                    title: action_name,
                                    text: "" ,
                                    showCancelButton: true,
                                    cancelButtonText: "Hủy",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Xác nhận",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                if (isConfirm) {

                                $.ajax({
                                        url : '{{url('/update-order-qty')}}',
                                            method: 'POST',
                                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id,order_code:order_code},
                                            success:function(data){
                                                
                                                location.reload();
                                            }
                                });



                                } 
              
                             });
                        


                        }

                        



    });
     });


</script>




<script>
    $('.gio-hang').mouseover(function(){
                
        var _token = $('input[name="_token"]').val();
                
        $.ajax({
                url : '{{url('/view-cart')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    
                   $('#xem-gio-hang').html(data);
                }
            });
                
        
    });
</script>
<script>
    $('#xem-gio-hang').click(function(){
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                url : '{{url('/view-cart2')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    
                   $('#xem-gio-hang').html(data);
                }
            });
        
    });
</script>


<script>$(".product_name_p").each(function(){if ($(this).text().length > 25) {$(this).text($(this).text().substr(0, 25));$(this).append('...');}});</script>

<script>
        function kiemtra(){
            
            var tendangnhap = document.forms["form-re"]["customer_name"].value;
            var matkhau = document.forms["form-re"]["customer_password"].value;
            var check = true;
           
            
            
            
            if(tendangnhap == null || tendangnhap == ""){
                document.getElementById("baoloitendangnhap").innerHTML = "Tên đăng nhập không được để trống!";
                document.getElementById("baoloitendangnhap").style.color = "red";
                check = false;
            }else{
                document.getElementById("baoloitendangnhap").innerHTML = "";
            }
            
            


            var kt_mk = /^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Za-z0-9]).{6,15}$/;
            
            if (!kt_mk.test(matkhau)) {
                document.getElementById("baoloimatkhau").innerHTML =
                    "Mật khẩu sai định dạng, phải có cả chữ cái và số; không được có ký tự khác ngoài chữ cái và số; dài từ 6 đến 15 ký tự";
                     document.getElementById("baoloimatkhau").style.color = "red";
                check = false;
            } else {
                document.getElementById("baoloimatkhau").innerHTML =
                    "<span style='visibility: hidden;'>!</span>";
            }
            

            var mk2 = document.forms["form-re"]["customer_password2"].value;
            if(matkhau != mk2){
                document.getElementById("xacnhan").innerHTML = "Mật khẩu gõ lại không đúng!";
                document.getElementById("xacnhan").style.color = "red";
                check = false;
            }else{
                document.getElementById("xacnhan").innerHTML = "";
            }

            
            
            return check;
        }
    </script>

    <script >
 
   $("#check_email").blur(function (e) { //user types username on inputfiled
   var username = $(this).val(); //get the string typed by user
    
    
    var _token = $('input[name="_token"]').val();
                
                $.ajax({
                url : '{{url('/check-email')}}',
                method: 'POST',
                data:{_token:_token,username:username},
                success:function(data){
                    
                   $('#check_result').html(data);
                }
            });

});
    </script>

<script >
 
   $("#check_email3").click(function (e) { //user types username on inputfiled
    //get the string typed by user
    
    var customer_id = $('input[name="customer_id"]').val();
    var _token = $('input[name="_token"]').val();
                
                $.ajax({
                url : '{{url('/check-email3')}}',
                method: 'POST',
                data:{_token:_token,customer_id:customer_id},
                success:function(data){
                    swal('aaa');
                   $('#check_result').html(data);
                }
            });

});
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#show-hide").click(function (e) { //user types username on inputfiled
            $('#cat-br').slideToggle(300);
    
    

    });

});


</script>


<script type="text/javascript">
    $(document).ready(function(){
        var customer_id = $('input[name="customer_id"]').val();
        var _token = $('input[name="_token"]').val();
        

        $.ajax({
                url : '{{url('/check-email4')}}',
                method: 'POST',
                data:{_token:_token,customer_id:customer_id},
                success:function(data){
                    
                   $('#nou-num').html(data);
                }
            });



     });


</script>



<script type="text/javascript">
      /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown11").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    var customer_id = $('input[name="customer_id"]').val();
    var _token = $('input[name="_token"]').val();
                
                $.ajax({
                url : '{{url('/check-email3')}}',
                method: 'POST',
                data:{_token:_token,customer_id:customer_id},
                success:function(data){
                    
                   $('#myDropdown11').html(data);
                }
            });

  if (!event.target.matches('.dropbtn11')) {
    var dropdowns = document.getElementsByClassName("dropdown-content11");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}  
</script>

<script type="text/javascript">
    function calcRate(r) {
        const f = ~~r,//Tương tự Math.floor(r)
        id = 'star' + f + (r % f ? 'half' : '')
        id && (document.getElementById(id).checked = !0)
    }
</script>

<script>
      function quay_lai_trang_truoc(){
          history.back();
      }
  </script>

<script type="text/javascript">
    $('._back').click(function(){
        
        history.back();


     });


</script>





