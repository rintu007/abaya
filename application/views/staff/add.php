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
						  <h5 class="txt-dark"><?php echo ucfirst($mode); ?> Staff</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
		

							<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
							<li><a href="<?php echo base_url().'staff'; ?>"><span>Staff</span></a></li>
						<li class="active"><span><?php echo ucfirst($mode); ?></span></li>
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
											<form name="form one" method="post" action="<?php echo base_url().'staff/'.$mode;?>" enctype="multipart/form-data" onsubmit="return CheckFornm();">

													<div class="row">
														<div class="col-sm-6">

															<div class="form-group">
																<label class="control-label mb-10 text-left">Name</label>
																<input type="text" name="StaffName" id="StaffName" required="required" placeholder="Enter the Staff name" class="form-control"
																value="<?php echo isset($StaffName)?$StaffName:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Phone</label>
																<input type="text" id="StaffPhone" name="StaffPhone" class="form-control" placeholder="Enter Phone number"
																value="<?php echo isset($StaffPhone)?$StaffPhone:''; ?>" >
																
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Email</label>
																<input type="email" id="StaffEmail" name="StaffEmail" class="form-control" placeholder="Enter Email"
																	value="<?php echo isset($StaffEmail)?$StaffEmail:''; ?>" >
															</div>

															<div class="form-group">
																<label class="control-label mb-10 text-left">Adress</label>
																	<input type="text" id="StaffAddress" name="StaffAddress" class="form-control" placeholder="Enter Addresse"
																	value="<?php echo isset($StaffAddress)?$StaffAddress:''; ?>" >
															</div>


															<div class="form-group">
																<label class="control-label mb-10">Role</label>
																<select class="form-control" name="UserTypeID" id="UserTypeID" required="required" >
																	<option value="">Chose a type</option>
																	
<?php
													foreach($UserType as $type)
													{
?>
																	<option value="<?php echo $type['UserTypeID']; ?>" <?php echo (isset($UserTypeID) && $UserTypeID == $type['UserTypeID'])?'selected':''; ?> >
																	<?php echo $type['UserTypeName']; ?></option>
<?php
													}
?>
																</select>
															</div>



															<div class="form-group">
																<div class="checkbox checkbox-info">
																	<input id="FullTimeStaff" name="FullTimeStaff" type="checkbox" value="1" <?php echo (isset($FullTimeStaff) && $FullTimeStaff == 1)?'checked':''; ?>>
																	<label for="FullTimeStaff"> Full time staff </label>
																</div>
															</div>

														</div>

														<div class="col-sm-6">


															<div class="form-group ">
																<div class="checkbox checkbox-success ">

																	<input id="UserActive" name="UserActive" type="checkbox" value="1" <?php echo (isset($UserActive) && $UserActive == 1)?'checked':''; ?>>
																	<label for="UserActive" > Active User Login</label>
																</div>
															</div>


															<div id="UserLogin" style="display: none;">

																<div class="form-group">
																	<label class="control-label mb-10 text-left">User Name</label>
																	<input type="text" name="UserName" id="UserName" onchange="CheckUserName();" placeholder="Enter login user name" class="form-control"
																	value="<?php echo isset($UserName)?$UserName:''; ?>"  >
																</div>

<?php 													if(!isset($UserID) || $UserID == '')
														{
?>															
																<div class="form-group">
																	<label class="control-label mb-10 text-left">Password</label>
																	<input type="password" name="UserPassword" id="UserPassword"  placeholder="Enter Password" class="form-control"
																	value="" >
																</div>

																<div class="form-group">
																	<label class="control-label mb-10 text-left">Confirm</label>
																	<input type="password" name="Confirm" id="Confirm" placeholder="Confirm Password" class="form-control"
																	value="" >
																</div>
<?php 													}
?>


															</div>

															<div class="panel-wrapper collapse in">
																<div class="panel-body">
																	<label class="control-label mb-1">Staff Image</label>
																	<div class="mt-20">
