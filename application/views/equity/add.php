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
		
		
		<!-- Jasny-bootstrap CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

		<!-- Bootstrap Dropify CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>

		<!-- switchery CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
		
		<!-- Custom CSS -->
		<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">

		<!--alerts CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

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
						  <h5 class="txt-dark"><?php echo ucfirst($mode); ?> Equity <?php echo $Type; ?></h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'equity/'.$Type; ?>"><span>Equity <?php echo $Type; ?></span></a></li>
						    <li class="active"><span><?php echo ucfirst($mode); ?></span></li>
						  </ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->
					
					<!-- Row -->
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default card-view">
								
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
                                            <?php if($mode == 'add'){
                                                $url = base_url().'equity/';
                                                $url =  ($Type == 'capital')?$url.'add_capital':$url.'add_withdraw';
                                            }
                                            else{
                                                $url = base_url().'equity/update';;
                                            }
                                            ?>
											<form name="form one" method="post" action="<?php echo $url;?>" >

													<div class="row">
														<div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Date</label>
                                                                <input type="date" name="Date" id="Date" required="required"  class="form-control"
                                                                       value="<?php echo isset($Date)?$Date:date('Y-m-d'); ?>" >
                                                            </div>




                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Pay <?php echo ($Type == 'capital')?'to':'from'; ?></label>
                                                                <select class="form-control" name="PaymentAccountID" id="PaymentAccountID" required="required">

                                                                    <?php
                                                                    foreach($Accounts as $Ac)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $Ac['PaymentAccountID']; ?>" <?php echo (isset($PaymentAccountID) && $PaymentAccountID == $Ac['PaymentAccountID'])?'selected':''; ?> ><?php echo $Ac['PaymentAccountName']; ?></option>

                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Amount</label>
																<input type="text" name="Amount" id="Amount"  placeholder="Enter  Amount" class="form-control"
																value="<?php echo isset($Amount)?$Amount:''; ?>" >
															</div>


                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Details</label>
                                                                <textarea name="Description" id="Description"  placeholder="Enter description" class="form-control"><?php echo isset($Description)?$Description:''; ?></textarea>
                                                            </div>


                                                                <div class="col-sm-2 col-xs-6 mt-15">
                                                                    <input type="hidden" name="EquityID" id="EquityID" value="<?php echo isset($EquityID)?$EquityID:''; ?>">
                                                                    <input type="hidden" name="Type" id="Type" value="<?php echo isset($Type)?$Type:''; ?>">

                                                                    <button class="btn btn-primary  btn-rounded btn-block btn-anim"><i class="fa fa-check-square"></i><span class="btn-text"><?php echo ucfirst($mode); ?> </span></button>
                                                                </div>



                                                                <div class="col-sm-2 col-xs-6 mt-15">
                                                                    <a class="btn btn-danger  btn-rounded btn-block btn-anim" href="<?php echo base_url().'salary'; ?>"><i class="fa fa-minus-circle"></i><span class="btn-text">Cancel</span></a>
                                                                </div>




                                                        </div>





															



														</div>



												
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>




					</div>
					<!-- /Row -->
					
					
					
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
		
		<script src="<?php echo base_url();?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?php echo base_url();?>dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="<?php echo base_url();?>dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- Owl JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
		<!-- Switchery JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/switchery/dist/switchery.min.js"></script>


		<!-- Bootstrap Daterangepicker JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
		

		<!-- Form Flie Upload Data JavaScript -->
		<script src="<?php echo base_url();?>dist/js/form-file-upload-data.js"></script>

		<!-- Sweet-Alert  -->
		<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>



		<script type="text/javascript">
			


		</script>


		


	</body>
</html>