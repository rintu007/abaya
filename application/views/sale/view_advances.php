<?php if(!empty($advances))
    {
?>
    <table class="table mb-0">
        <thead>
        <th colspan="3">List of advances of this customer</th>
        </thead>

        <tbody>
<?php  foreach($advances as $adv){
?>
        <tr>
            <td><div class="checkbox checkbox-success"> <input id="PaymentID<?php echo $adv['PaymentID'];?>" name="PaymentID[<?php echo $adv['PaymentID'];?>]" type="checkbox" value="<?php echo $adv['PaymentID'];?>" onchange="AdvanceChange(this,<?php echo $adv['Amount'];?>);">
                    <label for="PaymentID<?php echo $adv['PaymentID'];?>"><?php echo date('d-m-Y',strtotime($adv['PaymentDate']));?> </label></div></td>
            <td style="cursor: pointer;" onclick="ShowOrderForm(<?php echo $adv['OrderFormID'];?>);">Advance reference Number  <?php echo $adv['ReferenceNo']; ?></td>
            <td style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;"><?php echo number_format($adv['Amount'],2);?></td>

        </tr>
<?php
    }
?>

        </tbody>
        <tfoot>
        <td></td>

        <td>
           Total Amount paid from advance list
        </td>
        <td >  <input type="text" class="form-control" id="TotalAdvancePaid" name="TotalAdvancePaid" readonly  style="font-size:15px; font-weight: bold;text-align:right;background-color: #fff;" value="0.00" >  </td>

        </tfoot>
    </table>
<?php }
?>