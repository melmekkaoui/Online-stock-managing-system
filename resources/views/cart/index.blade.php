@extends('layouts.master')
@section('title')
	برنامج ادارة المبيعات - سلة التسوق
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
							<h4 class="content-title mb-0 my-auto">التسوق</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سلة التسوق 1</span>
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
							<div class="card-header pb-0">
	<!------------------------- this is  select by codebar of the produt -------------------->
									<form action="{{route('cart.store')}}" method="post">
											{{csrf_field()}}
										<div class="row row-sm">
											<input type="hidden" value="1" name="cart_number" id="">
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الكمية</p>
												<input type="text" class="form-control" id="inputName" placeholder="الكمية" value="1" name="qty">
											</div>
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الشفرة</p>
												<input type="text" class="form-control" id="inputName" placeholder="الشفرة" autofocus name="code">
											</div>											
										</div>
										<button type="submit" class="d-none"></button>
									</form>
							</div>
	<!---------------- -------------- end the selection by the barcode ---------------------->
							<div class="card-body">
								<div class="row row-xs wd-xl-80p">
										<div class="col-sm-6 col-md-3">
											<a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة عنصر مؤقت</a>
										</div>
										<div class="col-sm-6 col-md-3">
												<button data-toggle="dropdown" class="btn btn-indigo btn-block">السلة <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i></button>
												<div class="dropdown-menu">
													<a href="/cart" class="dropdown-item">السلة 1</a>
													<a href="/cart/multiple/2" class="dropdown-item">السلة 2</a>
													<a href="/cart/multiple/3" class="dropdown-item">السلة 3</a>												
												</div><!-- dropdown-menu -->
											</div>
										<div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
											<a href="{{url('/cart/1/empty')}}" class="btn btn-danger btn-block">اخلاء السلة</a>
										</div>
								</div>
							
							</div>
						</div>
					</div>
					<!--/div-->
				</div>


				<div class="row">
				<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!------------------------------ this is a ajax selection by section-------------------------------->
								<div class="row m-3">
										<h4></h4>
										<h5 class="mr-3">المجموع بالدرهم{{$total}}</h5>
										<h5 class="mr-3">المجموع بالريال {{$total*20}}</h5>
								</div>
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>اسم المنتج</th>
												<th>الكمية</th>
												<th>ثمن البيع</th>
												<th>تحديث</th>
												<th>المجموع </th>
												<th>حدف</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php $i=0; ?>
												@foreach ($cart as $x )

												<?php $i++; ?>

													<th scope="row">{{$i}}</th>
													<td>{{$x->product_designation}}</td>
													<form  action="{{route('cart.update',$x->id)}}" method="POST" enctype='multipart/form-data'>
															@csrf
															@method('PUT')
														<input type="hidden" name="product_id" value="{{$x->id}}">
														<td><input name="product_qty" style="width:100px;" value="{{$x->product_qty}}"/></td>
														<td><input name="sell_price" style="width:100px;" value="{{$x->sell_price}}"/></td>
														<td><button type="submit" class="btn btn-sm btn-info"> <i class="las la-pen"></i></button></td>
													</form>
													<td>{{$x->subtotal}} درهم</td>
													<td><a href="{{url("/cart/".$x->id."/delete")}}" class="btn btn-sm btn-danger"> <i class="las la-trash"></i></a></td>
											
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
						<div class="modal" id="modaldemo8">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">إضافة منتج جديد للسلة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form action="{{url('/cart/storeTmp')}}" method="post">
											@csrf
											
											<div class="form-group"> 
												<input type="hidden" name="cart_number" value="1" id="">
												<label for="">اسم المنتج</label>
												<input type="text" class="form-control" id="product_name" name="pname">
											</div>
                                            <div class="form-group"> 
												<label for="">ثمن البيع</label>
												<input type="text" class="form-control" id="section_name" name="sell_price">
											</div>
											<div class="form-group"> 
												<label for="">الكمية</label>
												<input type="text" class="form-control" id="section_name" name="qty">
											</div>

											<div class="modal-footer">
												<button class="btn ripple btn-success" type="submit">حفظ المعطيات</button>
												<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
		<!-- End Basic modal -->
				

	 <!-- delete -->
	 <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الوحدة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="units/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="unit_name" id="unit_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
           		 </div>
            	</form>
        	</div>	
    	</div>


				<!-- row closed -->

			<div class="row">
				<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!------------------------------ this is a ajax selection by section-------------------------------->
								<h3>الآداء والفاتورة</h3>
								<form action="{{route('order.store')}}" method="post">
											{{csrf_field()}}
									<div class="row row-sm">

											<input type="hidden" value="1" name="cart_number" id="">
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<input type="hidden" name="order_price" value="{{$total}}">
												<p class="mg-b-10">الثمن المدفوع بالدرهم</p>
												<input type="text" class="form-control" id="inputName" placeholder="الثمن المدفوع" value="{{$total}}" name="paid_price">
											</div>
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الخصم</p>
												<input type="text" class="form-control" id="inputName" value="0"  name="discount">
											</div>	
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">طريقة الدفع</p>
												<select class="form-control select2" name="paymethod">

													<option value="1" selected>كاش/نقدا</option>
													<option value="2">تحويل بنكي</option>
													
												</select>
											</div>
											<div class="col-lg-3 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الزبون</p>
												<select class="form-control select2" name="client">
													<option value="0" selected>زبون زائر</option>
													@foreach($clients as $x)
														<option value="{{$x->id}}" >{{$x->fname." ".$x->lname}}</option>
													@endforeach
													
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


				<div class="row">
				<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!------------------------------ this is a ajax selection by section-------------------------------->

							<form action="{{route('cart.store')}}" method="post">
											{{csrf_field()}}
										<div class="row row-sm">
											<input type="hidden" value="1" name="cart_number" id="">
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">الكمية</p>
												<input type="text" class="form-control" id="inputName" placeholder="الكمية" value="1" name="qty">
											</div>
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
													<!-- retrieve the sections-->	
												<p class="mg-b-10">القسم</p>
												<select class="form-control select2-no-search" name="Section">
												<option disabled selected value> اختر القسم </option>
												
													@foreach ($sections as $x)
														<option value="{{$x->id}}">
															{{$x->section_name}}
														</option>
													@endforeach
												</select>
											</div>	
											<!-- end the sections-->	
											<div class="col-lg-4 mg-b-20 mg-lg-b-0">
												<p class="mg-b-10">المنتج</p>
												<select class="form-control select2" onchange="this.form.submit()" name="code2">

													<option></option>
													
												</select>
											</div>									
										</div>
										<button type="submit" class="d-none"></button>
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



