@extends('layouts.master')
@section('title')
	برنامج ادارة المبيعات - سلة المورد
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
							<h4 class="content-title mb-0 my-auto">التسوق</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  سلة المورد</span>
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
							@if (session()->has('error'))
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>{{ session()->get('error') }}</strong>
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
							<div class="card-header pb-3">
	<!------------------------- this is  select by codebar of the produt -------------------->
									<form action="{{route('suppliercart.store')}}" method="post">
											{{csrf_field()}}
										<div class="row row-sm">
											<input type="hidden" value="1" name="cart_number" id="">
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">اسم المنتج</p>
												<input type="text" class="form-control" id="inputName" placeholder="اسم المنتج"  name="product_name">
											</div>
                                            <div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الكمية</p>
												<input type="text" class="form-control" id="inputName" placeholder="الكمية"  name="qty">
											</div>
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الثمن</p>
												<input type="text" class="form-control" id="inputName" placeholder="الثمن" autofocus name="price">
											</div>											
										</div>
										<button type="submit" class="d-none"></button>
									</form>
							</div>
	<!---------------- -------------- end the selection by the barcode ---------------------->
                        
							
						</div>
					</div>
					<!--/div-->
				</div>


				<div class="row">
				<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!------------------------------ this is a ajax selection by section-------------------------------->
								
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>اسم المنتج</th>
												<th>الكمية</th>
												<th>ثمن </th>
												<th>المجموع</th>
												
												<th>حدف</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 
													$i=0; 
													$total = 0;
												?>
												@foreach ($pr as $x )

												<?php 
													$i++; 
													$total += $x->product_qty * $x->product_price;
												?>

													<th scope="row">{{$i}}</th>
													<td>{{$x->product_name}}</td>
													
														<td>{{$x->product_qty}}</td>
														<td>{{$x->product_price}}</td>
														
													
													<td>{{$x->product_qty * $x->product_price}} درهم</td>
													<td><a href="{{url("/suppliercart/delete/".$x->id)}}" class="btn btn-sm btn-danger"> <i class="las la-trash"></i></a></td>
											
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				
				</div>


<!-- ---------------------------Basic modal------------------------------- -->
					
		<!-- End Basic modal -->
				

	 


				<!-- row closed -->

			<div class="row">
				<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!------------------------------ this is a ajax selection by section-------------------------------->
								<h3>الآداء والفاتورة</h3>
								<h4>المجموع {{$total}} درهم</h4>
								<form action="{{route('supplierInvoice.store')}}" method="post">
											{{csrf_field()}}
									<div class="row row-sm">

											<input type="hidden" value="{{$total}}" name="invoice_price" id="">
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الثمن المدفوع بالدرهم</p>
												<input type="text" class="form-control" id="inputName" placeholder="الثمن المدفوع" value="0" name="paid_price">
											</div>
											
											
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">المورد</p>
												<select class="form-control select2" name="supplier_id">
													<option  selected>اختر مورد</option>
													@foreach($sups as $x)
														<option value="{{$x->id}}" >{{$x->supplier_name}}</option>
													@endforeach
										
												</select>
											</div>		
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">حالة الفاتورة</p>
												<select class="form-control select2" name="payment_status">
													<option value="غير مدفوعة" selected> غير مدفوعة</option>
													<option value=" مدفوعة جزئيا" selected>  مدفوعة جزئيا</option>
													<option value=" مدفوعة" selected>  مدفوعة</option>
										
												</select>
											</div>																
									</div>
									<div class="row row-xs wd-xl-80p mt-3">
									<div class="col-sm-6 col-md-3">
										<button type="submit" class="btn btn-success btn-block"><i class="las la-print"></i> حفظ وطباعة</button>
									</div>
									
								
							</div>

								</form>

							</div>
						</div>
					</div>
				
				</div>




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
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="code2"]').empty();
							$('select[name="code2"]').append('<option disabled selected value> اختر القسم </option>');
                        
                            $.each(data, function(key, value) {
                                $('select[name="code2"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>




@endsection



