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
						  <h5 class="txt-dark">Eidt Order</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'order'; ?>"><span>Order</span></a></li>
						<li class="active">Edit order</span></li>
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
				<form name="form one" method="post" action="<?php echo base_url().'order/update';?>" onsubmit="return CheckSubmit();" >

					<div class="row">




						<div class="col-sm-2">

							
							<div class="form-group ">
								<label class="control-label mb-10 text-left">Reference No</label>
								<input type="text" class="form-control" id="ReferenceNo" name="ReferenceNo" placeholder="Enter Reference No" required="required" onkeyup="FirstItemName();" value="<?php echo $ReferenceNo; ?>">
							</div>


						</div>


						<div class="col-sm-3">

							<div class="form-group">
								<label class="control-label mb-10">Customer</label>
								<select class="form-control select2" name="CustomerID" id="CustomerID" required="required" onchange="FirstItemName();" >
									<option value="">Chose a Customer</option>
									
<?php
					foreach($Customers as $Cust)
					{
?>
									<option value="<?php echo $Cust['CustomerID']; ?>" <?php echo (isset($CustomerID) && $CustomerID == $Cust['CustomerID'])?'selected':''; ?> >
									<?php echo $Cust['CustomerName']; ?> - <?php echo $Cust['CustomerPhone']; ?></option>

									
<?php
					}
?>


						

								</select>
								<input type="hidden" Name="CustomerName" id="CustomerName" value="">
							</div>


						</div>



						<div class="col-sm-2">	



							<div class="form-group">
								<label class="control-label mb-10 text-left">Date</label>
								<input type="date" name="OrderDate" id="OrderDate" required="required"  class="form-control"
								value="<?php echo isset($OrderDate)?$OrderDate:date('Y-m-d'); ?>" >
							</div>

						</div>

						<div class="col-sm-2">

							

							<div class="form-group">
								<label class="control-label mb-10 text-left">Delivery Date</label>
								<input type="date" name="DeliveryDate" id="DeliveryDate"   class="form-control"
								value="<?php echo isset($DeliveryDate)?$DeliveryDate:''; ?>" >
							</div>


						</div>

						<div class="col-sm-2">

							<div class="form-group ">
								<label class="control-label mb-10 text-left">Type</label>
								<select class="selectpicker" data-style="btn-primary btn-outline" Name="Type">
									<option <?php echo (isset($Type) && $Type == 'Normal')?'selected':''; ?> data-tokens="ketchup mustard">Normal</option>
									<option <?php echo (isset($Type) && $Type == 'Urgent')?'selected':''; ?> data-tokens="mustard">Urgent</option>
									<option <?php echo (isset($Type) && $Type == 'Very Urgent')?'selected':''; ?> data-tokens="frosting">Very Urgent</option>
								</select>
							</div>
						</div>

						

						<div class="col-sm-1 ">
							<label class="control-label mb-10 text-left" style="color: #fff;">Add Item </label>
							<button type="button" class="btn btn-primary btn-anim" onclick="AddItem();"><i class="icon-plus"></i><span class="btn-text" >Item</span></button>
						</div>


					</div>
					
					<div class="row" id="AllItem">

						<!--Item Start                          START -->

