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
				<a href="<?php echo base_url('index.php/CMSController/CMS/Transaction') ?>" style="float:right" class="btn btn-primary"><i class="glyphicon glyphicon-circle-arrow-left"></i></a><br><br>
				<table id="transactionDetailTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th> </th>
							<th> Item Name </th>
							<th> Item Age </th>
							<th> Item Image </th>
							<th> Item Category </th>
							<th> Item Size </th>
							<th> Item Color </th>
							<th> Item Quantity </th>
							<th> Item Price </th>
							<th> Total Price </th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$row = 0;
							foreach($transactionDetail as $transaction)
							{
								$row++;
								echo "<tr>";
									echo "<td>" .$row. "</td>"; 
									echo "<td>" .$transaction['itemName']. "</td>";
									echo "<td>" .$transaction['itemAge']. "</td>";
									echo "<td> <img src='" .$transaction['itemImage']. "'></td>";
									echo "<td>" .$transaction['itemCategoryName']. "</td>";
									echo "<td>" .$transaction['itemSizeName']. "</td>";
									echo "<td>" .$transaction['itemColorName']. "</td>";
									echo "<td>" .$transaction['itemQuantity']. "</td>";
									echo "<td>" .$transaction['itemPrice']. "</td>";
									echo "<td>" .$transaction['itemPrice'] * $transaction['itemQuantity']. "</td>";
								echo "</tr>";
							}
						?>
					</tbody>
					<tfoot>
						<td> </td>
						<td> Item Name </td>
						<td> Item Age </td>
						<td> Item Image </td>
						<td> Item Category </td>
						<td> Item Size </td>
						<td> Item Color </td>
						<td> Item Quantity </td>
						<td> Item Price </td>
						<td> Total Price </td>
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
		$('#transactionDetailTable').DataTable();
	})
</script>
