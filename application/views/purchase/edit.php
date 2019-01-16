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

		<!--alerts CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

		<!-- select2 CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

		<!-- bootstrap-select CSS -->
		<link href="<?php echo base_url();?>vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>






		
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
						  <h5 class="txt-dark">Purchase</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'purchase'; ?>"><span>Purchase</span></a></li>
						<li class="active">New purchase</span></li>
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
				<form name="form one" method="post" action="<?php echo base_url().'purchase/update';?>" id="PurchaseForm" >

					<div class="row">


						<div class="col-sm-3">

							
							<div class="form-group ">
								<label class="control-label mb-10 text-left">Reference No</label>
								<input type="text" class="form-control" id="ReferenceNo" name="ReferenceNo" placeholder="Enter Reference No" required="required" value="<?php echo isset($ReferenceNo)?$ReferenceNo:''; ?>">
							</div>


						</div>

						
						<div class="col-sm-3">

							<div class="form-group">
								<label class="control-label mb-10">Supplier</label>
								<select class="form-control select2" name="SupplierID" id="SupplierID" required="required" >
									<option value="">Chose a Supplier</option>
									
<?php
					foreach($Suppliers as $Sup)
					{
?>
									<option value="<?php echo $Sup['SupplierID']; ?>" <?php echo (isset($SupplierID) && $SupplierID == $Sup['SupplierID'])?'selected':''; ?> >
									<?php echo $Sup['SupplierName']; ?> </option>
<?php
					}
?>




								</select>
							</div>


						</div>



						<div class="col-sm-3">	



							<div class="form-group">
								<label class="control-label mb-10 text-left">Date</label>
								<input type="date" name="PurchaseDate" id="PurchaseDate" required="required"  class="form-control"
								value="<?php echo isset($PurchaseDate)?$PurchaseDate:date('Y-m-d'); ?>" >
							</div>

						</div>

						<div class="col-sm-3">

							<div class="form-group">
								<label class="control-label mb-10">Warehouse</label>
								<select class="form-control select2" name="WarehouseID" id="WarehouseID" required="required" >
									<option value="">Chose a Warehouse</option>
									
<?php
					foreach($Warehouse as $WH)
					{
?>
									<option value="<?php echo $WH['WarehouseID']; ?>" <?php echo (isset($WarehouseID) && $WarehouseID == $WH['WarehouseID'])?'selected':''; ?> >
									<?php echo $WH['WarehouseName']; ?> </option>
<?php
					}
?>




								</select>
							</div>


						</div>



					
					</div>

					<div class="row mb-10" >


						<div class="col-sm-12">

							
							<div class="form-group" style="margin-bottom:0;">
                                <div class="input-group wide-tip">
                                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                     	<i class="fa fa-2x fa-barcode addIcon"></i>
                                 	</div>
                                    <input type="text" onchange="SelectProduct();" name="ItemSearch" class="form-control input-lg ui-autocomplete-input" id="ItemSearch" placeholder="Please add products " autocomplete="off">
                           			<div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                            <a href="#" id="addManually1" tabindex="-1"><i class="fa fa-2x fa-plus-circle addIcon" id="addIcon"></i></a>
                                    </div>
                                </div>
                            </div>

						</div>

						<br>

						
					</div>
					
					<div class="row" id="AllItem">

						<div class="col-sm-12 ">
							<div class="panel ">
								
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="ProductTable" class="table table-hover display  pb-30" >
													<thead>
														<tr>
															<th></th>
															<th>Barcode</th>
															<th>Name</th>
															<th>Unit</th>
															<th>Amount</th>
															<th>QTY</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													
