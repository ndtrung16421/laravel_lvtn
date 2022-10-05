@extends('admin_layout')
@section('admin_content')

 @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {!! session()->pull('message') !!}
                                </div>
                                    
                    @elseif(session()->has('error'))
                                 <div class="alert alert-danger">
                                    {!! session()->pull('error') !!}
                                </div>

                    @endif

<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Xã Phường</th>
        <th>Quận huyện</th>
        <th>Tỉnh</th>
        <th>Phí vận chuyển</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
        @foreach($list as $key => $li)
        	<tr>
        		<td>
        			{{$li->PhiVanChuyen_id}}
        		</td>
        		<td>
        			@foreach($xa as $key => $x)
        				@if($li->XaPhuong_id ==  $x->XaPhuong_id)
        					{{$x->XaPhuong_Ten}}

        					@php
        						$quanid = $x->QuanHuyen_id;
        					@endphp
        				@endif
        			@endforeach

        			
        		</td>
        		<td>
        			@foreach($quan as $key => $q)
        				@if($quanid ==  $q->QuanHuyen_id)
        					{{$q->QuanHuyen_Ten}}
        					@php
        						$tinhid = $q->TinhThanhPho_id;
        					@endphp
        					
        				@endif

        			@endforeach
        		</td>
        		<td>
        			@foreach($tinh as $key => $t)
        				@if($tinhid ==  $t->TinhThanhPho_id)
        					{{$t->TinhThanhPho_Ten}}
        					
        					
        				@endif

        			@endforeach
        		</td>
        		<td>
        			<form action="{{URL::to('/update-fee')}}" method="POST" >
  					@csrf
        			<input type="number" name="fee_number" value="{{$li->PhiVanChuyen_Gia}}" />
        			<input type="hidden" name="fee_code" value="{{$li->PhiVanChuyen_id}}" />
        		</td>

        		<td>
        			<a href="{{URL::to('/delete-fee/'.$li->PhiVanChuyen_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này ko?')">
        				<i class="fa fa-times text-danger text"></i>
		                	
		             </a>
        		</td>
        		<td>
        			 <button class="btn btn-success" type="submit">Cập nhật</button>
					</form>
        		</td>


        	</tr>

        @endforeach
      
    </tbody>
  </table>

@endsection