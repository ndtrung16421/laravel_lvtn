@extends('layout_not_slider')
@section('content')

		@if(session()->has('add_customer'))
                    <div class="alert alert-success">
                        {!! session()->get('add_customer') !!}
                        {!! session()->put('add_customer',null) !!}
                    </div>
                
        @endif
	
		
						
						<form action="{{URL::to('/login-customer')}}" method="POST" class="ln">
							<h1>Đăng nhập tài khoản</h1>
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" required="" />
							<input type="password" name="password_account" placeholder="Password" required="" />

						<!--
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>

						-->
							<button type="submit" >Đăng nhập</button>

							
							
						</form>
				
	

@endsection