<?php
	
			foreach($Items as $Item)
			{

				if($Item['MUStat'] == 'yes')
				{
					$MU =	$this->m_purchase->view_purchase_mu($Item['ProductID']);
					$Item['ProductCode'] 	=	$MU['Barcode'];
					$Item['ProductName'] 	=	$Item['ProductName'].' X '.$MU['Quantity'];
					$Item['UnitsName'] 		=	$MU['UnitsName'];
				}

?>		
													<tr id="MU<?php echo $Item['ItemSl'];?>">
										      			<input type="hidden" name="ProductID[<?php echo $Item['ItemSl'];?>]" id="ProductID<?php echo $Item['ItemSl'];?>" value="<?php echo $Item['ProductID'];?>" >	
										      			<input type="hidden" name="ProductMUID[<?php echo $Item['ItemSl'];?>]" id="ProductMUID<?php echo $Item['ItemSl'];?>" value="<?php echo $Item['ProductMUID'];?>" >				      			
														<input type="hidden" name="MUStat[<?php echo $Item['ItemSl'];?>]" id="MUStat<?php echo $Item['ItemSl'];?>" value="<?php echo $Item['MUStat'];?>" >	
														<input type="hidden" name="ItemSl[<?php echo $Item['ItemSl'];?>]" id="ItemSl<?php echo $Item['ItemSl'];?>" value="<?php echo $Item['ItemSl'];?>"  >
														<input type="hidden" name="ProductBatchID[<?php echo $Item['ItemSl'];?>]" id="ProductBatchID<?php echo $Item['ItemSl'];?>" value="<?php echo $Item['ProductBatchID'];?>"  >
														<td style="width: 2%;"><a href="#" onclick="RemoveItem(<?php echo $Item['ItemSl'];?>);" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>			      			
														<td><?php echo $Item['ProductCode'];?></td>
														<td> <?php echo $Item['ProductName'];?> </td>
														<td> <?php echo $Item['UnitsName'];?></td>
														<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="ProductCost<?php echo $Item['ItemSl'];?>" name="ProductCost[<?php echo $Item['ItemSl'];?>]"  
															required="required" value="<?php echo $Item['ProductCost'];?>" onkeyup="PriceChange(<?php echo $Item['ItemSl'];?>);"></td>
														<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity<?php echo $Item['ItemSl'];?>" name="Quantity[<?php echo $Item['ItemSl'];?>]" 
															value="<?php echo $Item['Quantity'];?>" required="required" onkeyup="PriceChange(<?php echo $Item['ItemSl'];?>);"></td>
														<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Price<?php echo $Item['ItemSl'];?>" name="Price[<?php echo $Item['ItemSl'];?>]" 
															value="<?php echo number_format($Item['Price'],2, '.', '');?>" required="required" onkeyup="PriceChange(<?php echo $Item['ItemSl'];?>,2);"></td>
													</tr>


<?php  		}
?>									
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>

						
					</div>

						


						<div class="row">

						
						<div class="col-sm-3">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary" >Amount</button>
				                </div>
				                <input type="text" class="form-control" id="Amount" name="Amount" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;" value="<?php echo isset($Amount)?number_format($Amount,2, '.', ''):''; ?>">
				              </div>
				          </div>

				          <div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary" >Tax</button>
				                </div>
									<select class="form-control" name="TaxRate" id="TaxRate" onchange="GrandTotal();" required="required">
										<option value="">Chose Tax</option>
										
<?php
						foreach($Tax as $Tx)
						{
?>
										<option value="<?php echo $Tx['TaxRate']; ?>" <?php echo (isset($TaxRate) && $TaxRate == $Tx['TaxRate'])?'selected':''; ?> ><?php echo $Tx['TaxName']; ?></option>
										
<?php
						}
