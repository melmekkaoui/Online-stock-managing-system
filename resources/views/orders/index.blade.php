@extends('layouts.master')
@section('title')
	برنامج ادارة المبيعات - قائمة المبيعات
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
							<h4 class="content-title mb-0 my-auto">المبيعات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المبيعات </span>
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

                                    <h3>سجل المبيعات</h3>

                                    <div class="mt-3">
                                            <form action="order/search" method="post" class="row">
												@csrf
                                                <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                                                    <p class="mg-b-10">رقم تتبع الطبية</p>
                                                    <input type="text" class="form-control" value="commande_" name="tracking_number">
                                                </div>
                                                <div class="col-lg-4 mg-b-20 mg-lg-b-0">
												
												<button type="submit" class="btn btn-primary " style="margin:2rem;">بحث</button>
											</div>
                                            </form>

                                    </div>

							</div>
							<div class="card-body">
								
                            <div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الزبون</th>
												<th>رقم الطلبية</th>
												<th>عدد المنتجات</th>
												<th>الثمن</th>
												<th>العمليات</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php $i=0; ?>
												@foreach ($orders as $x )

												<?php $i++; ?>

													<th scope="row">{{$i}}</th>
													<td>زائر</td>
													<td>{{$x->tracking_number}} </td>
                                                    <td>{{$x->orderItems()->count()}}</td>
                                                    <td>{{$x->order_price}}</td>
													<td><a href="{{url("/order/".$x->id)}}" class="btn btn-sm btn-primary"> <i class="las la-print"></i></a> / <a href="{{url("/order/delete/".$x->id)}}" class="btn btn-sm btn-danger"> <i class="las la-trash"></i></a></td>

											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>





							</div>
						</div>
					</div>
					<!--/div-->
						
					<!-- Basic modal -->
						



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