<?php
	
			foreach($Items as $Item)
			{
					$ImageFile	=	$Item['ImagePath'].'/'.$Item['ImageName'];
					if(file_exists($ImageFile) && $Item['ImageName'] != "")
					{						
						$ImageSrc 	=	base_url().$ImageFile;
					}
					else
					{
						$ImageSrc 	=	base_url().'img/noimage.png';
					}
?>


							<div class="col-md-12" id="Item<?php echo $Item['ItemSl']; ?>">
							<div class="panel panel-default card-view" style="background-color: #f9f9f9">
								<div class="panel-heading">
									
									<div class="col-sm-1">
							
										<div class="form-group ">
											<input type="text" class="form-control" id="OrderNo1" name="OrderNo[]" placeholder="Order No" required="required" style="background-color: #f7f7f9;" onkeyup="BookNoChange(1);"
												value="<?php echo $Item['OrderNo']; ?>">
										</div>

									</div>

									<div class="pull-left col-sm-1">

				
										<div class="form-group ">
											<input type="text" class="form-control" id="BookNo1" name="BookNo[]" placeholder="Book No" style="background-color: #f7f7f9;" value="<?php echo $Item['BookNo']; ?>">
										</div>


									</div>


									<div class="pull-left col-sm-3">
										
										<div class="form-group ">
											<input type="text" class="form-control" id="ItemName<?php echo $Item['ItemSl']; ?>" name="ItemName[]" placeholder="Enter Name" required="required" value="<?php echo $Item['ItemName']; ?>" 
											style="background-color: #f7f7f9;">
											<input type="hidden" name="ItemSl[]" value="<?php echo $Item['ItemSl']; ?>">
											<input type="hidden" name="ItemMode[]" id="ItemMode<?php echo $Item['ItemSl']; ?>" value="update">
											<input type="hidden" name="OrderItemID[]" id="OrderItemID<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['OrderItemID']; ?>">
										</div>

									</div>
									<div class="pull-right">
										<a href="#" onclick="RemoveItem(<?php echo $Item['ItemSl']; ?>,<?php echo $Item['OrderItemID']; ?>);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in" >
									<div class="panel-body" >
										
										<div class="form-wrap " >
		
												<div class="row">

													<div class="col-sm-1" id="Photo<?php echo $Item['ItemSl']; ?>">

															<img src="<?php echo $ImageSrc;?>" width="100px" height="115px">

													</div>

													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Service</label>
															<select class="form-control select2" data-style="btn-primary btn-outline" name="ServiceID[]" id="ServiceID<?php echo $Item['ItemSl']; ?>" 
																required="required" onchange="ServiceOnChange(<?php echo $Item['ItemSl']; ?>);">
																<option value="">Chose Service</option>
<?php
					foreach($Services as $Serv)
					{
?>
									<option value="<?php echo $Serv['ServiceID']; ?>" <?php echo (isset($Item['ServiceID']) && $Item['ServiceID'] == $Serv['ServiceID'])?'selected':''; ?> >
									<?php echo $Serv['ServiceName']; ?></option>
<?php
					}
?>

															</select>
															<input type="hidden" name="ImageID[]" id="ImageID<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['ImageID']; ?>" >
															<input type="hidden" name="TaxRate[]" id="TaxRate<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['TaxRate']; ?>" >
															<input type="hidden" name="TaxMethod[]" id="TaxMethod<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['TaxMethod']; ?>" >
														</div>
													</div>

													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Design</label>
															<select class="form-control select<?php echo $Item['ItemSl']; ?>" data-style="btn-primary btn-outline" name="DesignID[]" id="DesignID<?php echo $Item['ItemSl']; ?>" 
																onchange="DesignOnChange(<?php echo $Item['ItemSl']; ?>);">
																<option value="">Chose Design</option>
<?php
					foreach($Item['Designs'] as $Des)
					{
?>
									<option value="<?php echo $Des['DesignID']; ?>" <?php echo (isset($Item['DesignID']) && $Item['DesignID'] == $Des['DesignID'])?'selected':''; ?> >
									<?php echo $Des['DesignName']; ?></option>
<?php
					}
?>

															</select>

														</div>
													</div>

													<div class="col-sm-1" >
														<div class="form-group" id="WFService1">
<?php 				if(isset($Item['WFQuantity']) && $Item['WFQuantity'] > 0)
					{
?>
														<label class="control-label mb-10 text-left"><?php echo $Item['WFServiceName']; ?></label>
														<input type="text" class="form-control" name="WFQuantity[]"  placeholder="Quantity" value="<?php echo $Item['WFQuantity']; ?>" required>
<?php
					}															
?>
														</div>
													</div>


													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Rate</label>
															<input type="text" class="form-control" name="Rate[]" id="Rate<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['Rate']; ?>"
															placeholder="Enter Rate" style="text-align:right;" onkeyup="PriceChange(<?php echo $Item['ItemSl']; ?>);">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Quantity</label>
															<input type="text" class="form-control" name="Quantity[]" id="Quantity<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['Quantity']; ?>"
															placeholder="Quantity" value="1" onkeyup="PriceChange(<?php echo $Item['ItemSl']; ?>);">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left" id="TaxLabel<?php echo $Item['ItemSl']; ?>">Tax</label>
															<input type="text" class="form-control" name="TaxValue[]" id="TaxValue<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['TaxValue']; ?>"
															placeholder="Tax" readonly style="text-align:right;background-color: #fff;">
														</div>
													</div>

													<div class="col-sm-2">
														<div class="form-group has-success">
															<label class="control-label mb-10 text-left">Amount</label>
															<input type="text" class="form-control" name="Amount[]" id="Amount<?php echo $Item['ItemSl']; ?>" placeholder="Enter Amount" value="<?php echo $Item['Amount']; ?>"
															style="text-align:right;background-color: #fff;" onkeyup="TotalPriceChange(<?php echo $Item['ItemSl']; ?>);" >
														</div>
													</div>


											

													<div class="col-sm-1">
														<div class="form-group">
						
															<input type="number" class="form-control" name="LEN[]" id="LEN<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['LEN']; ?>"
															placeholder="LEN" title="LEN Size" >
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
													
															<input type="number" class="form-control" name="CHE[]" id="CHE<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['CHE']; ?>"
															placeholder="CHE" title="CHE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="number" class="form-control" name="WE[]" id="WE<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['WE']; ?>"
															placeholder="WE" title="WE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="number" class="form-control" name="HIP[]" id="HIP<?php echo $Item['ItemSl']; ?>" value="<?php echo $Item['HIP']; ?>"
															placeholder="HIP" title="HIP Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="number" class="form-control" name="SLEE[]" id="SLEE<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['SLEE']; ?>"
															placeholder="SLEE" title="SLEE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
											
															<input type="number" class="form-control" name="RIGA[]" id="RIGA<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['RIGA']; ?>"
															placeholder="RIGA" title="RIGA Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
			
															<input type="number" class="form-control" name="FAR[]" id="FAR<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['FAR']; ?>"
															placeholder="FAR" title="FAR Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="number" class="form-control" name="BOX[]" id="BOX<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['BOX']; ?>"
															placeholder="BOX" title="BOX Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
									
															<input type="number" class="form-control" name="NOR[]" id="NOR<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['NOR']; ?>"
															placeholder="NOR" title="NOR Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
											
															<input type="number" class="form-control" name="BOT[]" id="BOT<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['BOT']; ?>"
															placeholder="BOT" title="BOT Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
										
															<input type="number" class="form-control" name="NECK[]" id="NECK<?php echo $Item['ItemSl']; ?>"  value="<?php echo $Item['NECK']; ?>"
															placeholder="NECK" title="NECK Size">
														</div>
													</div>

												</div>

										</div>

									</div>
								</div>



								</div>
							</div>

				
<?php
			}


