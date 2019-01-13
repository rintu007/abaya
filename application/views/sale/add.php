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
						  <h5 class="txt-dark">Sales</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'sale'; ?>"><span>Sales</span></a></li>
						<li class="active">New Sale</span></li>
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
				<form name="form one" method="post" action="<?php echo base_url().'sale/insert';?>" id="PurchaseForm" >

					<div class="row">


						<div class="col-sm-3">

							
							<div class="form-group ">
								<label class="control-label mb-10 text-left">Reference No</label>
								<input type="text" class="form-control" id="ReferenceNo" name="ReferenceNo" placeholder="Enter Reference No" required="required">
							</div>


						</div>

						
						<div class="col-sm-3">

							<div class="form-group">
								<label class="control-label mb-10">Customer</label>
								<select class="form-control select2" name="CustomerID" id="CustomerID" required="required" onchange="CheckOrder();">
									<option value="">Chose a Supplier</option>
									
<?php
					foreach($Customer as $Cust)
					{
?>
									<option value="<?php echo $Cust['CustomerID']; ?>" <?php echo (isset($CustomerID) && $CustomerID == $Cust['CustomerID'])?'selected':''; ?> >
									<?php echo $Cust['CustomerName']; ?> </option>
<?php
					}
?>




								</select>
							</div>


						</div>



						<div class="col-sm-3">	



							<div class="form-group">
								<label class="control-label mb-10 text-left">Date</label>
								<input type="date" name="SaleDate" id="SaleDate" required="required"  class="form-control"
								value="<?php echo isset($SaleDate)?$SaleDate:date('Y-m-d'); ?>" >
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
															<th>Order No</th>
															<th>Item</th>
															<th>Unit</th>
															<th>Amount</th>
															<th>QTY</th>
															<th>Tax</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													
											
														
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

						
						<div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary" >Amount</button>
				                </div>
				                <input type="text" class="form-control" id="Total" name="Total" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;">
				              </div>
				          </div>

				          


				          <div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary">Vat </button>
				                </div>
				                <input type="text" class="form-control" id="TaxAmount" name="TaxAmount" onkeyup="GrandTotal();" style="font-size:13px; font-weight: bold;;text-align:right;">
				              </div>
				          </div>


				        <div class="col-sm-2">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary">Discount</button>
				                </div>
				                <input type="text" class="form-control" id="Discount" name="Discount" onkeyup="GrandTotal();" style="font-size:13px; font-weight: bold;;text-align:right;">
				              </div>
				          </div>

			

				          <div class="col-sm-3">
							<div class="input-group has-primary">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary" >Total</button>
				                </div>
				                <input type="text" class="form-control" id="TotalAmount" name="TotalAmount" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;">
				              </div>
				          </div>

                            <div class="col-sm-3">
                                <div class="input-group has-success">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-success"  >Paid now</button>
                                    </div>
                                    <input type="text" class="form-control" id="PaidAmount" name="PaidAmount"  style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;" onkeyup="GrandTotal();" value="0.00" >
                                </div>
                            </div>










						</div>

                        <div class="row">

                            <div class="col-sm-7">

                            </div>

                            <div class="col-sm-5" id="ShowAdvance">

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
                                    <input type="text" class="form-control" id="BalanceAmount" name="BalanceAmount" readonly style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;">
                                </div>
                            </div>



                        </div>





                        <div class="row">
                            <br>


                            <div class="col-sm-7">

                            </div>


                            <div class="col-sm-2 pull-right">
                                <input type="hidden" name="ItemNo" id="ItemNo" value="1">
                                <button class="btn btn-primary  btn-rounded btn-block btn-anim" type="button" onclick="SubmitForm();"><i class="fa fa-check-square"></i><span class="btn-text">Submit</span></button>

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


						<!-- MOdal view customer orders -->
						<div id="OrModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content " id="">

									<div class="modal-header">
										
										<h5 class="modal-title" >Customer orders</h5>
									</div>
									<div class="modal-body" id="OrModalContent">
										<!--start -->


									</div>

								<div class="modal-footer">
									<button onclick="InsertOrder();" type="button" class="btn btn-success text-left" >Add </button>
									<button onclick="CancelModal('OrModal');" type="button" class="btn btn-danger text-left" >Cancel</button>
	
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
				if($('#ReferenceNo').val() == '')
				{
					$('#ReferenceNo').focus();
					swal("Reference Number", "Please enter the reference number", "warning");
					
				}
				else if($('#CustomerID').val() == '')
				{
					$('#CustomerID').focus();
					swal("Customer", "Please chose a customer", "warning");
					
				}
				else if($('#SaleDate').val() == '')
				{
					$('#SaleDate').focus();
					swal("Date", "Please enter a date", "warning");
					
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

			//customer order check
			function CheckOrder()
			{
				let CustomerID 	=	$('#CustomerID').val();
				$.ajax({
			      url: '<?php echo base_url()."sale/search_order";?>',
			      type: 'post',
			      data: { CustomerID: CustomerID },
			      success: function(data) {
						if(data != 0)
	      				{
	      					var obj = jQuery.parseJSON(data);
	      					//console.log(data);

	      					let SelectTable	='<table class="table table-hover display  pb-30" > <thead><th>Order No</th><th>Item</th><th>Quantity</th><th>Amount</th></thead>';
						      		
				      		  		
				      		for(let i=0; i< obj.length; i++)
				      		{
				      			let CheckBox =	'';
				      			//check the item already in or out
					      		if($('#CheckOrderItem'+obj[i].OrderItemID).val() && $('#CheckOrderItem'+obj[i].OrderItemID).val() == obj[i].OrderItemID)
				      			{
				      				CheckBox = '<input type="checkbox"  disabled checked>';
				      			}
				      			else
				      			{
				      				CheckBox = '<input type="checkbox" name="OrderItemID" id="OrderItemID'+obj[i].OrderItemID+'" value="'+obj[i].OrderItemID+'" >';
				      			}

				      			let Amount 	=	parseFloat(obj[i].Amount);
				      			Amount 	=	Amount.toFixed(2);
				      			//Amount 	=	Amount.toFixed(2);
				      			//console.log(obj.Batchs[i].ProductBatchID);
				      			SelectTable	+='<tr><td ><div class="form-group"><div class="checkbox checkbox-primary">'+CheckBox+
				      			'<label for="OrderItemID'+obj[i].OrderItemID+'">'+obj[i].OrderNo+'</label></div>	</div></td>'+
				      			'<td>'+obj[i].ServiceName+'  ('+obj[i].DesignName+')</td> <td>'+obj[i].Quantity+'<td>'+Amount+' </td>'+				      			
				      			'<input type="hidden" name="EOrderNo'+obj[i].OrderItemID+'" id="EOrderNo'+obj[i].OrderItemID+'" value="'+obj[i].OrderNo+'" >'+
				      			'<input type="hidden" name="EItemName'+obj[i].OrderItemID+'" id="EItemName'+obj[i].OrderItemID+'" value="'+obj[i].ServiceName+'  ('+obj[i].DesignName+')" >'+
				      			'<input type="hidden" name="ERate'+obj[i].OrderItemID+'" id="ERate'+obj[i].OrderItemID+'" value="'+obj[i].Rate+'" >'+
				      			'<input type="hidden" name="EQuantity'+obj[i].OrderItemID+'" id="EQuantity'+obj[i].OrderItemID+'" value="'+obj[i].Quantity+'" >'+
				      			'<input type="hidden" name="EAmount'+obj[i].OrderItemID+'" id="EAmount'+obj[i].OrderItemID+'" value="'+obj[i].Amount+'" >'+
				      			'<input type="hidden" name="ETaxValue'+obj[i].OrderItemID+'" id="ETaxValue'+obj[i].OrderItemID+'" value="'+obj[i].TaxValue+'" >'+
				      			'<input type="hidden" name="ETaxRate'+obj[i].OrderItemID+'" id="ETaxRate'+obj[i].OrderItemID+'" value="'+obj[i].TaxRate+'" ></tr> '+
				      			'<input type="hidden" name="ETaxMethod'+obj[i].OrderItemID+'" id="ETaxMethod'+obj[i].OrderItemID+'" value="'+obj[i].TaxMethod+'" ></tr> ';

				      		}

				      		SelectTable	+=	'<tbody> </table>';
				      		
			      			$('#OrModalContent').html(SelectTable);

	      
		      				$('#OrModal').modal('toggle');


	      				}
	      				else
	      				{
	      					$('#ItemSearch').val('');
					      	$( "#ItemSearch" ).focus();
				      		//swal("Not Found!", "not found any maching products", "error");
	      				}
			      				        
			     	 },
				      error: function(xhr, desc, err) {
				        console.log(xhr);
				        console.log("Details: " + desc + "\nError:" + err);
				      }
				    });

                ShowAdvance();



			}

			function InsertOrder()
			{


				if(!$("input[name=OrderItemID]:checked").is(':checked'))
				{
					swal("Order ", "Please select an order", "warning");
				}
				else
				{
					$("input[name=OrderItemID]:checked").each(function()
					{
						IC++;
	      				$('#ItemNo').val(IC);
						let OrderItemID =	$(this).val();
						//check this order item already inserted

						let OrderNo 	=	$('#EOrderNo'+OrderItemID).val();
						let ItemName 	=	$('#EItemName'+OrderItemID).val();
						let Rate 		=	$('#ERate'+OrderItemID).val();
						let Quantity 	=	$('#EQuantity'+OrderItemID).val();
						let Amount 		=	$('#EAmount'+OrderItemID).val();
						let TaxValue 	=	$('#ETaxValue'+OrderItemID).val();
						let TaxRate 	=	$('#ETaxRate'+OrderItemID).val();
						let TaxMethod 	=	$('#ETaxMethod'+OrderItemID).val();
						Rate 		=	parseFloat(Rate).toFixed(2);
						TaxValue 	=	parseFloat(TaxValue).toFixed(2);
						Amount 		=	parseFloat(Amount).toFixed(2);

						$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
				      			'<input type="hidden" name="ItemType['+IC+']" id="ItemType'+IC+'" value="order" >'+	
				      			'<input type="hidden" name="OrderItemID['+IC+']" id="OrderItemID'+IC+'" value="'+OrderItemID+'" >'+	
				      			'<input type="hidden" name="CheckOrderItem['+OrderItemID+']" id="CheckOrderItem'+OrderItemID+'" value="'+OrderItemID+'" >'+	
				      			'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+
								'<input type="hidden" name="TaxRate['+IC+']" id="TaxRate'+IC+'" value="'+TaxRate+'" >'+					      			
								'<input type="hidden" name="TaxMethod['+IC+']" id="TaxMethod'+IC+'" value="'+TaxMethod+'" >'+
								'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+					      			
								'<td> '+OrderNo+' </td>'+
								'<td> '+ItemName+' </td>'+
								'<td> ODR </td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Rate'+IC+'" name="Rate['+IC+']"  required="required" value="'+Rate+'" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="'+Quantity+'" required="required" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 10%;"><input style="text-align: right;background-color: #fff;" type="text" class="form-control" id="TaxValue'+IC+'" name="TaxValue['+IC+']" value="'+TaxValue+'" readonly ></td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Amount'+IC+'" name="Amount['+IC+']" value="'+Amount+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
								'</tr>');

			      		$('#OrModal').modal('hide');
			      		$('#ItemSearch').val('');
			      		$( "#ItemSearch" ).focus();
					    GrandTotal();

					});
				}
			}
			function SelectProduct()
			{
				var ItemSearch 	=	$('#ItemSearch').val();
				//alert(ItemSearch);
				$.ajax({
					      url: '<?php echo base_url()."sale/search_product";?>',
					      type: 'post',
					      data: { ItemSearch: ItemSearch },
					      success: function(data) {
					      	if(data != 0)
					      	{
					      		var obj = jQuery.parseJSON(data);
						      	//console.log(data);
						      	if(obj.UseBatch == 'yes')
						      	{
						      		let SelectTable	='<table class="table table-hover display  pb-30" > <thead><th>BatchNo</th><th>Expiry Date</th><th>Quantity</th></thead>';
						      		
						      		for(let i=0; i< obj.Batchs.length; i++)
						      		{
						      			//console.log(obj.Batchs[i].ProductBatchID);
						      			SelectTable	+='<tr><td ><div class="form-group"><div class="radio radio-success"><input type="radio" name="ProductBatchID" id="ProductBatchID'+obj.Batchs[i].ProductBatchID+'" value="'+obj.Batchs[i].ProductBatchID+'" >'+
						      			'<label for="ProductBatchID'+obj.Batchs[i].ProductBatchID+'">'+obj.Batchs[i].BatchNo+'</label></div>	</div></td>'+
						      			'<td>'+obj.Batchs[i].ExpiryDate+'</td> <td>'+obj.Batchs[i].Quantity+' '+
						      			'<input type="hidden" name="EBatchNo'+obj.Batchs[i].ProductBatchID+'" id="EBatchNo'+obj.Batchs[i].ProductBatchID+'" value="'+obj.Batchs[i].BatchNo+'" >'+
						      			'<input type="hidden" name="EExpiryDate'+obj.Batchs[i].ProductBatchID+'" id="EExpiryDate'+obj.Batchs[i].ProductBatchID+'" value="'+obj.Batchs[i].ExpiryDate+'" ></td></tr> ';
						      		}

						      		SelectTable	+=	'<tbody> </table>';
						      		
					      			$('#ProductModalContent').html('<input type="hidden" name="EProductID" id="EProductID" value="'+obj.ProductID+'" >'+
					      				'<input type="hidden" name="EProductCode" id="EProductCode" value="'+obj.ProductCode+'" >'+
					      				'<input type="hidden" name="EProductName" id="EProductName" value="'+obj.ProductName+'" >'+
					      				'<input type="hidden" name="EUnitsName" id="EUnitsName" value="'+obj.UnitsName+'" >'+
					      				'<input type="hidden" name="EProductCost" id="EProductCost" value="'+obj.ProductCost+'" >'+
					      				'<input type="hidden" name="EProductMUID" id="EProductMUID" value="'+obj.ProductMUID+'" >'+
					      				'<input type="hidden" name="EMUStat" id="EMUStat" value="'+obj.MUStat+'" >'+
					      				'<input type="hidden" name="EMUQuantity" id="EMUQuantity" value="'+obj.MUQuantity+'" >'+
					      				'<input type="hidden" name="ETaxRate" id="ETaxRate" value="'+obj.TaxRate+'" >'+
					      				'<input type="hidden" name="ETaxMethod" id="ETaxMethod" value="'+obj.TaxMethod+'" >'+
										'<table class="table table-hover display  pb-30" > <thead><th>Barcode</th><th>Name</th><th>Unit</th><th>cost</th></thead>'+
										'<tbody><tr><td>'+obj.ProductCode+'</td><td>'+obj.ProductName+'</td><td>'+obj.UnitsName+'</td> <td> '+obj.ProductCost+'</td>	</tr> <tbody> </table>'+	
										' <div class="col-sm-12><div class="form-group"><label class="control-label mb-10 text-left">Quantity</label>'+
										'<input type="number" name="EQuantity" id="EQuantity"  class="form-control" value="1" >	</div> </div>'+									
										SelectTable);
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

									let Amount 	=	parseFloat(obj.ProductCost);
									if(obj.TaxMethod == 'exclusive')
									{
										var TaxValue=	(parseFloat(Amount)*parseFloat(obj.TaxRate))/100;
										Amount 		=	Amount+TaxValue;
									}
									else
									{
										let WithoutTax 	=	Amount/((obj.TaxRate/100)+1);
										var TaxValue	=	Amount-WithoutTax;
									}							
									TaxValue 	=	TaxValue.toFixed(2);
									Amount 		=	Amount.toFixed(2);
						      		$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
						      			'<input type="hidden" name="ItemType['+IC+']" id="ItemType'+IC+'" value="product" >'+	
						      			'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+obj.ProductID+'" >'+	
						      			'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+obj.ProductMUID+'" >'+					      			
										'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+obj.MUStat+'" >'+	
										'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+
										'<input type="hidden" name="TaxRate['+IC+']" id="TaxRate'+IC+'" value="'+obj.TaxRate+'" >'+					      			
										'<input type="hidden" name="TaxMethod['+IC+']" id="TaxMethod'+IC+'" value="'+obj.TaxMethod+'" >'+
										'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+			      			
										'<td> '+obj.ProductCode+' </td>'+
										'<td> '+obj.ProductName+' </td>'+
										'<td> '+obj.UnitsName+' </td>'+
										'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Rate'+IC+'" name="Rate['+IC+']"  required="required" value="'+obj.ProductCost+'" onkeyup="PriceChange('+IC+');"></td>'+
										'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="1" required="required" onkeyup="PriceChange('+IC+');"></td>'+
										'<td style="width: 10%;"><input style="text-align: right;background-color: #fff;" type="text" class="form-control" id="TaxValue'+IC+'" name="TaxValue['+IC+']" value="'+TaxValue+'" readonly ></td>'+
										'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Amount'+IC+'" name="Amount['+IC+']" value="'+Amount+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
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
							      url: '<?php echo base_url()."sale/search_product_det";?>',
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
			      url: '<?php echo base_url()."sale/select_product";?>',
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
							let Amount 	=	parseFloat(obj.ProductCost);
							if(obj.TaxMethod == 'exclusive')
							{
								var TaxValue=	(parseFloat(Amount)*parseFloat(obj.TaxRate))/100;
								Amount 		=	Amount+TaxValue;
							}
							else
							{
								let WithoutTax 	=	Amount/((obj.TaxRate/100)+1);
								var TaxValue 	=	Amount-WithoutTax;
							}	
							TaxValue 		=	TaxValue.toFixed(2);
							Amount 		=	Amount.toFixed(2);
				      		$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
				      			'<input type="hidden" name="ItemType['+IC+']" id="ItemType'+IC+'" value="product" >'+	
				      			'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+obj.ProductID+'" >'+	
				      			'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+obj.ProductMUID+'" >'+					      			
								'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+obj.MUStat+'" >'+
								'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+
								'<input type="hidden" name="TaxRate['+IC+']" id="TaxRate'+IC+'" value="'+obj.TaxRate+'" >'+					      			
								'<input type="hidden" name="TaxMethod['+IC+']" id="TaxMethod'+IC+'" value="'+obj.TaxMethod+'" >'+
								'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+					      			
								'<td> '+obj.ProductCode+' </td>'+
								'<td> '+obj.ProductName+' </td>'+
								'<td> '+obj.UnitsName+' </td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Rate'+IC+'" name="Rate['+IC+']"  required="required" value="'+obj.ProductCost+'" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="1" required="required" onkeyup="PriceChange('+IC+');"></td>'+
								'<td style="width: 10%;"><input style="text-align: right;background-color: #fff;" type="text" class="form-control" id="TaxValue'+IC+'" name="TaxValue['+IC+']" value="'+TaxValue+'" readonly ></td>'+
								'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Amount'+IC+'" name="Amount['+IC+']" value="'+Amount+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
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
				var ProductMUID 	=	$('#EProductMUID').val();
				var MUStat 			=	$('#EMUStat').val();
				var MUQuantity		=	$('#EMUQuantity').val();
				var TaxRate			=	$('#ETaxRate').val();
				var TaxMethod		=	$('#ETaxMethod').val();
				var Amount 			=	parseFloat(ProductCost)*parseFloat(Quantity);

				if(TaxMethod == 'exclusive')
				{
					var TaxValue 	=	(parseFloat(Amount)*parseFloat(TaxRate))/100;
					Amount 		=	Amount+TaxValue;
				}
				else
				{
					let WithoutTax 	=	Amount/((TaxRate/100)+1);
					var TaxValue 		=	Amount-WithoutTax;
				}	
				TaxValue 		=	TaxValue.toFixed(2);
				Amount 		=	Amount.toFixed(2);
				
				
				if(!$("input[name=ProductBatchID]:checked").is(':checked'))
				{
					swal("Batch ", "Please Chose a batch", "warning");
				}

				else
				{
					IC++;
					$('#ItemNo').val(IC);
					let ProductBatchID	=	$("input[name=ProductBatchID]:checked").val();
					let BatchNo 		=	$('#EBatchNo'+ProductBatchID).val();
					let ExpiryDate 		=	$('#EExpiryDate'+ProductBatchID).val();		
					ProductName 	=	ProductName+' ('+BatchNo+' - EX : '+ExpiryDate+')';
					$('#ProductTable tr:last').after('<tr id="MU'+IC+'">'+
						'<input type="hidden" name="ItemType['+IC+']" id="ItemType'+IC+'" value="product" >'+	
						'<input type="hidden" name="ProductID['+IC+']" id="ProductID'+IC+'" value="'+ProductID+'" >'+					      			
						'<input type="hidden" name="BatchNo['+IC+']" id="BatchNo'+IC+'" value="'+BatchNo+'" >'+					      			
						'<input type="hidden" name="ExpiryDate['+IC+']" id="ExpiryDate'+IC+'" value="'+ExpiryDate+'" >'+					      			
						'<input type="hidden" name="ProductMUID['+IC+']" id="ProductMUID'+IC+'" value="'+ProductMUID+'" >'+					      			
						'<input type="hidden" name="MUStat['+IC+']" id="MUStat'+IC+'" value="'+MUStat+'" >'+
						'<input type="hidden" name="ItemSl['+IC+']" id="ItemSl'+IC+'" value="'+IC+'"  >'+					      			
						'<input type="hidden" name="TaxRate['+IC+']" id="TaxRate'+IC+'" value="'+TaxRate+'" >'+					      			
						'<input type="hidden" name="TaxMethod['+IC+']" id="TaxMethod'+IC+'" value="'+TaxMethod+'" >'+					      			
						'<input type="hidden" name="ProductBatchID['+IC+']" id="ProductBatchID'+IC+'" value="'+ProductBatchID+'" >'+					      			
						'<td style="width: 2%;"><a href="#" onclick="RemoveItem('+IC+');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>'+

						'<td> '+ProductCode+' </td>'+
						'<td> '+ProductName+' </td>'+
						'<td> '+UnitsName+' </td>'+
						'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Rate'+IC+'" name="Rate['+IC+']"  required="required" value="'+ProductCost+'" onkeyup="PriceChange('+IC+');"></td>'+
						'<td style="width: 8%;"><input style="text-align: right;" type="text" class="form-control" id="Quantity'+IC+'" name="Quantity['+IC+']" value="'+Quantity+'" required="required" onkeyup="PriceChange('+IC+');"></td>'+
						'<td style="width: 10%;"><input style="text-align: right;background-color: #fff;" type="text" class="form-control" id="TaxValue'+IC+'" name="TaxValue['+IC+']" value="'+TaxValue+'" readonly ></td>'+
						'<td style="width: 10%;"><input style="text-align: right;" type="text" class="form-control" id="Amount'+IC+'" name="Amount['+IC+']" value="'+Amount+'" required="required" onkeyup="PriceChange('+IC+',2);"></td>'+
						'</tr>');
		      		$('#ProductModal').modal('hide');
		      		$('#ItemSearch').val('');
		      		$( "#ItemSearch" ).focus();
		      		//$('#SpBarcode'+IC).val(SpBarcode);
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
                let Total = 0;
                let TaxAmount =0;

				$('input[name^="Amount"]').each(function() {
				    Total =	Total+parseFloat($(this).val());
				});
				//alert(Total);
				
				$('input[name^="TaxValue"]').each(function() {
				    TaxAmount =	TaxAmount+parseFloat($(this).val());
				});


				//$('#TotalWD').val(TotalWD);
                let Discount 	=	$('#Discount').val();
                let TotalAmount	=	Total-Discount;

				Total 	=	Total-TaxAmount;
				Total 	=	Total.toFixed(2);
				$('#Total').val(Total);

				TaxAmount 	=	TaxAmount.toFixed(2);
				$('#TaxAmount').val(TaxAmount);

				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);

                let PaidAmount =    parseFloat($('#PaidAmount').val());
                let TotalAdvancePaid =($('#TotalAdvancePaid').val())?parseFloat($('#TotalAdvancePaid').val()):0;
				let BalanceAmount = (TotalAmount-(PaidAmount+TotalAdvancePaid)).toFixed(2);
                $('#BalanceAmount').val(BalanceAmount);



			}
			function GrandTotalWhenRemove(RemoveItemAmount,RemoveTax)
			{
				//alert(RemoveItemAmount);
				var TotalAmount	=	$('#TotalAmount').val();
				var TaxAmount	=	$('#TaxAmount').val();
				//alert(Amount);
				TotalAmount		=	parseFloat(TotalAmount)-parseFloat(RemoveItemAmount);
				TaxAmount 		=	parseFloat(TaxAmount)-parseFloat(RemoveTax);


				Total 	=	TotalAmount-TaxAmount;
				Total 	=	Total.toFixed(2);
				$('#Total').val(Total);

				TaxAmount 	=	TaxAmount.toFixed(2);
				$('#TaxAmount').val(TaxAmount);

				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);

                let PaidAmount =    parseFloat($('#PaidAmount').val());
                let TotalAdvancePaid =($('#TotalAdvancePaid').val())?parseFloat($('#TotalAdvancePaid').val()):0;
                let BalanceAmount = (TotalAmount-(PaidAmount+TotalAdvancePaid)).toFixed(2);
                $('#BalanceAmount').val(BalanceAmount);



			}

			//price and quanity change
			function PriceChange(id,Type = 1)
			{
				//if type is one price change on quantity or cost. if type is 2 price changed on Total
				var Rate		=	$('#Rate'+id).val();
				var Amount 		=	$('#Amount'+id).val();
				var Quantity 	=	$('#Quantity'+id).val();
				var Tax 	 	=	$('#Tax'+id).val();
				var TaxRate	 	=	$('#TaxRate'+id).val();
				var TaxMethod 	=	$('#TaxMethod'+id).val();
				//var Amount 		=	0;
				
				if(Type == 2)
				{

					if(TaxMethod == 'exclusive')
					{
						let WithoutTax 	=	Amount/((TaxRate/100)+1);
						TaxValue 	=	Amount-WithoutTax;
						Rate 	=	(Amount-TaxValue)/Quantity;
					}
					else
					{
						let WithoutTax 	=	Amount/((TaxRate/100)+1);
						TaxValue 		=	Amount-WithoutTax;
						ProductCost 	=	Amount/Quantity;

					}
					TaxValue 		=	TaxValue.toFixed(2);
					Rate			=	Rate.toFixed(2);
					$('#Rate'+id).val(Rate);
					$('#TaxValue'+id).val(TaxValue);
				}
				else 
				{
					if(TaxMethod == 'exclusive')
					{
						Amount 		=	Rate*Quantity;
						TaxValue 	=	(Amount*TaxRate)/100;
						Amount 		=	Amount+TaxValue;
						
					}
					else
					{	
						Amount 			=	Rate*Quantity;
						let WithoutTax 	=	Amount/((TaxRate/100)+1);
						TaxValue 		=	Amount-WithoutTax;
					}
					TaxValue 	=	TaxValue.toFixed(2);
					Amount 		=	Amount.toFixed(2);
					$('#Amount'+id).val(Amount);
					$('#TaxValue'+id).val(TaxValue);
				}				
				GrandTotal();
			}

			function AdvanceChange(pid,amount){
			    let TotalAdvancePaid = parseFloat($('#TotalAdvancePaid').val());
			    if(pid.checked){
                    TotalAdvancePaid = TotalAdvancePaid+amount;
                }
                else{
                    TotalAdvancePaid = TotalAdvancePaid-amount;
                }
                $('#TotalAdvancePaid').val(TotalAdvancePaid.toFixed(2));
                GrandTotal();
            }

            function ShowAdvance(){
			    let CustomerID = $('#CustomerID').val();

                $.ajax({
                    url: '<?php echo base_url()."sale/view_advance";?>',
                    type: 'post',
                    data: { CustomerID: CustomerID },
                    success: function(data)
                    {
                        $('#ShowAdvance').html(data);
                    },
                    error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                    }
                });
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
			            	
			            			var Amount 		=	$('#Amount'+id).val();
			            			var TaxValue	=	$('#TaxValue'+id).val();
						      		GrandTotalWhenRemove(Amount,TaxValue);
						      		$('#MU'+id).hide('slow', function(){ $('#MU'+id).remove(); });
						      		swal("Deleted!", "Your file has been deleted.", "success");

			            } 
			        });


							
			}

            function ShowOrderForm(OrderFormID)
            {
                //$('#OFModalContent').html('Order Form ID is '+OrderFormID);

                $.ajax({
                    url: '<?php echo base_url()."order/view_order_ajax";?>',
                    type: 'post',
                    data: { OrderFormID: OrderFormID},
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



			

		</script>


	</body>
</html>