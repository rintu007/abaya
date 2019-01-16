<?php 	if($Type == 'add')
		{
?>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >New payment of <?php echo $SupplierName; ?></h5>
													</div>
													    
													    <div class="row">
													    	<div class="col-md-12">
													    		<div class="panel panel-default">
													    			
													    			<div class="panel-body">
													    				<div class="table-responsive">
													    					<div class="form-wrap">
																				<form name="form one" method="post" action="" >
																					<div class="form-group ">
																						<label class="control-label mb-10 text-left">Date</label>
																						<input type="date" class="form-control" id="PaymentDate" name="PaymentDate" value="<?php echo date('Y-m-d'); ?>"required="required" >
																					</div>

																					<div class="form-group ">
																						<label class="control-label mb-10 text-left">Pay from</label>

                                                                                        <select class="form-control" name="PaymentAccountID" id="PaymentAccountID"  required="required">

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

                                                                                    <div class="form-group ">
                                                                                        <label class="control-label mb-10 text-left">Amount</label>
                                                                                        <input type="text" class="form-control" id="PopAmount" name="PopAmount" placeholder="Amount" required="required" >
                                                                                        <input type="hidden" name="PurchaseID" value="<?php echo $PurchaseID; ?>">
                                                                                        <input type="hidden" name="SupplierID" value="<?php echo $SupplierID; ?>">
                                                                                        <input type="hidden" name="ReferenceNo" value="<?php echo $ReferenceNo; ?>">
                                                                                    </div>

																				</form>
																			</div>
													    				</div>
													    			</div>
													    		</div>
													    	</div>
													  
													<!--End -->
													</div>
													<div class="modal-footer">

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="InsertPayment(<?php echo $PurchaseID; ?>);">
															<i class="fa fa-plus"></i><span> Add Payment</span>
														</button>

													</div>
					
<?php
		}
		else
		{
?>

											<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >Advance amount of <?php echo $SupplierName; ?></h5>
													</div>
													    
													    <div class="row">
													    	<div class="col-md-12">
													    		<div class="panel panel-default">
													    			
													    			<div class="panel-body">
													    				<div class="table-responsive">
													    					<table class="table table-condensed" id="TableData">
													    						<thead>
													                                <tr>
													        							<th><strong>Total Amount is </strong></th>
													        							<th class="text-right"><strong><?php echo number_format($TotalAmount,2); ?></strong></th>
													        							<th></th>
					
													                                </tr>
													    						</thead>
													    						<tbody>
<?php 																		$Balance =	$TotalAmount;
																			foreach($Payments as $Item)
																			{
																				$Balance 	=	$Balance-$Item['Amount'];
?>
													    							<tr id="<?php echo $Item['PaymentID'];?>">
                                                                                        <td>  Paid by <?php echo $Item['PaymentAccountName']; ?> on <?php echo date('d M Y',strtotime($Item['PaymentDate'])); ?></td>
                                                                                        <td class="text-right"><?php echo number_format($Item['Amount'],2); ?></td>
													    								<td><a href="#" onclick="DeletePayment(<?php echo $Item['PaymentID']; ?>,<?php echo $Item['Amount']; ?>);" data-toggle="tooltip" data-original-title="Close">
													    									<i class="fa fa-close text-danger"></i> </a> </td></td>
													    							</tr>
													                               
<?php 																		}
?>													    							
													    						</tbody>

													    						<tfoot>
													                                <tr>
													        							<th><strong>Balance Amount is </strong></th>
													        							<th class="text-right"><strong id="BalanceAmountDiv"><?php echo number_format($Balance,2); ?></strong></th>
													        							<th></th>
																						<input type="hidden" name="BalanceAmountPop" id="BalanceAmountPop" value="<?php echo $Balance; ?>">
													                                </tr>
													    						</tfoot>
													    					</table>
													    				</div>
													    			</div>
													    		</div>
													    	</div>
													  
													<!--End -->
													</div>
													<div class="modal-footer">

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="MakeNewPayment(<?php echo $PurchaseID; ?>,<?php echo $SupplierID; ?>,'<?php echo ''.$ReferenceNo; ?>');">
															<i class="fa fa-plus"></i><span> Make new payment</span>
														</button>

													</div>
<?php			
		}
?>											


<script type="text/javascript">




		function DeletePayment(PaymentID,Amount)
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
					      url: '<?php echo base_url()."purchase/delete_payment";?>',
					      type: 'post',
					      data: { PaymentID: PaymentID},
					      success: function(data) {
					      	if(data == true)
					      	{
					      		let BalanceAmountPop 	=	$('#BalanceAmountPop').val();
                                BalanceAmountPop 		=	parseInt(BalanceAmountPop)+parseInt(Amount);
					      		$('#BalanceAmountPop').val(BalanceAmountPop);
					      		$('#BalanceAmountDiv').html(BalanceAmountPop.toFixed(2));

					      		//$('table#TableData tr#'+id).remove();
					      		$('table#TableData tr#'+PaymentID).hide('slow', function(){ $('table#TableData tr#'+PaymentID).remove(); });
					      		let PaidAmount 	=	$('#PaidAmount').val();
                                PaidAmount 	=	parseInt(PaidAmount)-parseInt(Amount);
					      		$('#PaidAmount').val(PaidAmount.toFixed(2));
					      		GrandTotal();

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

		function MakeNewPayment(PurchaseID,SupplierID,ReferenceNo)
		{
			//alert(PurchaseID);
			$.ajax({
		      url: '<?php echo base_url()."purchase/add_payment";?>',
		      type: 'post',
		      data: { PurchaseID: PurchaseID,SupplierID: SupplierID,ReferenceNo: ReferenceNo},
		      success: function(data) {
		      		$('#OFModalContent').html(data);
        
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
			}); // end ajax call   
		}

		function InsertPayment(PurchaseID)
		{
			var PaymentDate 	=	$('#PaymentDate').val();
            var Amount 			=	$('#PopAmount').val();
            var PaymentAccountID 			=	$('#PaymentAccountID').val();


			$.ajax({
		      url: '<?php echo base_url()."purchase/insert_payment";?>',
		      type: 'post',
		      data: { PurchaseID: PurchaseID,PaymentDate: PaymentDate,Amount: Amount,PaymentAccountID: PaymentAccountID},
		      success: function(data) {
		      		$('#OFModalContent').html(data);  
		      		let PaidAmount 	=	$('#PaidAmount').val();
                    PaidAmount 	=	parseInt(PaidAmount)+parseInt(Amount);
		      		$('#PaidAmount').val(PaidAmount.toFixed(2));
		      		GrandTotal();  
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
			}); // end ajax call   

		}


</script>