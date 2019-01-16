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

    <!-- Data table CSS -->
    <link href="<?php echo base_url();?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">

	<!--alerts CSS -->
	<link href="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">


	
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
					  <a href="<?php echo base_url().'product?view=grid'; ?>">
							<div class="pull-left"><i class="fa  fa-th mr-5"></i><span class="right-nav-text">Expense</span></div>
						</a>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
						<li class="active"><span>Expense</span></li>
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
									<h6 class="panel-title txt-dark">List Expense</h6>
								</div>
								<div class="pull-right">			
									<a href="<?php echo base_url().'expense/add'; ?>"><div class="pull-left"><i class="fa fa-plus-square mr-5"></i><span class="right-nav-text">New</span></div></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
						
									<div class="table-wrap mt-0">
										<div class="table-responsive">
											<table class="table mb-0" id="TableData">
												<thead>
												  <tr>
													<th>Date</th>
													<th>Type</th>
													<th>Amount</th>

													<th class="text-nowrap">Action</th>
												  </tr>
												</thead>
												<tbody>
<?php 					$count = 0;
						foreach($items as $item)
						{
							$count++;
?>
												  <tr id="<?php echo $item['ExpenseID'];?>">
													<td><?php echo date('d-m-Y',strtotime($item['ExpenseDate'])); ?></td>
													<td><?php echo $item['ExpenseCategoryName']; ?></td>

													<td><?php echo number_format($item['Amount'],2); ?></td>


													<td class="text-nowrap">

														<a href="<?php echo base_url().'expense/edit/'.$item['ExpenseID']; ?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i>
														</a> 

														<a href="#" onclick="DeleteItem(<?php echo $item['ExpenseID']; ?>);" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
												  </tr>
<?php 					}
						if($count == 0)
						{
							echo '<tr><td colspan="4"><center>No data abailable </center></td></tr>';
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

	<!-- Piety JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/peity/jquery.peity.min.js"></script>
	<script src="<?php echo base_url();?>dist/js/peity-data.js"></script>

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



	<script type="text/javascript">

        "use strict";
        $(document).ready(function() {
            $('#TableData').DataTable( {
                responsive: true,
                "aaSorting": []
            } );
        } );
			
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
					      url: '<?php echo base_url()."expense/delete";?>',
					      type: 'post',
					      data: { id: id},
					      success: function(data) {
					      
					      	console.log(data);
					      	if(data == true)
					      	{
					      		//$('table#TableData tr#'+id).remove();
					      		$('table#TableData tr#'+id).hide('slow', function(){ $('table#TableData tr#'+id).remove(); });
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
