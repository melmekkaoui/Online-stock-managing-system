@extends('layouts.master')
@section('title')
	برنامج ادارة المبيعات - تحديث المنتج
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تحديث المنتج</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
						<!-- div open-->
						<div class="col-xl-12">
							@if($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							@if (session()->has('Add'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>{{ session()->get('Add') }}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif

							@if (session()->has('delete'))
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>{{ session()->get('delete') }}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif

							@if (session()->has('edit'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>{{ session()->get('edit') }}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif

						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="mb-4 main-content-label">تحديث المنتج</div>
								<form action="{{route('products.update',$product->id)}}" method="POST" enctype='multipart/form-data'>
								@csrf
								@method('PUT')
								 
									<div class="mb-4 main-content-label">القسم والوحدة</div>
									<div class="row row-sm">
										<input type="hidden" value="{{$product->id}}" name="product_id" />
										<input type="hidden" value="{{$product->section_id}}" name="section_id" />
										<input type="hidden" value="{{$product->unit_id}}" name="unit_id" />

										<div class="col-lg form-groupe">
											<label for="">قسم المنتج</label>
											<input class="form-control"  value="{{$product->getsection->section_name}}" readonly type="text">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">وحدة المنتج</label>
											<input class="form-control"  value="{{$product->getunit->unit_name}}" readonly type="text">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
										
										<label for="">تاريخ انتهاء الصلاحية</label>
											<input  class="form-control" id="dateMask" value="{{(!empty($product->experation_date)) ? $product->experation_date : " لا يوجد تاريخ انتهاء الصلاحية"}}" placeholder="لا يوجد تاريخ انتهاء الصلاحية" type="text" name="exp_date">
										</div>
									</div>
									<div class="mt-4 mb-4 main-content-label"> تفاصيل المنتج </div>
									<div class="mt-4 row row-sm">
										
										<div class="col-lg form-groupe">
											<label for=""> اسم المنتج </label>
											<input class="form-control" value="{{$product->product_designation}}"  type="text" name="product_name">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">الكمية في المخزن</label>
											<input class="form-control" value="{{$product->product_qty}}"  type="text" name="product_qty">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">الكمية الحرجة</label>
											<input class="form-control" value="{{$product->critical_qty}}"  type="text" name="critical_qty">
										</div>
									</div>
									<div class="mt-4 row row-sm">
										
										<div class="col-lg form-groupe">
											<label for="">ثمن الشراء</label>
											<input class="form-control" value="{{$product->purchase_price}}" type="text" name="purchase_price">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">ثمن البيع</label>
											<input class="form-control" value="{{$product->sell_price}}"  type="text" name="sell_price">
										</div>
										
									</div>

									
									<div class="mt-4 mb-4 main-content-label">أكواد المنتج</div>
									<div class="mt-4 row row-sm">
										
										<div class="col-lg form-groupe">
											<label for=""> كود 1</label>
											<input class="form-control" value="{{$product->code1}} "  type="text" name="code1">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">كود 2</label>
											<input class="form-control" value="{{$product->code2}} "  type="text" name="code2">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">كود 3</label>
											<input class="form-control" value="{{$product->code3}}"  type="text" name="code3">
										</div>
									</div>
									<div class="mt-4 row row-sm">
										
										<div class="col-lg form-groupe">
											<label for=""> كود 4</label>
											<input class="form-control" value="{{$product->code4}}"  type="text" name="code4">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">كود 5</label>
											<input class="form-control" value="{{$product->code5}}"  type="text" name="code5">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">كود 6</label>
											<input class="form-control" value="{{$product->code6}}"  type="text" name="code6">
										</div>
									</div>
									<div class="mt-4 row row-sm">
										
										<div class="col-lg form-groupe">
											<label for=""> كود 7</label>
											<input class="form-control" value="{{$product->code7}}"  type="text" name="code7">
										</div>
										<div class="col-lg mg-t-10 mg-lg-t-0 form-groupe">
											<label for="">كود 8</label>
											<input class="form-control" value="{{$product->code8}} "  type="text" name="code8">
										</div>
										
									</div>



								<button type="submit" class="mt-4 btn btn-primary">تحديث تفاصيل المنتج</button>

								</form>
								

							</div>
							<div class="card-body">
								
						</div>
					</div>
					<!--/div-->



				<!-- row closed -->



			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>



<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>







<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var unit_name = button.data('unit_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #unit_name').val(unit_name);
        modal.find('.modal-body #description').val(description);
    })

</script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var unit_name = button.data('unit_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #unit_name').val(unit_name);
    })

</script>

@endsection
