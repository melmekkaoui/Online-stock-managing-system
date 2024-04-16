<!DOCTYPE html>
<html lang="en">
	<head>
		<title>طباعة فاتورة المستورد</title>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layouts.head')
	</head>
	<style>
		.logo{
			border:3px solid #180059;
            

		}
        h3{
            font-size:35px !important;
        }
		.logo i{
			font-size: 30px;
		}
        .invoice_detail,.more-detail{
            font-size: 24px;
        }
        .ivoice_content{
            font-size:20px;
        }

		@media print {
			.card-header{
				display: none ;
                
				
			}

			#invoice{
                width: 100%;
            }
		}
	</style>
	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		
		<!-- main-content -->
		<div class="main-content app-content">
			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				



					<div class="card mg-b-20">
							<div class="card-header pb-0">
								<h3>طباعة الفاتورة</h3>
								<div class="mt-3 row row-xs wd-xl-80p">
									<div class="col-sm-6 col-md-3">
										<button class="btn btn-primary btn-block" onclick="window.print();">طباعة</button>
									</div>
									<div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
										<a href="/suppliercart" class="btn btn-secondary btn-block">عودة لسلة المورد</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="invoice_controll">



								</div>
								<div class="invoice" id="invoice">
                                     <div class="logo text-center">
                                           <h3> <i class="typcn typcn-shopping-cart invoice_logo"></i>فاتورة المورد </h3>
                                     </div>
                                     <div class="invoice_detail">
                                        <div class="mt-3">
                                            <p>رقم الطلبية : {{$inv->invoice_tracking}}</p>
                                            <p>التاريخ: {{$inv->created_at}}</p>
                                            <p>المورد: {{$supp->supplier_name}}</p>
                                            
                                        </div>
                                     </div>
                                     <div class="ivoice_content">
                                     <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th> المنتج</th>
												<th>الكمية</th>
												<th>ثمن</th>
												<th>المجموع </th>
												
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php $i=0; ?>
												@foreach ($items as $x )

												<?php $i++; ?>

													<th scope="row">{{$i}}</th>
													<td>{{$x->product_name}}</td>
                                                    <td>{{$x->product_qty}}</td>
                                                    <td>{{$x->product_price}} درهم</td>
													<td>{{$x->product_price * $x->product_qty}} درهم</td>
													
											
											</tr>
											@endforeach
											
										</tbody>
									</table>
                                     </div>
                                     <div>
                                        <div class="more-detail">
                                            <div class="mt-3">
                                                    <h4>المجموع: {{$inv->invoice_price }} درهم</h4>
                                                    <p> القيمة المدفوعة : {{($inv->paid_price)}}</p>
                                                    <p>حالة الدفع : {{($inv->payment_status)}}</p>
                                                    
                                                    <p>الباقي : {{($inv->invoice_price - $inv->paid_price)}} درهم</p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="invoice_footer">
                                        <div class="logo text-center">
                                            <h3> <i class="las la-smile invoice_logo"></i> سعداء بالتعامل معكم وشكرا على زيارتكم</h3>
                                        </div>
                                     </div>
                                </div>
						    </div>
					



				<!-- row closed -->



			</div>
			<!-- Container closed -->
		</div>



















































				
            	
				@include('layouts.footer-scripts')	
	</body>
</html>
	

























































































						

