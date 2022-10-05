<br>
    <center>
        <div class="container">

            <div class="row">
                <div class="col-sm-9">
                    <center>
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <!--
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                            <li data-target="#slider-carousel" data-slide-to="4"></li>
                            -->
                        @php 
                            $k = 0;
                        @endphp
                        @foreach($slider as $key => $sli)
                            <li data-target="#slider-carousel" data-slide-to="{{$k}}" ></li>
                            @php 
                                $k++;
                            @endphp

                        @endforeach


                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 300px;
                            }
                        </style>
                        <div class="carousel-inner">
                        @php 
                            $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                            @php 
                                $i++;
                            @endphp

                            <div class="item {{$i==1 ? 'active' : '' }}">
                                
                                
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}"  class="img img-responsive img-slider" width="100%">
                                
                                
                            </div>

                        @endforeach  
                          
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </center>
                    
                </div>

                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/b1.png')}}" height="300" width="100%" alt="" />
                </div>
            </div>
            <br>
            <div class="row">
                
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                <div class="col-sm-3">
                    <img src="{{url('/public/frontend/images/tt1.png')}}" height="100%" width="100%" alt="" />
                </div>
                

                
            </div>



        </div>


        </center>