
											<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" >Sale</h5>
													</div>
													<div class="modal-body" id="">
														<!--start -->
														    <div class="col-xs-12">
													    		<div class="invoice-title">
													    			<h2>Invoice</h2>
													    			<h2 class="pull-right">Ref # <?php echo $ReferenceNo; ?></h2>
													    		</div>
													    		<hr>
													    		<div class="row">
													    			<div class="col-xs-4">
													    				<address>
													    				<strong>From :</strong><br>
													    					<strong>Al Hara Abayat & Shail Tr.</strong><br>
													    					Sh.Khalid Road Khorfakkan<br>
													    					Tel:09-2370658 , 055-2016116
													    				</address>
													    			</div>
													    			<div class="col-xs-4 text-center">
													    				<img src="<?php echo base_url().'img/logo.png';?>" width="150">
													    			
													    			</div>
													    			<div class="col-xs-4 text-right">
													    				<address>
													        			<strong>To : </strong><br>
													    					<?php echo $CustomerName; ?><br>
													    					Tel : <?php echo $CustomerPhone; ?><br>
													    					<strong>Date : <?php echo date('d-m-Y',strtotime($SaleDate)); ?></strong><br>
													    				</address>
													    			</div>
													    		</div>
													    	
													    	</div>
													    </div>
													    
													    <div class="row">
													    	<div class="col-md-12">
													    		<div class="panel panel-default">
													    			
													    			<div class="panel-body">
													    				<div class="table-responsive">
													    					<table class="table table-condensed">
													    						<thead>
													                                <tr>
													        							<td><strong>Order No</strong></td>
													        							<td class="text-left"><strong>Item</strong></td>
													        							<td class="text-right"><strong>Price</strong></td>
													        							<td class="text-right"><strong>QTY</strong></td>
													        							<td class="text-right"><strong>Tax</strong></td> 
													        							<td class="text-right"><strong>Amount</strong></td>
													                                </tr>
													    						</thead>
													    						<tbody>

<?php 																	foreach($Items as $Item)
																		{

																			if($Item['ItemType'] == 'order')
																			{
																				$Order =	$this->m_sale->view_sale_order_item($Item['OrderItemID']);
																				$ItemCode 	=	$Order['OrderNo'];
																				$ItemName 	=	$Order['ServiceName'].' ('.$Order['DesignName'].')';
																				$UnitsName 		=	'ODR';
																			}
																			else //if product
																			{
																				if($Item['MUStat'] == 'yes')
																				{
																					$MU =	$this->m_sale->view_sale_mu_item($Item['ProductID']);
																					$ItemCode  	=	$MU['Barcode'];
																					$ItemName 	=	$Item['ProductName'].' X '.$MU['Quantity'];
																					$UnitsName	=	$MU['UnitsName'];
																				}
																				else
																				{
																					$Product 	=	$this->m_sale->view_sale_product_item($Item['ProductID']);
																					$ItemCode	=	$Product['ProductCode'];
																					$ItemName	=	$Product['ProductName'];
																					$UnitsName	=	$Product['UnitsName'];
																				}
																				
																			}
?>
													    							<tr>
													    								<td><?php echo $ItemCode; ?></td>
													    								<td class="text-left"><?php echo $ItemName; ?></td>
													    								<td class="text-right"><?php echo number_format(($Item['Rate']),2); ?></td>
													    								<td class="text-right"><?php echo $Item['Quantity']; ?></td>
													    								<td class="text-right"><?php echo number_format($Item['TaxValue'],2); ?></td> 
													    								<td class="text-right"><?php echo number_format($Item['Amount'],2); ?></td>
													    							</tr>
													                               
<?php 																	}
?>													    							<tr>
													    								<td class="thick-line"><strong>Total : </strong><?php echo number_format($Total,2); ?> </td>
													    								<td class="thick-line"><strong>Total Tax : </strong><?php echo number_format($TaxAmount,2); ?> </td>
													    								<td class="thick-line"><strong>Discount : </strong><?php echo number_format($Discount,2); ?></td>
													    								<td class="thick-line"></td>
													    								<td class="thick-line text-center"><strong>Total Amount</strong></td>
													    								<td class="thick-line text-right"><?php echo number_format($TotalAmount,2); ?></td>
													    							</tr>

													    <!-- 							<tr>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
		
													    								<td class="no-line text-center"><strong>Piad</strong></td>
													    								<td class="no-line text-right">0.00</td>
													    							</tr>

													    							<tr>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
													    								<td class="no-line"></td>
		
													    								<td class="no-line text-center"><strong>Balance</strong></td>
													    								<td class="no-line text-right"><?php echo number_format($TotalAmount,2); ?></td>
													    							</tr> -->
													    							
													    							
													    						</tbody>
													    					</table>
													    				</div>
													    			</div>
													    		</div>
													    	</div>
													  
													<!--End -->
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>

														<button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="do_print(<?php echo $SaleID; ?>);"> 
															<i class="fa fa-print"></i><span> Print</span> 
														</button>

													</div>