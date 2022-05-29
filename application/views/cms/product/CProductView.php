<div class="right_col" role="main">
	<table id="productTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th> </th>
				<th> Product ID </th>
				<th> Product Name </th>
				<th> Product Category </th>
				<th> Product Age </th>
				<th> Product Image </th>
				<th> Product Availability </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$row = 0;
				foreach($productData as $product)
				{
					$row++;
					$productID = $product['itemID'];
					echo "<tr>";
						echo "<td>" .$row. "</td>"; 
						echo "<td>" .$product['itemID']. "</td>";
						echo "<td>" .$product['itemName']. "</td>";
						echo "<td>" .$product['itemCategoryName']. "</td>";
						echo "<td>" .$product['itemAge']. "</td>";
						echo "<td><img src='".base_url().$product['itemImage']. "' style='width: 90px; height: 100px;'></td>";
						if($product['itemAvailability'] == 1){
							echo "<td> Available </td>";
						}
						else{
							echo "<td> Unavailable </td>";
						}
						echo "<td>";
							echo "<a href='".base_url("index.php/CMSController/productDetail?itemID=$productID")."'
									style='margin-right:10px;color:rgb(0,200,255);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-search'></span>";
								echo "</button>";
							echo "</a>";
							
							echo "<a href='".base_url("index.php/CMSController/productEditView?itemID=$productID")."'
									style='margin-right:10px;color:rgb(255,215,0);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-edit'></span>";
								echo "</button>";
							echo "</a>";

							
							// echo "<a href='".base_url("index.php/CMSController/productDelete?itemID=$productID&itemAge=$productAge")."'
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
			<td> Product Name </td>
			<td> Product Category </td>
			<td> Product Age </td>
			<td> Product Image </td>
			<td> Product Availability </td>
			<td> </td>
		</tfoot>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#productTable').DataTable();
	})
</script>
