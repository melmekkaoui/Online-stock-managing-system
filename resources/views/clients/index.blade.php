@extends('layouts.master')
@section('title')
	برنامج الفواتير - قائمة الزبائن
@endsection
@section('css')
<!-- Internal Data table css -->
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
							<h4 class="content-title mb-0 my-auto">الزبائن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الزبائن </span>
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
							<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة زبون</a>


							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
													<th class="border-bottom-0">#</th>
													<th class="border-bottom-0">اسم الزبون</th>
													<th class="border-bottom-0">رقم الهاتف</th>
													<th class="border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
											<?php $i=0; ?>
											@foreach ( $clients as $x)
												<?php $i++ ?>
												<tr>
													<td>{{$i}}</td>
													<td>{{$x->fname." ".$x->lname}}</td>
													<td>{{$x->phone_number}}</td>
													<td>
													
														<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
															data-id="{{ $x->id }}" data-fname="{{ $x->fname }}"
															data-lname="{{ $x->lname }}" data-phone_number = "{{$x->phone_number}}" data-toggle="modal"
															href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
													

													
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
															data-id="{{ $x->id }}" data-fname="{{ $x->fname }}"
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
										<h6 class="modal-title">إضافة زبون جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form action="{{route('clients.store')}}" method="post">
											{{csrf_field()}}
											<div class="form-group"> 
												<label for="">اسم الزبون</label>
												<input type="text" class="form-control" id="section_name" name="fname">
											</div>
                                            <div class="form-group"> 
												<label for="">نسب الزبون</label>
												<input type="text" class="form-control" id="section_name" name="lname">
											</div>
											<div class="form-group"> 
												<label for="">رقم الهاتف</label>
												<input type="text" class="form-control" id="section_name" name="phone_number">
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
				<!-- edit -->
				<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل الزبون</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="clients/update" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="recipient-name" class="col-form-label">اسم الزبون</label>
                            <input class="form-control" name="fname" id="fname" type="text">
                        </div>
						<div class="form-group">
                            <label for="recipient-name" class="col-form-label">النسب </label>
                            <input class="form-control" name="lname" id="lname" type="text">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">رقم الهاتف</label>
                            <input class="form-control" id="phone_number" name="phone_number" type="text" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>

	 <!-- delete -->
	 <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الزبون</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="clients/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="fname" id="fname" type="text" readonly>
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
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fname = button.data('fname')
        var lname = button.data('lname')
        
		var phone_number = button.data('phone_number')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #fname').val(fname);
        modal.find('.modal-body #lname').val(lname);

        modal.find('.modal-body #phone_number').val(phone_number);
    })

</script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fname = button.data('fname')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #fname').val(fname);
    })

</script>

@endsection
