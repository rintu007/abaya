<link href="<?php echo base_url(); ?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	
	<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2018 &copy; Al Hara. Powered by <a href="http://suhailphp.com" target="blank" > Suhail </a></p>
					</div>
				</div>
			</footer>


<!-- jQuery -->
		<script src="<?php echo base_url(); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
		<!-- Init JavaScript -->
		<script src="<?php echo base_url(); ?>dist/js/init.js"></script>



	

<script type="text/javascript">
	
<?php 
	if(isset($_SESSION['MsgCode']) && isset($_SESSION['MsgContent']))
	{
?>			TsMessage("<?php echo $_SESSION['MsgCode']; ?>","<?php echo $_SESSION['MsgTitle']; ?>","<?php echo $_SESSION['MsgContent']; ?>");
<?php
	}
?>

	function TsMessage(MsgCode,MsgTitle,MsgContent)
	{
		if(MsgCode == 'error')
		{
			$.toast().reset('all');
			$("body").removeAttr('class');
			$.toast({
	            heading: MsgTitle,
	            text: MsgContent,
	            position: 'top-right',
	            loaderBg:'#fec107',
	            icon: 'error',
	            hideAfter: 10000
	        });
			return false;
		}
		else if(MsgCode == 'success')
		{
			$.toast().reset('all');
			$("body").removeAttr('class');
			$.toast({
	            heading: MsgTitle,
	            text: MsgContent,
	            position: 'top-right',
	            loaderBg:'#fec107',
	            icon: 'success',
	            hideAfter: 10000, 
	            stack: 6
	          });
			return false; 
		}
		else if(MsgCode == 'warning')
		{
			 $.toast().reset('all');
			$("body").removeAttr('class');
			$.toast({
	            heading: MsgTitle,
	            text: MsgContent,
	            position: 'top-right',
	            loaderBg:'#ff2a00',
	            icon: 'warning',
	            hideAfter: 10000, 
	            stack: 6
	        });
			return false;
		}
		else if(MsgCode == 'info')
		{
			$.toast().reset('all'); 
			$("body").removeAttr('class');
			$.toast({
	            heading: MsgTitle,
	            text: MsgContent,
	            position: 'top-right',
	            loaderBg:'#fec107',
	            icon: 'info',
	            hideAfter: 10000, 
	            stack: 6
	        });
			return false;
		}
	}



</script>

<?php
		unset($_SESSION['MsgCode']);
		unset($_SESSION['MsgTitle']);
		unset($_SESSION['MsgContent']);
?>