<?php
																		if((isset($ImageID) && $ImageID != 0 ) && file_exists($ImagePath.'/'.$ImageName))
																		{
																			$Photo 	=	base_url().$ImagePath.'/'.$ImageName;
																		}
																		else
																		{
																			$Photo 	=	 base_url().'img/noimage.png';
																		}
?>
																		<input type="file" id="input-file-now-custom-1" name="Photo" class="dropify" 
																		data-default-file="<?php echo $Photo;?>" />
																	</div>	
																</div>
															</div>
											

															

														</div>

														<div class="col-sm-12">

															
<?php 									if($mode == 'update')
										{
?>											
															<div class="form-group">
																<div class="checkbox checkbox-success">
																	<input id="StaffActive" name="StaffActive" type="checkbox" value="1" <?php echo (isset($StaffActive) && $StaffActive == 1)?'checked':''; ?>>
																	<label for="StaffActive"> Staff Active </label>
																</div>
															</div>
<?php 									}
?>																


															<br>
															<div class="col-sm-2 col-xs-6 mt-15">
																<input type="hidden" name="StaffID" id="StaffID" value="<?php echo isset($StaffID)?$StaffID:''; ?>">
																<input type="hidden" name="UserID" id="UserID" value="<?php echo isset($UserID)?$UserID:''; ?>">
																<input type="hidden" name="ImageID" id="ImageID" value="<?php echo isset($ImageID)?$ImageID:''; ?>">
																<input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:''; ?>">
																<button class="btn btn-primary  btn-rounded btn-block btn-anim"><i class="fa fa-check-square"></i><span class="btn-text"><?php echo ucfirst($mode); ?> Staff</span></button>
															</div>



															<div class="col-sm-2 col-xs-6 mt-15">
																<a class="btn btn-danger  btn-rounded btn-block btn-anim" href="<?php echo base_url().'staff'; ?>"><i class="fa fa-minus-circle"></i><span class="btn-text">Cancel</span></a>
															</div>



														</div>


													</div>


																								
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
					
					
					
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
		

		<!-- Form Flie Upload Data JavaScript -->
		<script src="<?php echo base_url();?>dist/js/form-file-upload-data.js"></script>

		<!-- Sweet-Alert  -->
		<script src="<?php echo base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>


		<script type="text/javascript">
			
<?php 		if(isset($UserActive) && $UserActive == 1)
			{
?>				
				$('#UserLogin').show();
<?php
			}	
?>
			$('#UserActive').change(function () 
			{
			    if($('#UserActive').is(":checked"))
				{
				  $('#UserLogin').show('slow');
				}
				else
				{
					$('#UserLogin').hide('slow');
				}
			 });

			function CheckFornm()
			{
				if($('#UserActive').is(":checked"))
				{
					var UserName 		=	$('#UserName').val();
					var UserPassword 	=	$('#UserPassword').val();
					var Confirm			=	$('#Confirm').val();
					if(UserName == '')
					{
						swal("UserName!", "Please enter username", "warning");
						return(false);
					}
					else if(UserPassword == '')
					{
						swal("Password!", "Please enter password", "warning");
						return(false);
					}
					else if(UserPassword != Confirm)
					{
						swal("Not matching", "Password not matching", "warning");
						return(false);
					}
					else
					{
						return(true);
					}
	
				}
				else
				{
					return(true);
				}
				return(false);
			}
			function CheckUserName()
			{
				$("#UserName").focus();
				var UserID 			=	$('#UserID').val();
				var UserName 		=	$('#UserName').val();

				$.ajax({
					      url: '<?php echo base_url()."staff/check_user";?>',
					      type: 'post',
					      data: { UserName: UserName , UserID: UserID},
					      success: function(data) {

					      	if(data == 1)
					      	{
					      		swal("Username Exist!", "Username already exist, please try another one", "error");
					      		$("#UserName").focus();

					      	}
					      					        
					      },
					      error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					      }
					    }); // end ajax call   
			}

		</script>


	</body>
</html>