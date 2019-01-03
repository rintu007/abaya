<?php 		if(count($Designs) < 1 )
			{
				echo '<option value="">No Designs for this service </option>';
			}
			else
			{
				echo '<option value="">Chose a Design </option>';			
			}
			
	 		foreach($Designs as $Des)
			{
?>
				<option value="<?php echo $Des['DesignID'];?>"><?php echo $Des['DesignName'];?></option>
<?php
			}
?>