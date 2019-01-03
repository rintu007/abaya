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
	<link href="<?php echo base_url(); ?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
	<!-- Calendar CSS -->
	<link href="<?php echo base_url(); ?>vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>dist/css/style.css" rel="stylesheet" type="text/css">
	
</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
    <div class="wrapper theme-1-active pimary-color-green">
		
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

						<a href="<?php echo base_url().'design?view=list'; ?>">
							<div class="pull-left"><i class="fa  fa-th-list mr-5"></i><span class="right-nav-text">Design</span></div>
						</a>
					  

					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
						<li><a href="<?php echo base_url().'service'; ?>"><span>Service</span></a></li>
						<li class="active"><span>Design</span> </li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<!-- Product Row One -->
				<div class="row">

<?php 					$count = 0;
						foreach($items as $item)
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
		       				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" id="ItemRow<?php echo $item['DesignID'];?>">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<article class="col-item">
												<div class="photo" >
													<div class="options">
														<a href="#" onclick="DeleteItem(<?php echo $item['DesignID'];?>);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
													</div>
													
													<a href="<?php echo base_url().'design/edit/'.$item['DesignID']; ?>">
														<img style="width: 180px;height: 180px;" src="<?php echo $Photo; ?>"  class="img-responsive" alt="Image" /> </a>
												</div>
												<div class="info">
													<h9><?php echo $item['DesignName']; ?></h9>


													<span class="head-font block text-warning font-16"><?php echo number_format($item['DesignPrice'],2);?></span>
												</div>
											</article>
										</div>
									</div>	
								</div>	
							</div>	
<?php 					}
						if($count == 0)
						{
							echo 'No Data Fount';
						}
?>
										
				</div>	
				<!-- /Product Row Four -->
				
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
	
	<!-- Sweet-Alert  -->
	<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		
	<!-- Switchery JavaScript -->
	<script src="<?php echo base_url();?>vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="<?php echo base_url();?>dist/js/dropdown-bootstrap-extended.js"></script>


	<script type="text/javascript">
			
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
					      url: '<?php echo base_url()."design/delete";?>',
					      type: 'post',
					      data: { id: id},
					      success: function(data) {
					      
					      	console.log(data);
					      	if(data == true)
					      	{
					      		//$('table#TableData tr#'+id).remove();
					      		$('#ItemRow'+id).hide('slow', function(){ $('#ItemRow'+id).remove(); });
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
