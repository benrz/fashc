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
				<table id="productTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th> </th>
							<th> Product ID </th>
							<th> Product Detail ID </th>
							<th> Product Name </th>
							<th> Product Category </th>
							<th> Product Age </th>
							<th> Product Image </th>
							<th> Product Size </th>
							<th> Product Color </th>
							<th> Product Price </th>
							<th> Product Stock </th>
							<th> Product Availability </th>
							<th> </th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$row = 0;
							foreach($itemDetail as $product)
							{
								$row++;
								$productDetailID = $product['itemDetailID'];
								$productID = $product['itemID'];
								echo "<tr>";
									echo "<td>" .$row. "</td>"; 
									echo "<td>" .$product['itemID']. "</td>";
									echo "<td>" .$product['itemDetailID']. "</td>";
									echo "<td>" .$product['itemName']. "</td>";
									echo "<td>" .$product['itemCategoryName']. "</td>";
									echo "<td>" .$product['itemAge']. "</td>";
									echo "<td><img src='".base_url().$product['itemImage']. "' style='width: 90px; height: 100px;'></td>";
									echo "<td>" .$product['itemSizeName']. "</td>";
									echo "<td>" .$product['itemColorName']. "</td>";
									echo "<td>" .$product['itemPrice']. "</td>";
									echo "<td>" .$product['itemStock']. "</td>";

									if($product['itemDetailAvailability'] == 1){
										echo "<td> Available </td>";
									}
									else{                            
										echo "<td> Unavailable </td>";
									}
									echo "<td>";
										echo "<a href='".base_url("index.php/CMSController/productDetailEditView?itemDetailID=$productDetailID&itemID=$productID")."'
												style='margin-right:10px;color:rgb(255,215,0);'>";
											echo "<button class='btn'>";
												echo "<span class='glyphicon glyphicon-edit'></span>";
											echo "</button>";
										echo "</a>";

										
										// echo "<a href='".base_url("index.php/CMSController/productDetailDelete?itemDetailID=$productDetailID&itemID=$productID")."'
										//         style='margin-right:10px;color:red;'>";
										//     echo "<button class='btn'>";
										//         echo "<span class='glyphicon glyphicon-remove'></span>";
										//     echo "</button>";
										// echo "</a>";
										
									echo "</td>";
								echo "</tr>";
							}
						?>
					</tbody>
					<tfoot>
						<td> </td>
						<td> Product ID </td>
						<td> Product Detail ID </td>
						<td> Product Name </td>
						<td> Product Category </td>
						<td> Product Age </td>
						<td> Product Image </td>
						<td> Product Size </td>
						<td> Product Color </td>
						<td> Product Price </td>
						<td> Product Stock </td>
						<td> Product Availability </td>
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
		$('#productTable').DataTable();
	})
</script>
