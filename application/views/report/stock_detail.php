		

<?php 		
		foreach ($ProductBatch as $PB) 
		{
			$PBStockItem 	=	$this->m_report->list_stock_item_pb($PB['ProductID'],$PB['ProductBatchID']);
			$PBStockMU 		=	$this->m_report->list_stock_mu_pb($PB['ProductID'],$PB['ProductBatchID']);
?>
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo 'Batch No : '.$PB['BatchNo'].' --  Expiry Date : '.date('d M Y',strtotime($PB['ExpiryDate'])); ?></h6>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body row pa-0">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th>Name</th>
								<th>Quantity</th>

							</tr>
						</thead>
						<tbody>

							<tr>
								<td><?php echo $PBStockItem['ProductName'].' X 1'; ?> </td>
								<td><?php echo $PBStockItem['Stock'].' '.$PBStockItem['UnitsName'] ; ?> </td>
		
							</tr>

<?php 	
		foreach($PBStockMU as $PBMU)
		{
?>
							<tr>
								<td><?php echo $PBStockItem['ProductName'].' X '.$PBMU['Quantity']; ?> </td>
								<td><?php echo floor($PBMU['Stock']/$PBMU['Quantity']).' '.$PBMU['UnitsName']; ?> </td>
		
							</tr>

<?php						
		}
?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>


<?php
		}
?>


		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Total Stock</h6>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body row pa-0">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th>Name</th>
								<th>Quantity</th>

							</tr>
						</thead>
						<tbody>

							<tr>
								<td><?php echo $StockItem['ProductName'].' X 1'; ?> </td>
								<td><?php echo $StockItem['Stock'].' '.$StockItem['UnitsName'] ; ?> </td>
		
							</tr>

<?php 	foreach($StockMU as $MU)
		{
?>
							<tr>
								<td><?php echo $StockItem['ProductName'].' X '.$MU['Quantity']; ?> </td>
								<td><?php echo floor($MU['Stock']/$MU['Quantity']).' '.$MU['UnitsName']; ?> </td>
		
							</tr>

<?php						
		}
?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>