?>						


						<!--Item End --                                         END -->


						</div>


						<div class="row">

						<br>
<!--						<div class="col-sm-2">-->
<!--							<div class="input-group has-error">-->
<!--				                <div class="input-group-btn">-->
<!--				                  <button type="button" class="btn btn-danger">Discount</button>-->
<!--				                </div>-->
<!--				                <input type="text" class="form-control" id="Discount" name="Discount" value="--><?php //echo $Discount; ?><!--" -->
<!--				                onkeyup="GrandTotal();" style="font-size:13px; font-weight: bold;;text-align:right;">-->
<!--				              </div>-->
<!--				          </div>-->

				          <div class="col-sm-2">
							<div class="input-group has-default">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-primary">Tax</button>
				                </div>
				                <input type="text" class="form-control" id="TotalTax" name="TotalTax" readonly value="<?php echo $TotalTax; ?>" 
				                style="font-size:13px; font-weight: bold;text-align:right;background-color: #fff;">
				              </div>
				          </div>

				          <div class="col-sm-2">
							<div class="input-group has-success">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-success" >Total</button>
				                </div>
				                <input type="text" class="form-control" id="TotalAmount" name="TotalAmount" value="<?php echo $TotalAmount; ?>" readonly 
				                style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;">
				              </div>
				          </div>

				          <div class="col-sm-3">
							<div class="input-group has-warning">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-warning " title="Click here to get Taotal Amount as advance "  onclick="TotalAsAdvance();">Advance</button>
				                </div>
				                <input type="text" class="form-control" id="AdvanceAmount" name="AdvanceAmount"  value="<?php echo $AdvanceAmount; ?>" onclick="TotalAsAdvance();"
				                style="font-size:13px; font-weight: bold;text-align:right;background-color: #fff;" readonly>
				              </div>
				          </div>

				          <div class="col-sm-3">
							<div class="input-group has-default">
				                <div class="input-group-btn">
				                  <button type="button" class="btn btn-default ">Balance</button>
				                </div>
				                <input type="text" class="form-control" id="BalanceAmount" name="BalanceAmount" readonly value="<?php echo $TotalAmount-$AdvanceAmount; ?>"
				                style="font-size:13px; font-weight: bold;text-align:right;background-color: #fff;">
				              </div>
				          </div>

				          <div class="col-sm-2">


                                    <input type="hidden" class="form-control" id="Discount" name="Discount" value="0" >
									<input type="hidden" name="ItemNo" id="ItemNo" value="<?php echo $ItemNo; ?>">
									<input type="hidden" name="ItemCount" id="ItemCount" value="<?php echo $ItemCount; ?>">
									<input type="hidden" name="TotalWD" id="TotalWD" value="<?php echo $TotalWD; ?>" >
									<input type="hidden" name="OrderFormID" id="OrderFormID" value="<?php echo $OrderFormID; ?>" >
									<input type="hidden" name="OldCustomerID" id="OldCustomerID" value="<?php echo $CustomerID; ?>" >
									<input type="hidden" name="DeleteOrderItemJson" id="DeleteOrderItemJson" value="no" >
									<button class="btn btn-primary  btn-rounded btn-block btn-anim"><i class="fa fa-check-square"></i><span class="btn-text">Update Order</span></button>
						
							</div>


						</div>


																								
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					
				</div>
				
					<!-- MOdal for Order View -->
					<div id="OFModal" class="modal fade   " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog ">
							<div class="modal-content " id="OFModalContent">
								
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->



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
		

		<!-- Select2 JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

		<!-- Form Flie Upload Data JavaScript -->
		<script src="<?php echo base_url();?>dist/js/form-file-upload-data.js"></script>

		<!-- Sweet-Alert  -->
		<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

		<!-- Bootstrap Select JavaScript -->
		<script src="<?php echo base_url();?>vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>


		
		<!-- Form Advance Init JavaScript -->
		<script src="<?php echo base_url();?>dist/js/form-advance-data.js"></script>






		<script type="text/javascript">

			var DelItemJson = new Object();
			var count=0;

			//gettting total amount as advance
			function TotalAsAdvance()
			{
				var OrderFormID 	=	$('#OrderFormID').val();

				$.ajax({
			      url: '<?php echo base_url()."order/view_advance";?>',
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
			//submit check total morethan advance and discount morethan total
			function CheckSubmit()
			{
				var Discount		=	parseFloat($('#Discount').val());
				var TotalWD 		=	parseFloat($('#TotalWD').val());
				var TotalAmount 	=	parseFloat($('#TotalAmount').val());
				var AdvanceAmount 	=	parseFloat($('#AdvanceAmount').val());
				if(Discount > TotalWD)
				{
					swal("More Discount!", "Discount is morethan Total amount", "error");
					return(false);
				}
				else if(AdvanceAmount > TotalAmount)
				{
					swal("More Advance!", "Advance payment is morethan Total Amount", "error");
					return(false);
				}
				else
				{
					return(true);
				}
			}

			//calculating total amount of bill
			function GrandTotal()
			{
				//var ItemCount 	=	$('#ItemCount').val();
				var Sum = 0;

				$('input[name^="Amount"]').each(function() {
				    Sum =	Sum+parseFloat($(this).val());
				});
				var TotalWD 	=	Sum;
				$('#TotalWD').val(TotalWD);
				var Discount 	=	$('#Discount').val();
				var TotalAmount =	TotalWD-Discount;
				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);


				//for tax
				var TaxSum = 0;
				$('input[name^="TaxValue"]').each(function() {
				    TaxSum =	TaxSum+parseFloat($(this).val());
				});
				TotalTax 	=	TaxSum.toFixed(2);
				$('#TotalTax').val(TotalTax);

				//for advance and balance
				var AdvanceAmount 	=	$('#AdvanceAmount').val();
				var BalanceAmount 	=	TotalAmount - AdvanceAmount;
				BalanceAmount 		=	BalanceAmount.toFixed(2);
				$('#BalanceAmount').val(BalanceAmount);

			}
			//when removing item grand total calculate agian
			function GrandTotalWhenRemove(RemoveItemAmount,TaxValue)
			{

				var TotalWD		=	$('#TotalWD').val();
				TotalWD 		=	TotalWD-RemoveItemAmount;
				var Discount	=	$('#Discount').val();
				var TotalAmount =	TotalWD-Discount;
				TotalAmount 	=	TotalAmount.toFixed(2);
				$('#TotalAmount').val(TotalAmount);
				$('#TotalWD').val(TotalWD);

				//for tax
				var TaxSum 		= 	$('#TotalTax').val();
				var TotalTax 	=	TaxSum-TaxValue;
				TotalTax 	=	TotalTax.toFixed(2);
				$('#TotalTax').val(TotalTax);

				//for advance and balance
				var AdvanceAmount 	=	$('#AdvanceAmount').val();
				var BalanceAmount 	=	TotalAmount - AdvanceAmount;
				BalanceAmount 		=	BalanceAmount.toFixed(2);
				$('#BalanceAmount').val(BalanceAmount);


			}

			function ServiceOnChange(id)
			{
				var ServiceID 	=	$('#ServiceID'+id).val();

				$.ajax({
			      url: '<?php echo base_url()."order/service_image";?>',
			      type: 'post',
			      data: { ServiceID: ServiceID},
			      success: function(data) {

			      	$('#Photo'+id).html(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call   


			    $.ajax({
			      url: '<?php echo base_url()."order/chose_design";?>',
			      type: 'post',
			      data: { 'ServiceID': ServiceID},
			      success: function(data) {

			      	$('#DesignID'+id).html(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call 

			     //for Free shawl
			    $.ajax({
			      url: '<?php echo base_url()."order/chose_free_item";?>',
			      type: 'post',
			      data: { 'ServiceID': ServiceID},
			      success: function(data) {

			      	$('#WFService'+id).html(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call


			     $.ajax({
			      url: '<?php echo base_url()."order/service_price";?>',
			      type: 'post',
			      data: { 'ServiceID': ServiceID},
			      success: function(data) {

			      	var obj = jQuery.parseJSON(data);
					$('#Rate'+id).val(obj.ServicePrice);
					$('#TaxRate'+id).val(obj.TaxRate);
					$('#TaxMethod'+id).val(obj.TaxMethod);
					$('#ImageID'+id).val(obj.ImageID);
					PriceChangeService(id,obj.TaxRate,obj.ServicePrice,obj.TaxMethod);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); 



			}

			function DesignOnChange(id)
			{
				var DesignID 	=	$('#DesignID'+id).val();
				var ServiceID 	=	$('#ServiceID'+id).val();
				$.ajax({
			      url: '<?php echo base_url()."order/design_image";?>',
			      type: 'post',
			      data: { 'DesignID': DesignID , 'ServiceID': ServiceID},
			      success: function(data) {

			      	$('#Photo'+id).html(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call   

			    $.ajax({
			      url: '<?php echo base_url()."order/design_price";?>',
			      type: 'post',
			      data: { 'DesignID': DesignID},
			      success: function(data) {

			      	var obj = jQuery.parseJSON(data);
					$('#Rate'+id).val(obj.DesignPrice);
					$('#ImageID'+id).val(obj.ImageID);
					PriceChangeDesign(id,obj.DesignPrice);

				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); 
			    
			}

			//price and quanity change
			function PriceChange(id)
			{
				var TaxRate 	=	$('#TaxRate'+id).val();
				var Rate 		=	$('#Rate'+id).val();
				var Quantity 	=	$('#Quantity'+id).val();
				var TaxMethod 	=	$('#TaxMethod'+id).val();
				var Amount 		=	0;
				var TaxValue	=	0;


				if(TaxMethod == 'exclusive')
				{
					Amount 		=	Rate*Quantity;
					TaxValue 	=	(Amount*TaxRate)/100;
					Amount 		=	Amount+TaxValue;
					TaxValue 	=	TaxValue.toFixed(2);
					Amount 		=	Amount.toFixed(2);
				}
				else
				{	
					Amount 			=	Rate*Quantity;
					var WithoutTax 	=	Amount/((TaxRate/100)+1);
					TaxValue 		=	Amount-WithoutTax;
					TaxValue	 	=	TaxValue.toFixed(2);
					Amount 			=	Amount.toFixed(2);


				}

				$('#Amount'+id).val(Amount);
				$('#TaxValue'+id).val(TaxValue);
				GrandTotal();
			}



			//service change value update
			function PriceChangeService(id,TaxRate,Rate,TaxMethod)
			{
				var Quantity 	=	$('#Quantity'+id).val();
				var Amount 		=	0;
				var TaxValue 		=	0;


				if(TaxMethod == 'exclusive')
				{
					Amount 		=	Rate*Quantity;
					TaxValue 	=	(Amount*TaxRate)/100;
					Amount 		=	Amount+TaxValue;
					TaxValue 	=	TaxValue.toFixed(2);
					Amount 		=	Amount.toFixed(2);
				}
				else
				{
					Amount 			=	Rate*Quantity;
					var WithoutTax 	=	Amount/((TaxRate/100)+1);
					TaxValue 		=	Amount-WithoutTax;
					TaxValue 		=	TaxValue.toFixed(2);
					Amount 			=	Amount.toFixed(2);
				}
				$('#Amount'+id).val(Amount);
				$('#TaxValue'+id).val(TaxValue);
				GrandTotal();
			}
			//design change value will update
			function PriceChangeDesign(id,Rate)
			{
				var TaxRate 	=	$('#TaxRate'+id).val();
				var TaxMethod 	=	$('#TaxMethod'+id).val();
				var Quantity 	=	$('#Quantity'+id).val();
				var Amount 		=	0;
				var TaxValue 		=	0;


				if(TaxMethod == 'exclusive')
				{
					Amount 	=	Rate*Quantity;
					TaxValue 	=	(Amount*TaxRate)/100;
					Amount 	=	Amount+TaxValue;
					TaxValue 	=	TaxValue.toFixed(2);
					Amount 	=	Amount.toFixed(2);
				}
				else
				{
					Amount 			=	Rate*Quantity;
					var WithoutTax 	=	Amount/((TaxRate/100)+1);
					TaxValue 	=	Amount-WithoutTax;
					TaxValue 	=	TaxValue.toFixed(2);
					Amount 	=	Amount.toFixed(2);
				}
				$('#Amount'+id).val(Amount);
				$('#TaxValue'+id).val(TaxValue);
				GrandTotal();
			}


			//if Total amount changed values will be updated
			function TotalPriceChange(id)
			{
				var TaxRate 	=	$('#TaxRate'+id).val();
				var Quantity 	=	$('#Quantity'+id).val();
				var TaxMethod 	=	$('#TaxMethod'+id).val();
				var Amount 		=	$('#Amount'+id).val();
				var TaxValue 	=	0;
				var Rate 		=	0;
				//alert(TaxMethod);
				if(TaxMethod == 'exclusive')
				{
					var WithoutTax 	=	Amount/((TaxRate/100)+1);
					TaxValue 	=	Amount-WithoutTax;
					Rate 	=	(Amount-TaxValue)/Quantity;
					TaxValue 	=	TaxValue.toFixed(2);
					Rate 	=	Rate.toFixed(2);
				}
				else
				{
					var WithoutTax 	=	Amount/((TaxRate/100)+1);
					TaxValue 	=	Amount-WithoutTax;
					Rate 	=	Amount/Quantity;
					TaxValue 	=	TaxValue.toFixed(2);
					Rate 	=	Rate.toFixed(2);
				}
				$('#Rate'+id).val(Rate);
				$('#TaxValue'+id).val(TaxValue);
				GrandTotal();

			}

			//for addming more service 
			function AddItem()
			{
				var ItemNo 	=	$('#ItemNo').val();
				ItemNo++;
				$('#ItemNo').val(ItemNo);

				var ItemCount 	=	$('#ItemCount').val();
				ItemCount++;
				$('#ItemCount').val(ItemCount);

				$.ajax({
			      url: '<?php echo base_url()."order/add_item";?>',
			      type: 'post',
			      data: { ItemNo: ItemNo},
			      success: function(data) {

			      	$('#AllItem').append(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call  
			    
				
				
			}

			//for remove item
			function RemoveItem(id,OrderItemID = 0)
			{
				
				var ItemCount 		=	$('#ItemCount').val();				
				var OrderFormID 	=	$('#OrderFormID').val();				

				if(ItemCount <= 1)
				{
						swal("Not Removed!", "Only one item left", "error");
				}
				else
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
				            			var TaxValue 	=	$('#TaxValue'+id).val();

				            			//temove item from db and update the amount value
				            			if(OrderItemID != 0)
				            			{
				            				//addming to json text field
				            				count++;
				            				var obj = new Object();
				            				obj.OrderItemID =	OrderItemID;
				            				DelItemJson[count]=obj;
				            				var jsonString= JSON.stringify(DelItemJson);
											$('#DeleteOrderItemJson').val(jsonString);
				            			}
				            	
				            			
							      		GrandTotalWhenRemove(Amount,TaxValue);
							      		ItemCount--;
										$('#ItemCount').val(ItemCount);
							      		$('#Item'+id).hide('slow', function(){ $('#Item'+id).remove(); });
							      		swal("Deleted!", "Your file has been deleted.", "success");

				            } 
				        });
				}

							
			}

			//this function for chose first item name as customer name
			function FirstItemName()
			{
				var CustomerID =	$('#CustomerID').val();
				$.ajax({
			      url: '<?php echo base_url()."order/customer_name";?>',
			      type: 'post',
			      data: { CustomerID: CustomerID},
			      success: function(data) {
			      	console.log(data);
			      	$('#ItemName1').val(data);
				      					        
			      },
			      error: function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
			      }
			    }); // end ajax call  

				var ReferenceNo		=	$('#ReferenceNo').val();
				
				$('#OrderNo1').val(ReferenceNo);
				$('#BookNo1').val(Math.ceil(ReferenceNo/50));
			}
			
			//for bookno change
			function BookNoChange(id)
			{
				let OrderNo =	$('#OrderNo'+id).val();
				$('#BookNo'+id).val(Math.ceil(OrderNo/50));
			}

			//for default book no
			function DefBookNo(ItemNo)
			{
				//for auto generation of order no and book no
			    var ReferenceNo		=	$('#ReferenceNo').val();
			    var OrderNo 		=	(parseInt(ReferenceNo)+parseInt(ItemNo))-1;
			    $('#OrderNo'+ItemNo).val(OrderNo);
				$('#BookNo'+ItemNo).val(Math.ceil(OrderNo/50));
			}

			

		</script>


	</body>
</html>