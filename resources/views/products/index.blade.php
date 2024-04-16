@extends('layouts.master')
@section('title')
	برنامج ادارة المبيعات - قائمة المنتجات
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
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المنتجات </span>
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
							<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة منتج جديد</a>


							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
													<th class="border-bottom-0">#</th>
													<th class="border-bottom-0">اسم المنتج</th>
													<th class="border-bottom-0">ثمن الشراء</th>
                                                    <th class="border-bottom-0">ثمن البيع</th>
													<th class="border-bottom-0">الكمية الباقية</th>
                                                    
													<th class="border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
											<?php $i=0; ?>
											@foreach ( $products as $x)
												<?php $i++ ?>
												<tr>
													<td>{{$i}}</td>
													<td>{{$x->product_designation}}</td>
													<td>{{$x->purchase_price}} درهم</td>
													<td>{{$x->sell_price}} درهم</td>
													<td>{{$x->product_qty}}</td>
													<td>
													
														<a class="btn btn-sm btn-info"
															href="products/{{$x->id}}/edit" title="تعديل"><i class="las la-pen"></i></a>
													

													
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
															data-id="{{ $x->id }}" data-unit_name="{{ $x->unit_name }}"
															data-toggle="modal" href="#modaldemo9" title="حذف"><i
																class="las la-trash"></i></a>
													
													</td>
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
						<div class="modal" id="modaldemo8">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">إضافة منتج جديد في المخزن</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form action="{{route('products.store')}}" method="post">
											{{csrf_field()}}
                                            <div class="mb-4">
                                                <p class="mg-b-10">قسم المنتج</p>
                                                <select name="section_id" class="form-control SlectBox">
                                                    <!--placeholder-->
													@foreach ($section as $x)
														<option value="{{$x->id}}">{{$x->section_name}}</option>
												
													
													@endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <p class="mg-b-10">وحدة المنتج</p>
                                                <select name="unit_id" class="form-control SlectBox">
                                                    <!--placeholder-->
                                                    @foreach ($units as $x)
														<option value="{{$x->id}}">{{$x->unit_name}}</option>
												
													
													@endforeach
                                                </select>
                                            </div>
                                            <div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													تاريخ انتهاء الصلاحية:
												</div>
											</div>
											<input  class="form-control" id="dateMask" placeholder="MM/DD/YYYY" type="text" name="exp_date">
										</div><!-- input-group -->
											<div class="form-group"> 
												<label for="">اسم المنتج</label>
												<input type="text" class="form-control" id="unit_name" name="product_desig">
											</div>
											<div class="form-group"> 
												<label for="">الكمية الكاملة </label>
												<input type="text" class="form-control" id="unit_name" name="product_qty">
											</div>
											<div class="form-group"> 
												<label for="">الكمية الحرجة </label>
												<input type="text" class="form-control" id="unit_name" name="crt_qty">
											</div>
											<div class="form-group"> 
												<label for="">ثمن الشراء</label>
												<input type="text" class="form-control" id="unit_name" name="purchase_price">
											</div>
											<div class="form-group"> 
												<label for="">ثمن البيع</label>
												<input type="text" class="form-control" id="unit_name" name="selling_price">
											</div>
											<div class="form-group"> 
												<label for="">اكواد المنتج</label>
												<div class="form-inline">
													<div class="form-group m2-2">
														<label for="staticEmail2" class="sr-only">الشفرة 1</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 1" name="code_1" onkeypress="return (event.key!='Enter')">
													</div>
													<div class="form-group m-2">
														<label for="staticEmail2" class="sr-only">الشفرة 2</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 2" name="code_2" onkeypress="return (event.key!='Enter')">
													</div>
												</div>
												<div class="form-inline">
													<div class="form-group m2-2">
														<label for="staticEmail2" class="sr-only">الشفرة 3</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 3" name="code_3" onkeypress="return (event.key!='Enter')">
													</div>
													<div class="form-group m-2">
														<label for="staticEmail2" class="sr-only">شقرة 4</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 4" name="code_4" onkeypress="return (event.key!='Enter')">
													</div>
												</div>
												<div class="form-inline">
													<div class="form-group m2-2">
														<label for="staticEmail2" class="sr-only">الشفرة 5</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 5" name="code_5" onkeypress="return (event.key!='Enter')">
													</div>
													<div class="form-group m-2">
														<label for="staticEmail2" class="sr-only">الشفرة 6</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 6" name="code_6" onkeypress="return (event.key!='Enter')">
													</div>
												</div>
												<div class="form-inline">
													<div class="form-group m2-2">
														<label for="staticEmail2" class="sr-only">الشفرة 7</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 7" name="code_7" onkeypress="return (event.key!='Enter')">
													</div>
													<div class="form-group m-2">
														<label for="staticEmail2" class="sr-only">الشفرة 8</label>
														<input type="text"  class="form-control" id="staticEmail2" placeholder="code 8" name="code_8" onkeypress="return (event.key!='Enter')">
													</div>
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

				</div>
				

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
