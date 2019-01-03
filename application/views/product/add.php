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
																<label class="control-label mb-10 text-left">Product Cost</label>
																<input type="text" name="ProductCost" id="ProductCost" placeholder="Enter Cost" class="form-control"
																value="<?php echo isset($ProductCost)?$ProductCost:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Product Price</label>
																<input type="text" name="ProductPrice" id="ProductPrice"  placeholder="Enter Price" class="form-control"
																value="<?php echo isset($ProductPrice)?$ProductPrice:''; ?>" >
															</div>



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
																<label class="control-label mb-10">Product Units</label>
																<select class="form-control" name="UnitsID" id="UnitsID" required="required" >
																	<option value="">Chose a Unit</option>
																	
<?php
													foreach($Units as $Unit)
													{
?>
																	<option value="<?php echo $Unit['UnitsID']; ?>" <?php echo (isset($UnitsID) && $UnitsID == $Unit['UnitsID'])?'selected':''; ?> >
																	<?php echo $Unit['UnitsName']; ?></option>
<?php
													}
?>
																</select>
															</div>

															<div class="form-group">
																<div class="checkbox checkbox-success">
																	<input id="UseExpireDate" name="UseExpireDate" type="checkbox" value="1" <?php echo (isset($UseExpireDate) && $UseExpireDate == 1)?'checked':''; ?>>
																	<label for="UseExpireDate"> User Product Expiry Date </label>
																</div>
															</div>

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

														</div>

														<div class="col-sm-6">
<?php 									if($mode == 'update')
										{
?>	
															<div class="panel panel-default card-view">
																<div class="panel-heading">
																	<div class="pull-left">
																		<h6 class="panel-title txt-dark">Multi Units</h6>
																	</div>

																	<div class="pull-right">			
																		<a href="#" onclick="AddMU();"><div class="pull-left"><i class="fa fa-plus-square mr-5"></i><span class="right-nav-text">New</span></div></a>
																	</div>
																	
																	<div class="clearfix"></div>
																</div>
																<div class="panel-wrapper collapse in">
																	<div  class="panel-body row pa-0">
																		<table class="table table-hover mb-0" id="TableMU">
																			<thead >
																				<tr>
																					<th>Barcode</th>
																					<th>Units</th>																					
																					<th>Quantity</th>																					
																					<th>Cost</th>
																					<th>Price</th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody id="THeadValue">
<?php
																			foreach($MUS as $MU)
																			{
?>																				<tr id="MU<?php echo $MU['ProductMUID']; ?>">
																					<td> <?php echo $MU['Barcode'];?> </td>
																					<td> <?php echo $MU['UnitsName'];?> </td>
																					<td> <?php echo $MU['Quantity'];?> </td>
																					<td> <?php echo $MU['Cost'];?> </td>
																					<td> <?php echo $MU['Price'];?> </td>
																					<td> <a href="#" onclick="DeleteMU(<?php echo $MU['ProductMUID']; ?>);" data-toggle="tooltip" data-original-title="Close"> 
																						<i class="fa fa-close text-danger"></i> </a> </td>
																					</td>
																				</tr>
<?php
																			}
?>																																					
																		
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>

<?php 									}
?>															
															
															<div class="form-group">
																<label class="control-label mb-10 text-left">Refeence Number</label>
																<input type="text" name="ReferenceNo" id="ReferenceNo"  placeholder="Enter Price" class="form-control"
																value="<?php echo isset($ReferenceNo)?$ReferenceNo:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Re order Level</label>
																<input type="number" name="ReOrderLevel" id="ReOrderLevel"  placeholder="Enter Price" class="form-control"
																value="<?php echo isset($ReOrderLevel)?$ReOrderLevel:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10">Manufatcure</label>
																<select class="form-control" name="ManufactureID" id="ManufactureID"  >
																	<option value="">Chose one</option>
																	
<?php
													foreach($Manufactures as $MF)
													{
?>
																	<option value="<?php echo $MF['ManufactureID']; ?>" <?php echo (isset($ManufactureID) && $ManufactureID == $MF['ManufactureID'])?'selected':''; ?> >
																	<?php echo $MF['ManufactureName']; ?></option>
<?php
													}
