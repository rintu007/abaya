<?php 	if($Type == 'add')
		{
?>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >New advance of <?php echo $CustomerName; ?></h5>
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
																						<input type="hidden" name="OrderFormID" value="<?php echo $OrderFormID; ?>">
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

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="InsertAdvance(<?php echo $OrderFormID; ?>);"> 
															<i class="fa fa-plus"></i><span> Add Advance</span> 
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
													    								<td>Paid advance on <?php echo date('d M Y',strtotime($Item['PaymentDate'])); ?></td>
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
																						<input type="hidden" name="BalanceAmount" id="BalanceAmount" value="<?php echo $Balance; ?>">
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

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="AddMoreAdvance(<?php echo $OrderFormID; ?>,<?php echo $CustomerID; ?>,<?php echo $ReferenceNo; ?>);"> 
															<i class="fa fa-plus"></i><span> Add more Advance</span> 
														</button>

													</div>
<?php			
		}
?>											


<script type="text/javascript">
	
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
					      url: '<?php echo base_url()."order/delete_advance";?>',
					      type: 'post',
					      data: { PaymentID: PaymentID},
					      success: function(data) {
					      	if(data == true)
					      	{
					      		$('table#TableData tr#'+PaymentID).hide('slow', function(){ $('table#TableData tr#'+PaymentID).remove(); });
					      		var BalanceAmount 	=	$('#BalanceAmount').val();
					      		BalanceAmount 		=	parseInt(BalanceAmount)+parseInt(Amount);
					      		$('#BalanceAmount').val(BalanceAmount);
					      		$('#BalanceAmountDiv').html(BalanceAmount.toFixed(2));
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

		function AddMoreAdvance(OrderFormID,CustomerID,ReferenceNo)
		{
			//alert(OrderFormID);
			$.ajax({
		      url: '<?php echo base_url()."order/add_advance_list";?>',
		      type: 'post',
		      data: { OrderFormID: OrderFormID,CustomerID: CustomerID,ReferenceNo: ReferenceNo},
		      success: function(data) {
		      		$('#AdModalContent').html(data);
        
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
			}); // end ajax call   
		}

		function InsertAdvance(OrderFormID)
		{
			var PaymentDate 	=	$('#PaymentDate').val();
			var Amount 			=	$('#Amount').val();


			$.ajax({
		      url: '<?php echo base_url()."order/insert_advance_list";?>',
		      type: 'post',
		      data: { OrderFormID: OrderFormID,PaymentDate: PaymentDate,Amount: Amount},
		      success: function(data) {
		      		$('#AdModalContent').html(data);  
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
			}); // end ajax call   

		}


</script>