?>
									</select>
				              </div>
				          </div>


				          <div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary">Vat </button>
				                </div>
				                <input type="text" class="form-control" id="TaxAmount" name="TaxAmount" onkeyup="GrandTotal();" style="font-size:13px; font-weight: bold;text-align:right;" value="<?php echo isset($TaxAmount)?number_format($TaxAmount,2, '.', ''):''; ?>">
				              </div>
				          </div>


				        <div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary">Discount</button>
				                </div>
				                <input type="text" class="form-control" id="Discount" name="Discount" onkeyup="GrandTotal();" style="font-size:13px; font-weight: bold;;text-align:right;" value="<?php echo isset($Discount)?number_format($Discount,2, '.', ''):''; ?>">
				              </div>
				          </div>

			

				          <div class="col-sm-3">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary" >Total</button>
				                </div>
				                <input type="text" class="form-control" id="TotalAmount" name="TotalAmount" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;" value="<?php echo isset($TotalAmount)?number_format($TotalAmount,2, '.', ''):''; ?>">
				              </div>
				          </div>




						</div>

                    <div class="row">
                        <br>
                        <div class="col-sm-9">

                        </div>
                        <div class="col-sm-3">
                            <div class="input-group has-success">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-success"  onclick="TotalAmountClick();" title="Click here to get Payment Details ">Paid</button>
                                </div>
                                <input type="text" class="form-control" id="PaidAmount" name="PaidAmount"  style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;cursor: pointer;" readonly value="<?php echo number_format($PaidAmount,2,'.', ''); ?>" onclick="TotalAmountClick();">
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <br>
                        <div class="col-sm-9">

                        </div>
                        <div class="col-sm-3">
                            <div class="input-group has-warning">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning" >Balance</button>
                                </div>
                                <input type="text" class="form-control" id="BalanceAmount" name="BalanceAmount" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;" value="<?php echo number_format(($TotalAmount-$PaidAmount),2,'.', ''); ?>">
                            </div>
                        </div>



                    </div>





                    <div class="row">
                        <br>


                        <div class="col-sm-10">

                        </div>


                        <div class="col-sm-2 pull-right">
                            <input type="hidden" name="PurchaseID" id="PurchaseID" value="<?php echo isset($PurchaseID)?$PurchaseID:''; ?>">
                            <input type="hidden" name="ItemNo" id="ItemNo" value="<?php echo isset($ItemNo)?$ItemNo:''; ?>">
                            <button class="btn btn-primary  btn-rounded btn-block btn-anim" type="button" onclick="SubmitForm();"><i class="fa fa-check-square"></i><span class="btn-text">Update</span></button>

                        </div>

                    </div>


																								
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>


						<!-- MOdal for Order View -->
						<div id="ProductModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content " id="">

									<div class="modal-header">
										
										<h5 class="modal-title" >Expiry Details</h5>
									</div>
									<div class="modal-body" id="ProductModalContent">
										<!--start -->


									</div>

								<div class="modal-footer">

									<button onclick="CancelModal('ProductModal');" type="button" class="btn btn-danger text-left" >Cancel</button>
									<button onclick="InsertProduct();" type="button" class="btn btn-success text-left" >Add </button>

								</div>

								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->


						<!-- MOdal for Order View -->
						<div id="SearchModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content " id="">

									<div class="modal-header">
										
										<h5 class="modal-title" >Serach product</h5>
									</div>
									<div class="modal-body" id="SearchModalContent">
										<!--start -->


									</div>

								<div class="modal-footer">
									<button onclick="CancelModal('SearchModal');" type="button" class="btn btn-danger text-left" >Cancel</button>
	
								</div>

								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->

                        <!-- MOdal for Order View -->
                        <div id="OFModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content " id="OFModalContent">

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

		<!-- Bootstrap Select JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

		<!-- Select2 JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/select2/dist/js/select2.full.min.js"></script>






