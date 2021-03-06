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
						  <h5 class="txt-dark"><?php echo ucfirst($mode); ?> Product</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'product'; ?>"><span>Product</span></a></li>
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
											<form name="form one" method="post" action="<?php echo base_url().'product/'.$mode;?>" enctype="multipart/form-data">

													<div class="row">
														<div class="col-sm-6">

															<div class="form-group">
																<label class="control-label mb-10 text-left">Product Code</label>
																<input type="text" name="ProductCode" id="ProductCode" required="required" placeholder="Enter Product Code" class="form-control"
																value="<?php echo isset($ProductCode)?$ProductCode:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Product Name</label>
																<input type="text" name="ProductName" id="ProductName" required="required" placeholder="Enter Product name" class="form-control"
																value="<?php echo isset($ProductName)?$ProductName:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10">Product Category</label>
																<select class="form-control" name="CategoryID" id="CategoryID" required="required" >
																	<option value="">Chose a Category</option>
																	
<?php
													foreach($Category as $Cat)
													{
?>
																	<option value="<?php echo $Cat['CategoryID']; ?>" <?php echo (isset($CategoryID) && $CategoryID == $Cat['CategoryID'])?'selected':''; ?> >
																	<?php echo $Cat['CategoryName']; ?></option>
<?php
													}
?>
																</select>
															</div>


															<div class="form-group">
																<label class="control-label mb-10 text-left">Product Coast</label>
																<input type="number" name="ProductCost" id="ProductCost" placeholder="Enter Coast" class="form-control"
																value="<?php echo isset($ProductCost)?$ProductCost:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Product Price</label>
																<input type="number" name="ProductPrice" id="ProductPrice" required="required" placeholder="Enter Price" class="form-control"
																value="<?php echo isset($ProductPrice)?$ProductPrice:''; ?>" >
															</div>


														</div>

														<div class="col-sm-6">

															<div class="form-group">
																<label class="control-label mb-10">Product Tax</label>
																<select class="form-control" name="TaxID" id="TaxID" required="required" >
																	<option value="">Chose Tax</option>
																	
<?php
													foreach($Tax as $Tx)
													{
?>
																	<option value="<?php echo $Tx['TaxID']; ?>" <?php echo (isset($TaxID) && $TaxID == $Tx['TaxID'])?'selected':''; ?> ><?php echo $Tx['TaxName']; ?></option>
<?php
													}
?>
																</select>
															</div>


															<div class="form-group">
																<label class="control-label mb-10">Tax Method</label>
																<select class="form-control" name="TaxMethod" id="TaxMethod"  >
																	<option value="exclusive" <?php echo (isset($TaxMethod) && $TaxMethod == 'exclusive')?'selected':''; ?>>Exclusive</option>
																	<option value="inclusive" <?php echo (isset($TaxMethod) && $TaxMethod == 'inclusive')?'selected':''; ?>>Inclusive</option>																	

																</select>
															</div>

															<div class="panel-wrapper collapse in">
																<div class="panel-body">
																	<label class="control-label mb-1">Product Image</label>
																	<div class="mt-20">
<?php
																		if((isset($ImageID) && $ImageID != 0 ) && file_exists($ImagePath.'/'.$ImageName))
																		{
																			$Photo 	=	base_url().$ImagePath.'/'.$ImageName;
																		}
																		else
																		{
																			$Photo 	=	 base_url().'img/noimage.png';
																		}
?>
																		<input type="file" id="input-file-now-custom-1" name="Photo" class="dropify" 
																		data-default-file="<?php echo $Photo;?>" />
																	</div>	
																</div>
															</div>



														</div>

														<div class="col-sm-12">

															
<?php 									if($mode == 'update')
										{
?>											
															<div class="form-group">
																<div class="checkbox checkbox-success">
																	<input id="ProductActive" name="ProductActive" type="checkbox" value="1" <?php echo (isset($ProductActive) && $ProductActive == 1)?'checked':''; ?>>
																	<label for="ProductActive"> Product Active </label>
																</div>
															</div>
<?php 									}
?>																


															<br>
															<div class="col-sm-2 col-xs-6 mt-15">
																<input type="hidden" name="ProductID" id="ProductID" value="<?php echo isset($ProductID)?$ProductID:''; ?>">
																<input type="hidden" name="ImageID" id="ImageID" value="<?php echo isset($ImageID)?$ImageID:''; ?>">
																<button class="btn btn-primary  btn-rounded btn-block btn-anim"><i class="fa fa-check-square"></i><span class="btn-text"><?php echo ucfirst($mode); ?> Product</span></button>
															</div>



															<div class="col-sm-2 col-xs-6 mt-15">
																<a class="btn btn-danger  btn-rounded btn-block btn-anim" href="<?php echo base_url().'product'; ?>"><i class="fa fa-minus-circle"></i><span class="btn-text">Cancel</span></a>
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



		


		


	</body>
</html>