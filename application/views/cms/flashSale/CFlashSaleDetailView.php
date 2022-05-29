<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

	<title> Fashc Admin </title>
	<?php echo $css; ?>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php echo $HeaderView; ?>
			<?php echo $SideBarView; ?>
			<div class="right_col" role="main">
				<a href="<?php echo site_url('/CMSController/addFlashSaleDetailView?flashSaleID='.$flashSaleID.'') ?>" style="float:right" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New Product</a><br><br>
				<a href="<?php echo site_url('/CMSController/CMS/FlashSale') ?>" style="float:right" class="btn btn-primary"><i class="glyphicon glyphicon-circle-arrow-left"></i></a><br><br>
				<table id="flashSaleDetailTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th> </th>
							<th> Item Name </th>
							<th> Item Description </th>
							<th> Item Age </th>
							<th> Item Image </th>
							<th> Item Category </th>
							<th> Item Discount </th>
							<th> </th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$row = 0;
							foreach($flashSaleDetail as $flashSale)
							{
								$row++;
								$flashSaleDetailID = $flashSale['flashSaleDetailID'];
								$flashSaleID = $flashSale['flashSaleID'];
								echo "<tr>";
									echo "<td>" .$row. "</td>"; 
									echo "<td>" .$flashSale['itemName']. "</td>";
									echo "<td>" .$flashSale['itemDescription']. "</td>";
									echo "<td>" .$flashSale['itemAge']. "</td>";
									echo "<td> <img src='" .$flashSale['itemImage']. "'></td>";
									echo "<td>" .$flashSale['itemCategoryName']. "</td>";
									echo "<td>" .$flashSale['flashSaleDiscount']. "%</td>";
									
									echo "<td>";
										echo "<a href='".base_url("index.php/CMSController/flashSaleDetailDelete?flashSaleDetailID=$flashSaleDetailID&flashSaleID=$flashSaleID")."'
												style='margin-right:10px;color:rgb(255,215,0);'>";
											echo "<button class='btn'>";
												echo "<span class='glyphicon glyphicon-remove'></span>";
											echo "</button>";
										echo "</a>";                        
									echo "</td>";
								echo "</tr>";
							}
						?>
					</tbody>
					<tfoot>
						<td> </td>
						<td> Item Name </td>
						<td> Item Description </td>
						<td> Item Age </td>
						<td> Item Image </td>
						<td> Item Category </td>
						<td> Item Discount </td>
						<td> </td>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	<?php echo $FooterView; ?>
	<?php echo $js; ?>
</body>
</html>

<script>
	$(document).ready(function(){
		$('#flashSaleDetailTable').DataTable();
	})
</script>
