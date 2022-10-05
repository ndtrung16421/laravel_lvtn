@extends('admin_layout')
@section('admin_content')
<h3><center> Trang quản trị Admin</center></h3>

@hasrole(['admin','statistical'])
<div class="row">
	<p class="title_thongke">
		Thống kê doanh số
	</p>
	<div class="col-xs-9">
		<form autocomplete="off" style="display: inline;" >
		@csrf
			<table>
				<tr>
					<td>
				
						Từ ngày: <input type="text" id="datepicker" class="form-control" style="width: 200px;">
					</td>
					<td>
						Đến ngày: 
						<input type="text" id="datepicker2" class="form-control" style="width: 200px;">
				</td>
				</tr>
			</table>
			
			<select id="pro_ca" name="pro_ca" class="pro_ca" style="width: 300px;">
			<option selected value ="-1"> Danh mục sản phẩm</option>
			@foreach ($product_category as $key => $proc)
				<option value="{{$proc->DanhMuc_id}}">{{$proc->DanhMuc_Ten}}</option>

			@endforeach
			</select>

			<select id="spi" name="product_id" class="product_id" style="width: 300px;">
			<option selected value ="-1"> Tất cả sản phẩm</option>
			@foreach ($product as $key => $pro)
				<option value="{{$pro->SanPham_id}}">{{$pro->SanPham_Ten}}</option>

			@endforeach
			</select>

			<!-- <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"> -->
			
	</div>
		

	<div class="col-xs-3">
			<p>
				Lọc theo:
				<select class="dashboard-filter form-control">
					<option >Chọn</option>
					<option value="7ngay">7 ngày qua</option>
					<option value="thangtruoc">Tháng trước</option>
					<option value="thangnay">Tháng này</option>
					<option value="365ngayqua">365 ngày qua</option>
					
				</select>
			</p>
	</div>
	</form>
</div>

	<div  class="col-12">
		<div id="myfirstchart" style="height: auto;">
			
		</div>
	</div>
@endhasrole
@endsection