<script type="text/javascript">

		

			var IC 	=	parseInt($('#ItemNo').val());

			//for form submit
			function SubmitForm()
			{
				//alert("hai");
				if($('#ReferenceNo').val() == '')
				{
					$('#ReferenceNo').focus();
					swal("Reference Number", "Please enter the reference number", "warning");
					
				}
				else if($('#SupplierID').val() == '')
				{
					$('#SupplierID').focus();
					swal("Supplier", "Please chose a supplier", "warning");
					
				}
				else if($('#PurchaseDate').val() == '')
				{
					$('#PurchaseDate').focus();
					swal("Date", "Please enter a date", "warning");
					
				}
				else if($('#WarehouseID').val() == '')
				{
					$('#WarehouseID').focus();
					swal("Warehouse", "Please chose a warehouse", "warning");
					
				}
				else if($('#ItemNo').val() <= 1)
				{
					swal("No Items", "Please add items", "warning");
				}
				else
				{
					$("#PurchaseForm").submit();
				}
				
			}

            function TotalAmountClick()
            {
                let PurchaseID 	=	$('#PurchaseID').val();

                $.ajax({
                    url: '<?php echo base_url()."purchase/view_payment";?>',
                    type: 'post',
                    data: { PurchaseID: PurchaseID},
                    success: function(data) {
                        $('#OFModalContent').html(data);
                        $('#OFModal').modal('toggle');
                    },
                    error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            }

			function SelectProduct()
			{
				var ItemSearch 	=	$('#ItemSearch').val();
				//alert(ItemSearch);
				$.ajax({
					      url: '<?php echo base_url()."purchase/search_product";?>',
					      type: 'post',
					      data: { ItemSearch: ItemSearch },
					      success: function(data) {
					      	if(data != 0)
					      	{
					      		var obj = jQuery.parseJSON(data);
						      	//console.log(data);
						      	if(obj.UseExpireDate == 1)
						      	{
						      		var BarcodeField 	=	'';
						      		if(obj.MUStat == 'yes')
									{
										obj.ProductName 	=	obj.ProductName+' X '+obj.MUQuantity;

									}	

					      			$('#ProductModalContent').html('<input type="hidden" name="EProductID" id="EProductID" value="'+obj.ProductID+'" >'+
					      				'<input type="hidden" name="EProductCode" id="EProductCode" value="'+obj.ProductCode+'" >'+
					      				'<input type="hidden" name="EProductName" id="EProductName" value="'+obj.ProductName+'" >'+
					      				'<input type="hidden" name="EUnitsName" id="EUnitsName" value="'+obj.UnitsName+'" >'+
					      				'<input type="hidden" name="EProductCost" id="EProductCost" value="'+obj.ProductCost+'" >'+
					      				'<input type="hidden" name="EProductMUID" id="EProductMUID" value="'+obj.ProductMUID+'" >'+
					      				'<input type="hidden" name="EMUStat" id="EMUStat" value="'+obj.MUStat+'" >'+
					      				'<input type="hidden" name="EMUQuantity" id="EMUQuantity" value="'+obj.MUQuantity+'" >'+
										'<table class="table table-hover display  pb-30" > <thead><th>Barcode</th><th>Name</th><th>Unit</th><th>cost</th></thead>'+
										'<tbody><tr><td>'+obj.ProductCode+'</td><td>'+obj.ProductName+'</td><td>'+obj.UnitsName+'</td> <td> '+obj.ProductCost+'</td>	</tr> <tbody> </table>'+										
										' <div class="col-sm-3"><div class="form-group"><label class="control-label mb-10 text-left">Quantity</label>'+
										'<input type="number" name="EQuantity" id="EQuantity"  class="form-control" value="1" >	</div> </div>'+
										' <div class="col-sm-3"><div class="form-group"><label class="control-label mb-10 text-left">BatchNo</label>'+
										'<input type="text" name="BatchNo" id="BatchNo" placeholder="Enter Batch no" class="form-control"	>	</div> </div>'+
										' <div class="col-sm-3"><div class="form-group"> <label class="control-label mb-10 text-left">ExpiryDate</label>'+
										'<input type="date" name="ExpiryDate" id="ExpiryDate" required="required" placeholder="Please enter Expoire date" class="form-control" value="" >	</div>	</div> </div>	');
			   						$('#ProductModal').modal('toggle');
						      	}
						      	else
						      	{
						      		IC++;
						      		$('#ItemNo').val(IC);
						      		if(obj.MUStat == 'yes')
									{
										obj.ProductName 	=	obj.ProductName+' X '+obj.MUQuantity;
									}	
									let Price 	=	parseInt(obj.ProductCost);
									Price 		=	Price.toFixed(2);
						      		$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
						      			'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+obj.ProductID+'" >'+	
						      			'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+obj.ProductMUID+'" >'+					      			
										'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+obj.MUStat+'" >'+	
										'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+
										'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+			      			
										'<td> '+obj.ProductCode+' </td>'+
										'<td> '+obj.ProductName+' </td>'+
										'<td> '+obj.UnitsName+' </td>'+
										'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="ProductCost'+IC+'" name="ProductCost['+IC+']"  required="required" value="'+obj.ProductCost+'" onkeyup="PriceChange('+IC+');"></td>'+
										'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="1" required="required" onkeyup="PriceChange('+IC+');"></td>'+
										'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Price'+IC+'" name="Price['+IC+']" value="'+Price+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
										'</tr>');
						      		$('#ProductModal').modal('hide');
						      		$('#ItemSearch').val('');
						      		$( "#ItemSearch" ).focus();
						      		GrandTotal();
						      	}
					      	}
					      	else
					      	{
					      		
					      		$.ajax({
							      url: '<?php echo base_url()."purchase/search_product_det";?>',
							      type: 'post',
							      data: { ItemSearch: ItemSearch },
							      success: function(data) {
										if(data != 0)
					      				{
					      					let SelectTable	='<table class="table table-hover display  pb-30" > ';
					      					var res = jQuery.parseJSON(data);
								      		for(let i=0; i< res.length; i++)
						      				{
						      					//console.log(res[i].ProductID);
						      					SelectTable	+='<tr onclick="InsertSearch('+res[i].ProductID+');"><td >'+res[i].ProductCode+'</td>'+
								      			'<td>'+res[i].ProductName+'</td> <td>'+res[i].ProductCost+' ';
						      				}
						      				SelectTable	+=	'<tbody> </table>';
						      				$('#SearchModalContent').html(SelectTable);
						      				$('#SearchModal').modal('toggle');

					      				}
					      				else
					      				{
					      					$('#ItemSearch').val('');
									      	$( "#ItemSearch" ).focus();
								      		swal("Not Found!", "not found any maching products", "error");
					      				}
							      				        
							     	 },
								      error: function(xhr, desc, err) {
								        console.log(xhr);
								        console.log("Details: " + desc + "\nError:" + err);
								      }
								    });

							}
						},
					      error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					      }
					    });			

				
			}

			function InsertSearch(ProductID)
			{
				//alert(ProductID);
				$.ajax({
			      url: '<?php echo base_url()."purchase/select_product";?>',
			      type: 'post',
			      data: { ProductID: ProductID },
			      success: function(data) 
			      	{
							var obj = jQuery.parseJSON(data);
	      					IC++;
	      					$('#ItemNo').val(IC);
				      		if(obj.MUStat == 'yes')
							{
								obj.ProductName 	=	obj.ProductName+' X '+obj.MUQuantity;
							}	
							let Price 	=	parseInt(obj.ProductCost);
							Price 		=	Price.toFixed(2);
				      		$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
				      			'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+obj.ProductID+'" >'+	
				      			'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+obj.ProductMUID+'" >'+					      			
								'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+obj.MUStat+'" >'+
								'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+
								'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+					      			
								'<td> '+obj.ProductCode+' </td>'+
								'<td> '+obj.ProductName+' </td>'+
								'<td> '+obj.UnitsName+' </td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="ProductCost'+IC+'" name="ProductCost['+IC+']"  required="required" value="'+obj.ProductCost+'" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="1" required="required" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Price'+IC+'" name="Price['+IC+']" value="'+Price+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
								'</tr>');
				      		$('#SearchModal').modal('hide');
				      		$('#ItemSearch').val('');
				      		$( "#ItemSearch" ).focus();
						    GrandTotal();

			      				        
			     	 },
				      error: function(xhr, desc, err) {
				        console.log(xhr);
				        console.log("Details: " + desc + "\nError:" + err);
				      }
				    });
			}

			function InsertProduct()
			{
				var ProductID 		=	$('#EProductID').val();
				var ProductCode 	=	$('#EProductCode').val();
				var ProductName 	=	$('#EProductName').val();
				var UnitsName 		=	$('#EUnitsName').val();
				var ProductCost 	=	$('#EProductCost').val();
				var Quantity 		=	$('#EQuantity').val();
				var BatchNo 		=	$('#BatchNo').val();
				var ExpiryDate 		=	$('#ExpiryDate').val();
				var ProductMUID 	=	$('#EProductMUID').val();
				var MUStat 			=	$('#EMUStat').val();
				var MUQuantity		=	$('#EMUQuantity').val();
				var Price 			=	ProductCost*Quantity;
				Price 	=	Price.toFixed(2);

				if(BatchNo == '' )
				{
					$( "#BatchNo" ).focus();
					swal("Batch No", "Please enter batch Number", "warning");
				}
				else if(ExpiryDate == '')
				{
					$( "#ExpiryDate" ).focus();
					swal("Expiry Date", "Please enter expiry date", "warning");
				}
				else
				{
					IC++;
					$('#ItemNo').val(IC);
					
					if(MUStat == 'yes')
					{
						//ProductName 	=	ProductName+' X '+MUQuantity;
						var SpBarcode	= 	'[{';
						for(i = 1; i <= MUQuantity ; i++)
						{
							var value =	$('#SpBarcode'+i).val();
							if(i == 1)
							{
								SpBarcode = SpBarcode+'"'+i+'":"'+value+'"';
							}
							else
							{
								SpBarcode = SpBarcode+',"'+i+'":"'+value+'"';
							}
						}
						SpBarcode = SpBarcode+'}]';
						//alert(SpBarcode);

					}					
					ProductName 	=	ProductName+' ('+BatchNo+' - EX : '+ExpiryDate+')';
					$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
						'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+ProductID+'" >'+					      			
						'<input type="hidden" name="BatchNo['+IC+']" id="BatchNo'+IC+'" value="'+BatchNo+'" >'+					      			
						'<input type="hidden" name="ExpiryDate['+IC+']" id="ExpiryDate'+IC+'" value="'+ExpiryDate+'" >'+					      			
						'<input type="hidden" name="UseBatch['+IC+']" id="UseBatch'+IC+'" value="yes" >'+					      			
						'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+ProductMUID+'" >'+					      			
						'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+MUStat+'" >'+					      			
						'<input type="hidden" name="SpBarcode['+IC+']" id="SpBarcode'+IC+'"  >'+					      			
						'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+					      			
						'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+	
						'<td> '+ProductCode+' </td>'+
						'<td> '+ProductName+' </td>'+
						'<td> '+UnitsName+' </td>'+
						'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="ProductCost'+IC+'" name="ProductCost['+IC+']"  required="required" value="'+ProductCost+'" onkeyup="PriceChange('+IC+');" ></td>'+
						'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="'+Quantity+'" required="required" onkeyup="PriceChange('+IC+');"></td>'+
						'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Price'+IC+'" name="Price['+IC+']" value="'+Price+'" required="required" onkeyup="PriceChange('+IC+',2);";></td>'+
						'</tr>');
		      		$('#ProductModal').modal('hide');
		      		$('#ItemSearch').val('');
		      		$( "#ItemSearch" ).focus();
		      		$('#SpBarcode'+IC).val(SpBarcode);
		      		GrandTotal();
				}
			}
			function CancelModal(modal)
			{
				$('#'+modal).modal('hide');
	      		$('#ItemSearch').val('');
	      		$( "#ItemSearch" ).focus();
			}


			function GrandTotal()
			{
				var Sum = 0;

				$('input[name^="Price"]').each(function() {
				    Sum =	Sum+parseFloat($(this).val());
				});
				var Amount 		=	Sum;
				var TaxRate 	=	$('#TaxRate').val();
				var TaxAmount 	=	(Amount*TaxRate)/100;

				//$('#TotalWD').val(TotalWD);
				var Discount 	=	$('#Discount').val();
				var TotalAmount	=	Amount-Discount;
	
				var TotalAmount =	TotalAmount+TaxAmount;

				Amount 	=	Amount.toFixed(2);
				$('#Amount').val(Amount);

				TaxAmount 	=	TaxAmount.toFixed(2);
				$('#TaxAmount').val(TaxAmount);

				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);


                let PaidAmount =    parseFloat($('#PaidAmount').val());
                let BalanceAmount = (TotalAmount-PaidAmount).toFixed(2);
                $('#BalanceAmount').val(BalanceAmount);



			}
			function GrandTotalWhenRemove(RemoveItemAmount)
			{
				//alert(RemoveItemAmount);
				var Amount 		=	$('#Amount').val();
				//alert(Amount);
				Amount 			=	parseFloat(Amount)-parseFloat(RemoveItemAmount);
				var TaxRate 	=	$('#TaxRate').val();
				var TaxAmount 	=	(Amount*TaxRate)/100;

				//$('#TotalWD').val(TotalWD);
				var Discount 	=	$('#Discount').val();
				var TotalAmount	=	Amount-Discount;
	
				var TotalAmount =	TotalAmount+TaxAmount;

				Amount 	=	Amount.toFixed(2);
				$('#Amount').val(Amount);

				TaxAmount 	=	TaxAmount.toFixed(2);
				$('#TaxAmount').val(TaxAmount);

				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);

                let PaidAmount =    parseFloat($('#PaidAmount').val());
                let BalanceAmount = (TotalAmount-PaidAmount).toFixed(2);
                $('#BalanceAmount').val(BalanceAmount);



			}

			//price and quanity change
			function PriceChange(id,Type = 1)
			{
				//if type is one price change on quantity or cost. if type is 2 price changed on Total
				var ProductCost	=	$('#ProductCost'+id).val();
				var Price 		=	$('#Price'+id).val();
				var Quantity 	=	$('#Quantity'+id).val();
				//var Amount 		=	0;
				
				if(Type == 2)
				{
					ProductCost 	=	Price/Quantity;
					ProductCost		=	ProductCost.toFixed(2);
					//alert(ProductCost);
					$('#ProductCost'+id).val(ProductCost);
				}
				else 
				{
					Price 	=	ProductCost*Quantity;
					Price 		=	Price.toFixed(2);
					//alert(Price);
					$('#Price'+id).val(Price);
				}				
				GrandTotal();
			}

			function RemoveItem(id)
			{
				
				swal({   
		            title: "Are you sure?",   
		            text: "You will not be able to recover this file!",   
		            type: "warning",   
		            showCancelButton: true,   
		            confirmButtonColor: "#f8b32d",   
		            confirmButtonText: "Yes, delete it!",   
		            cancelButtonText: "No, cancel !",   
		            closeOnConfirm: true,   
		            closeOnCancel: true 
			        }, function(isConfirm){   
			            if (isConfirm) {
			            	
			            			var Price 		=	$('#Price'+id).val();
						      		GrandTotalWhenRemove(Price);
						      		$('#MU'+id).hide('slow', function(){ $('#MU'+id).remove(); });
						      		swal("Deleted!", "Your file has been deleted.", "success");

			            } 
			        });


							
			}



			

		</script>


	</body>
</html>