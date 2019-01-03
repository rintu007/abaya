<style type="text/css">
	
	label > input{ /* HIDE RADIO */
  visibility: hidden; /* Makes input not-clickable */

}
label > input + img{ /* IMAGE STYLES */
  cursor:pointer;
  border:2px solid transparent;
}
label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
  border:2px solid #f00;
}

</style>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >Assign</h5>
													</div>
													<div class="modal-body" id="">
														<!--start -->
														    <div class="col-xs-12">
													    		<div class="invoice-title">
													    			<b><?php echo $CustomerName.' - '.$CustomerPhone; ?> <?php echo (!empty($ItemName))?' ('.$ItemName.')':'';?></b>
													    			<h2 class="pull-right">Order # <?php echo $OrderNo; ?></h2>
													    		</div>
													    		
													    </div>
													    
													    <div class="row">
													    	<div class="col-md-12">
													    		<div class="panel panel-default">
													    			
													    			<div class="panel-body">
													    				<?php echo $ServiceName; ?><?php echo (!empty($DesignName))?' ('.$DesignName.')':'';?> , <?php echo $Quantity; ?> Quantity							    				

													    			</div>
													    		</div>
													    	</div>
													  
													<!--End -->
													</div>

													<!-- Product Row One -->
													<div class="row">

									<?php 					$count = 0;
															foreach($Tailors as $item)
															{
																$count++;

																if((isset($item['ImageID']) && $item['ImageID'] != 0 ) && file_exists($item['ImagePath'].'/'.$item['ImageName']))
																{
																	$Photo 	=	base_url().$item['ImagePath']."/".$item['ImageName'];
																}
																else
																{
																	$Photo 	=	 base_url().'img/noimage.png';
																}
									?>
											       				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" id="ItemRow<?php echo $item['StaffID'];?>">
																	<div class="panel panel-default card-view pa-0">
																		<div class="panel-wrapper collapse in">
																			<div class="panel-body pa-0 ">
																				<article class="col-item">
																					<div class="photo" >
																						<label>
																						  <input type="radio" name="StaffID" id="StaffID" value="<?php echo $item['StaffID']; ?>" <?php echo (isset($StaffID) && $StaffID == $item['StaffID'])?'checked':'';?> />
																						  <img src="<?php echo $Photo; ?>" style="width: 125px;height: 125px;">
																						</label>																							
																						
																					</div>
																					<div class="info">
																						<h9><?php echo $item['StaffName']; ?></h9>
																						<input type="hidden" name="StaffName[]" id="StaffName<?php echo $item['StaffID']; ?>" value="<?php echo $item['StaffName']; ?>">

																					</div>
																				</article>
																			</div>
																		</div>	
																	</div>	
																</div>	
									<?php 					}
															if($count == 0)
															{
																echo 'No Tailor Fount';
															}
									?>
																			
													</div>	
													<!-- /Product Row Four -->


													<div class="modal-footer">
														<button onclick="DoAssign(<?php echo $OrderItemID; ?>);" type="button" class="btn btn-success text-left" >Assign</button>

													</div>
<script type="text/javascript">
	
	function DoAssign(OrderItemID)
	{
		if($('input[name=StaffID]').is(':checked'))
		{
			var StaffID 	=	$('input[name=StaffID]:checked').val();
			var StaffName 	=	$('#StaffName'+StaffID).val();
		

			swal({   
	            title: StaffName,   
	            text: "You are assign this order to "+StaffName,   
	            type: "warning",   
	            showCancelButton: true,   
	            confirmButtonColor: "#f8b32d",   
	            confirmButtonText: "Yes, Assign!",   
	            cancelButtonText: "No, cancel !",   
	            closeOnConfirm: false,   
	            closeOnCancel: false 
		        }, function(isConfirm){   
		            if (isConfirm) {

		            	window.location.replace("<?php echo base_url().'order_manage/do_assign/';?>"+OrderItemID+"/"+StaffID+"/"+'<?php echo $mode;?>');
		            	
		            } else {     
		                swal("Cancelled", "Not assigned :)", "error");   
		            } 
		        });
		}
		else
		{
			swal("Chose Tailror", "Please chose one tailor to assign", "error"); 
		}


	}
</script>