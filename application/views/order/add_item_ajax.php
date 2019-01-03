					<div class="col-md-12" id="Item<?php echo $ItemSl; ?>">
							<div class="panel panel-default card-view" style="background-color: #f9f9f9">
								<div class="panel-heading">

									<div class="col-sm-1">
							
										<div class="form-group ">
											<input type="text" class="form-control" id="OrderNo<?php echo $ItemSl; ?>" name="OrderNo[]" placeholder="Order No" required="required" style="background-color: #f7f7f9;" 
											onkeyup="BookNoChange(<?php echo $ItemSl; ?>);" >
										</div>

									</div>

									<div class="pull-left col-sm-1">

				
										<div class="form-group ">
											<input type="text" class="form-control" id="BookNo<?php echo $ItemSl; ?>" name="BookNo[]" placeholder="Book No" style="background-color: #f7f7f9;">
										</div>


									</div>

			

									<div class="pull-left col-sm-3">
										
										<div class="form-group ">
											<input type="text" class="form-control" id="ItemName<?php echo $ItemSl; ?>" 
											name="ItemName[]" placeholder="Enter Name" required="required" value="Item No <?php echo $ItemSl; ?>" style="background-color: #f7f7f9;">
											<input type="hidden" name="ItemSl[]" value="<?php echo $ItemSl; ?>">
											<input type="hidden" name="ItemMode[]" value="add">
										</div>

									</div>
									<div class="pull-right">
										<a href="#" onclick="RemoveItem(<?php echo $ItemSl; ?>);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in" >
									<div class="panel-body" >
										
										<div class="form-wrap " >
		
												<div class="row">

													<div class="col-sm-1" id="Photo<?php echo $ItemSl; ?>">

															<img src="<?php echo base_url().'img/noimage.png';?>" width="100px" height="115px">

													</div>

													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Service</label>
															<select class="form-control select2" data-style="btn-primary btn-outline" name="ServiceID[]" id="ServiceID<?php echo $ItemSl; ?>" 
																required="required" onchange="ServiceOnChange(<?php echo $ItemSl; ?>);">
																<option value="">Chose Service</option>
<?php
					foreach($Services as $Serv)
					{
?>
									<option value="<?php echo $Serv['ServiceID']; ?>" <?php echo (isset($ServiceID) && $ServiceID == $Serv['ServiceID'])?'selected':''; ?> >
									<?php echo $Serv['ServiceName']; ?></option>
<?php
					}
?>

															</select>
															<input type="hidden" name="ImageID[]" id="ImageID<?php echo $ItemSl; ?>"  >
															<input type="hidden" name="TaxRate[]" id="TaxRate<?php echo $ItemSl; ?>" >
															<input type="hidden" name="TaxMethod[]" id="TaxMethod<?php echo $ItemSl; ?>" >
														</div>
													</div>

													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Design</label>
															<select class="form-control select<?php echo $ItemSl; ?>" data-style="btn-primary btn-outline" name="DesignID[]" id="DesignID<?php echo $ItemSl; ?>" 
																onchange="DesignOnChange(<?php echo $ItemSl; ?>);">
																<option value="">Chose a Sevice First</option>

															</select>

														</div>
													</div>

													<div class="col-sm-1" >
														<div class="form-group" id="WFService<?php echo $ItemSl; ?>">
															

														</div>
													</div>


													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Rate</label>
															<input type="text" class="form-control" name="Rate[]" id="Rate<?php echo $ItemSl; ?>" 
															placeholder="Enter Rate" style="text-align:right;" onkeyup="PriceChange(<?php echo $ItemSl; ?>);">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left">Quantity</label>
															<input type="text" class="form-control" name="Quantity[]" id="Quantity<?php echo $ItemSl; ?>" 
															placeholder="Quantity" value="1" onkeyup="PriceChange(<?php echo $ItemSl; ?>);">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
															<label class="control-label mb-10 text-left" id="TaxLabel<?php echo $ItemSl; ?>">Tax</label>
															<input type="text" class="form-control" name="TaxValue[]" id="TaxValue<?php echo $ItemSl; ?>" placeholder="Tax" readonly style="text-align:right;background-color: #fff;">
														</div>
													</div>

													<div class="col-sm-2">
														<div class="form-group has-success">
															<label class="control-label mb-10 text-left">Amount</label>
															<input type="text" class="form-control" name="Amount[]" id="Amount<?php echo $ItemSl; ?>" placeholder="Enter Amount" 
															style="text-align:right;background-color: #fff;" onkeyup="TotalPriceChange(<?php echo $ItemSl; ?>);" >
														</div>
													</div>


											

													<div class="col-sm-1">
														<div class="form-group">
						
															<input type="text" class="form-control" name="LEN[]" id="LEN<?php echo $ItemSl; ?>"  placeholder="LEN" title="LEN Size" >
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
													
															<input type="text" class="form-control" name="CHE[]" id="CHE<?php echo $ItemSl; ?>"  placeholder="CHE" title="CHE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="text" class="form-control" name="WE[]" id="WE<?php echo $ItemSl; ?>"  placeholder="WE" title="WE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="text" class="form-control" name="HIP[]" id="HIP<?php echo $ItemSl; ?>" placeholder="HIP" title="HIP Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="text" class="form-control" name="SLEE[]" id="SLEE<?php echo $ItemSl; ?>"  placeholder="SLEE" title="SLEE Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
											
															<input type="text" class="form-control" name="RIGA[]" id="RIGA<?php echo $ItemSl; ?>"  placeholder="RIGA" title="RIGA Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
			
															<input type="text" class="form-control" name="FAR[]" id="FAR<?php echo $ItemSl; ?>"  placeholder="FAR" title="FAR Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
								
															<input type="text" class="form-control" name="BOX[]" id="BOX<?php echo $ItemSl; ?>"  placeholder="BOX" title="BOX Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
									
															<input type="text" class="form-control" name="NOR[]" id="NOR<?php echo $ItemSl; ?>"  placeholder="NOR" title="NOR Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
											
															<input type="text" class="form-control" name="BOT[]" id="BOT<?php echo $ItemSl; ?>"  placeholder="BOT" title="BOT Size">
														</div>
													</div>

													<div class="col-sm-1">
														<div class="form-group">
										
															<input type="text" class="form-control" name="NECK[]" id="NECK<?php echo $ItemSl; ?>"  placeholder="NECK" title="NECK Size">
														</div>
													</div>

												</div>

										</div>

									</div>
								</div>



								</div>
							</div>


<script type="text/javascript">
	DefBookNo(<?php echo $ItemSl; ?>);
</script>