?>
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

						<!-- MOdal for Order View -->
						<div id="MUModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content " id="">

									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h5 class="modal-title" >Multi Units</h5>
									</div>
									<div class="modal-body" id="MUModalContent">
										<!--start -->


									</div>

								<div class="modal-footer">
									<button onclick="InsertMU();" type="button" class="btn btn-success text-left" >Add Unit</button>

								</div>

								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->


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
			
			function AddMU()
			{

				$('#MUModalContent').html('<div class="form-group"><label class="control-label mb-10 text-left">Barcode</label>'+
										'<input type="text" name="Barcode" id="Barcode" placeholder="Enter Barcode" class="form-control" value="" >	</div>'+
										'<div class="form-group">'+
										'<label class="control-label mb-10">Product Units</label>'+
										'<select class="form-control" name="MUUnitsID" id="MUUnitsID" required="required" >'+
										'<option value="">Chose a Unit</option>'+											
										'<?php	foreach($Units as $Unit){?>'+
											'<option value="<?php echo $Unit["UnitsID"]; ?>"  >'+
											'<?php echo $Unit["UnitsName"]; ?></option>'+
											'<?php } ?>	</select></div>'+
										'<div class="form-group"><label class="control-label mb-10 text-left">Quantity</label>'+
										'<input type="number" name="Quantity" id="Quantity" placeholder="Enter Quantity" class="form-control" value="" >	</div>'+
										'<div class="form-group"><label class="control-label mb-10 text-left">Cost</label>'+
										'<input type="number" name="Cost" id="Cost" placeholder="Enter Coast" class="form-control"	value="" >	</div>'+
										'<div class="form-group"> <label class="control-label mb-10 text-left">Price</label>'+
										'<input type="number" name="Price" id="Price" required="required" placeholder="Enter Price" class="form-control" value="" >	</div>	</div>	');
			    $('#MUModal').modal('toggle');
				
			}

			function InsertMU()
			{
				var ProductID 	=	$('#ProductID').val();
				var Barcode 	=	$('#Barcode').val();
				var UnitsID 	=	$('#MUUnitsID').val();
				var Quantity 	=	$('#Quantity').val();
				var Cost 		=	$('#Cost').val();
				var Price 		=	$('#Price').val();

				if(Barcode == '')
				{
					swal("Barcode!", "Please Enter the barcode", "warning");
					return(false);
				}
				else if(UnitsID == '')
				{
					swal("Units!", "Please Select Unit", "warning");
					return(false);
				}
				 
				else if(Quantity <= 0)
				{
					swal("Quantity!", "Plese enter Quantity", "warning");
					return(false);
				}
				else
				{
					$.ajax({
					      url: '<?php echo base_url()."product/add_mu_ajax";?>',
					      type: 'post',
					      data: { ProductID: ProductID , UnitsID: UnitsID, Barcode: Barcode, Quantity: Quantity, Cost: Cost, Price: Price},
					      success: function(data) {
					      	var obj = jQuery.parseJSON( data );
					      	if(obj.ProductMUID >= 0)
					      	{
					      		$('#TableMU tr:last').after('<tr id="MU'+obj.ProductMUID+'">'+					      			
									'<td> '+Barcode+' </td>'+
									'<td> '+obj.UnitName+' </td>'+
									'<td> '+Quantity+' </td>'+
									'<td> '+Cost+' </td>'+
									'<td> '+Price+' </td>'+
									'<td> <a href="#" onclick="DeleteMU('+obj.ProductMUID+');" data-toggle="tooltip" data-original-title="Close">'+ 
									'<i class="fa fa-close text-danger"></i> </a> </td></tr>');
					      		$('#MUModal').modal('hide');
					      	}
					      				        
					      },
					      error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					      }
					    });

					
				}

				
				

			}

			function DeleteMU(ProductMUID)
			{
				swal({   
	            title: "Are you sure?",   
	            text: "You will not be able to recover this file!",   
	            type: "warning",   
	            showCancelButton: true,   
	            confirmButtonColor: "#f8b32d",   
	            confirmButtonText: "Yes, delete it!",   
	            cancelButtonText: "No, cancel !",   
	            closeOnConfirm: false,   
	            closeOnCancel: false 
		        }, function(isConfirm){   
		            if (isConfirm) {
		            	$.ajax({
					      url: '<?php echo base_url()."product/delete_mu";?>',
					      type: 'post',
					      data: { ProductMUID: ProductMUID},
					      success: function(data) {
					      
					      	console.log(data);
					      	if(data == true)
					      	{
					      		//$('table#TableData tr#'+id).remove();
					      		$('table#TableMU tr#MU'+ProductMUID).hide('slow', function(){ $('table#TableData tr#MU'+ProductMUID).remove(); });
					      		swal("Deleted!", "Your file has been deleted.", "success");
					      	}
					      	else
					      	{
					      		 swal("Cancelled", "Your file is safe :)", "error");
					      	}
					        
					      },
					      error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					      }
					    }); // end ajax call     
		                   
		            } else {     
		                swal("Cancelled", "Your file is safe :)", "error");   
		            } 
		        });
			}

		</script>


		


	</body>
</html>