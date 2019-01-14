<?php 	if($Type == 'add')
		{
?>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >New payment of <?php echo $CustomerName; ?></h5>
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
																						<label class="control-label mb-10 text-left">Amount</label>
																						<input type="text" class="form-control" id="Amount" name="Amount" placeholder="Amount" required="required" >
																						<input type="hidden" name="SaleID" value="<?php echo $SaleID; ?>">
																						<input type="hidden" name="CustomerID" value="<?php echo $CustomerID; ?>">
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

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="InsertPayment(<?php echo $SaleID; ?>);">
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
														<h5 class="modal-title" >Advance amount of <?php echo $CustomerName; ?></h5>
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
													    								<td> <?php echo (!empty($Item['OrderFormID']))?'Paid advance on ':' Sale amount on '; echo date('d M Y',strtotime($Item['PaymentDate'])); ?></td>
													    								<td class="text-right"><?php echo number_format($Item['Amount'],2); ?></td>
													    								<td><a href="#" onclick="DeleteAdvance(<?php echo $Item['PaymentID']; ?>,<?php echo $Item['Amount']; ?>);" data-toggle="tooltip" data-original-title="Close"> 
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

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="MakeNewPayment(<?php echo $SaleID; ?>,<?php echo $CustomerID; ?>,<?php echo $ReferenceNo; ?>);">
															<i class="fa fa-plus"></i><span> Make new payment</span>
														</button>

													</div>
<?php			
		}
?>											


<script type="text/javascript">


    $( document ).ready(function() {

        let TotalAdvancePaid 	=	parseInt($('#TotalAdvancePaid').val());
        if(TotalAdvancePaid != 0){
            let BalanceAmountPop 	=	parseInt($('#BalanceAmountPop').val());
            BalanceAmountPop    =   BalanceAmountPop - TotalAdvancePaid;
            $('#BalanceAmountPop').val(BalanceAmountPop);
            $('#BalanceAmountDiv').html(BalanceAmountPop.toFixed(2));
        }


    });

		function DeleteAdvance(PaymentID,Amount)
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
					      url: '<?php echo base_url()."sale/delete_payment";?>',
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
                                ShowAdvance();

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

		function MakeNewPayment(SaleID,CustomerID,ReferenceNo)
		{
			//alert(OrderFormID);
			$.ajax({
		      url: '<?php echo base_url()."sale/add_payment";?>',
		      type: 'post',
		      data: { SaleID: SaleID,CustomerID: CustomerID,ReferenceNo: ReferenceNo},
		      success: function(data) {
		      		$('#OFModalContent').html(data);
        
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
			}); // end ajax call   
		}

		function InsertPayment(SaleID)
		{
			var PaymentDate 	=	$('#PaymentDate').val();
			var Amount 			=	$('#Amount').val();


			$.ajax({
		      url: '<?php echo base_url()."sale/insert_payment";?>',
		      type: 'post',
		      data: { SaleID: SaleID,PaymentDate: PaymentDate,Amount: Amount},
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