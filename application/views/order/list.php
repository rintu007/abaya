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

	<!--alerts CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

	<!-- Fancy-Buttons CSS -->
	<link href="<?php echo base_url();?>dist/css/fancy-buttons.css" rel="stylesheet" type="text/css">

	<!-- Data table CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">


<style>

	.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}

@media screen {
  #printSection {
      display: none;
  }
}




</style>
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
					  <h5 class="txt-dark">Orders</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
						<li class="active"><span>Order</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<div class="row">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">New orders</h6>
								</div>
								<div class="pull-right">			
									<a href="<?php echo base_url().'order/add'; ?>"><div class="pull-left"><i class="fa fa-plus-square mr-5"></i><span class="right-nav-text">New</span></div></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
						
									<div class="table-wrap mt-0">
										<div class="table-responsive">
											<table id="myTable1" class="table table-hover display  pb-30" >
												<thead>
												  <tr>
													<th>Reference No</th>
													<th>Name</th>
													<th>Phone</th>
													<th>Items</th>
													<th>Amount</th>
											
													<th >Status</th>
													<th class="text-nowrap">Action</th>
												  </tr>
												</thead>
												<tbody>
<?php 					$count = 0;
						foreach($items as $item)
						{
							$count++;
?>
												  <tr id="<?php echo $item['OrderFormID'];?>" >


													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;"><?php echo $item['ReferenceNo']; ?></td>
													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;"><?php echo $item['CustomerName']; ?></td>
													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;"><?php echo $item['CustomerPhone']; ?></td>
													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;"><?php echo $item['ItemCount']; ?></td>
													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;"><?php echo number_format($item['TotalAmount'],2); ?></td>
						


													<td onclick="ShowOrderForm(<?php echo $item['OrderFormID'];?>);" style="cursor: pointer;">

<?php 								if($item['Status'] == 'new')
									{
?>
												<span class="label label-danger">New Order</span>
<?php
									}
									else if($item['Status'] == 'stitching')
									{
?>
												<span class="label label-warning">Stiching</span>
<?php
									}
									else if($item['Status'] == 'partial')
									{
?>
												<span class="label label-primary">Partial Ready</span>
<?php								}
									else
									{
?>
												<span class="label label-success">Ready</span>
<?php										
									}														
?>		
													</td>
													<td class="text-nowrap">

														<a href="#" onclick="TotalAsAdvance(<?php echo $item['OrderFormID']; ?>);" data-toggle="tooltip" class="mr-25" > <i class="fa fa-dollar text-success "></i> </a>


														<a href="<?php echo base_url().'order/edit/'.$item['OrderFormID']; ?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> 
															<i class="fa fa-pencil text-inverse m-r-10"></i> </a> 

														<a href="#" onclick="DeleteItem(<?php echo $item['OrderFormID']; ?>);" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
												  </tr>
<?php 					}
						if($count == 0)
						{
							echo '<tr><td colspan="8"><center>No data available </center></td></tr>';
						}
?>
												  
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Basic Table -->


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


					<!-- MOdal for Order View -->
					<div id="AdModal" class="modal fade   " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog ">
							<div class="modal-content " id="AdModalContent">
								
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->




				</div>	


				
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
	

	
	<!-- Slimscroll JavaScript -->
	<script src="<?php echo base_url();?>dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->


	<!-- Sweet-Alert  -->
	<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>vendors/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url();?>dist/js/responsive-datatable-data.js"></script>


	<script type="text/javascript">

		//gettting total amount as advance
		function TotalAsAdvance(OrderFormID)
		{
			$.ajax({
		      url: '<?php echo base_url()."order/view_advance_list";?>',
		      type: 'post',
		      data: { OrderFormID: OrderFormID},
		      success: function(data) {
		      	$('#AdModalContent').html(data);
		      	$('#AdModal').modal('toggle');
		      },
		      error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		      }
		    }); // end ajax call
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

	

		function do_print()
	    {
	    	//          
	    }

		function DeleteItem(id)
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
					      url: '<?php echo base_url()."order/delete";?>',
					      type: 'post',
					      data: { id: id},
					      success: function(data) {
					      	if(data == true)
					      	{
					      		//$('table#TableData tr#'+id).remove();
					      		$('table#myTable1 tr#'+id).hide('slow', function(){ $('table#TableData tr#'+id).remove(); });
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
