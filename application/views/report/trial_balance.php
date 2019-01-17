<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="Jetson is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Jetson Admin, Jetsonadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>dist/img/logo.png">
	<link rel="icon" href="<?php echo base_url(); ?>dist/img/logo.png" type="image/x-icon">

	

	<!--alerts CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Data table CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-pink">
		<!-- Top Menu Items -->
			<?php $this->load->view("header"); ?>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
			<?php $this->load->view("sidebar"); ?>
		<!-- /Left Sidebar Menu -->
		
		<!-- Right Sidebar Menu -->
			<?php //$this->load->view("right_sidebar"); ?>
		<!-- /Right Sidebar Menu -->
		
		

		
		

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		
							<div class="pull-left"><i class="fa  fa-th mr-5"></i><span class="right-nav-text">Trial Balance</span></div>

					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
						<li class="active"><span>Trial Balance</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<div class="row">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<div class="panel">

							<div class="panel-wrapper collapse in">

						
									<div class="table-wrap mt-0">
										<div class="table-responsive">
                                            <table class="table table-hover table-bordered mb-0">
                                                <thead>

                                                <tr>
                                                    <th colspan="2" style="text-align: center;">Debit</th>

                                                    <th colspan="2" style="text-align: center;">Credit</th>

                                                </tr>

                                                <tr>
                                                    <th>Description</th>
                                                    <th style="text-align: right;">Amount</th>
                                                    <th>Description</th>
                                                    <th class="text-nowrap" style="text-align: right;">Amount</th>
                                                </tr>


                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Cash in Hand</td>
                                                    <td style="text-align: right;"><?php echo number_format($CashBalance,2);?></td>
                                                    <td>Investment</td>
                                                    <td class="text-nowrap" style="text-align: right;"><?php echo number_format($EquityCapital,2);?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Cash in Bank</td>
                                                    <td style="text-align: right;"><?php echo number_format($BankBalance,2);?></td>
                                                    <td>Sale Amount</td>
                                                    <td style="text-align: right;" class="text-nowrap"><?php echo number_format($SaleAmount,2);?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purchase amount</td>
                                                    <td style="text-align: right;"><?php echo number_format($PurchaseAmount,2);?> </td>
                                                    <td>Advance Received</td>
                                                    <td style="text-align: right;" class="text-nowrap"><?php echo number_format($AdvanceAmount,2);?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Salary Given</td>
                                                    <td style="text-align: right;"><?php echo number_format($SalaryExpense,2);?></td>
                                                    <td></td>
                                                    <td style="text-align: right;" class="text-nowrap"> </td>
                                                </tr>
                                                <tr>
                                                    <td>Other Expenses</td>
                                                    <td style="text-align: right;"><?php echo number_format($OtherExpense,2);?></td>
                                                    <td></td>
                                                    <td style="text-align: right;" class="text-nowrap"></td>
                                                </tr>
                                                <tr>
                                                    <td>Equity withdraw by owner</td>
                                                    <td style="text-align: right;" ><?php echo number_format($EquityWithdraw,2);?></td>
                                                    <td></td>
                                                    <td style="text-align: right;" class="text-nowrap"> </td>
                                                </tr>

                                                <tr>
                                                    <td><br> </td>
                                                    <td style="text-align: right;" > </td>
                                                    <td></td>
                                                    <td style="text-align: right;" class="text-nowrap"> </td>
                                                </tr>

                                                <tr>
                                                    <td><br> </td>
                                                    <td style="text-align: right;" > </td>
                                                    <td></td>
                                                    <td style="text-align: right;" class="text-nowrap"> </td>
                                                </tr>



                                                </tbody>
                                                <tfoot>
                                                    <tf>
                                                        <td style="font-size: 16px;font-weight: bold;">Total</td>
                                                        <td style="text-align: right;font-size: 16px;font-weight: bold;"><?php echo number_format(($EquityWithdraw+$OtherExpense+$SalaryExpense+$PurchaseAmount+$BankBalance+$CashBalance),2);?></td>
                                                        <td style="font-size: 16px;font-weight: bold;">Total</td>
                                                        <td style="text-align: right;font-size: 16px;font-weight: bold;"><?php echo number_format(($EquityCapital+$SaleAmount+$AdvanceAmount),2);?></td>
                                                    </tf>
                                                </tfoot>
                                            </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Basic Table -->



					


				</div>	
				
				
				</div>

			
			<!-- Footer -->
			<?php $this->view("footer"); ?>
			<!-- /Footer -->
			
		</div>
		<!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<!-- Piety JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/peity/jquery.peity.min.js"></script>
	<script src="<?php echo base_url();?>dist/js/peity-data.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="<?php echo base_url();?>dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->


	<!-- Sweet-Alert  -->
	<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>


	<!-- Data table JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>vendors/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url();?>dist/js/responsive-datatable-data.js"></script>


	<script type="text/javascript">
			


	</script>
	
</body>

</html>
