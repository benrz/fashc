<div class="right_col" role="main">
	<table id="transactionTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th> </th>
				<th> Transaction ID </th>
				<th> Transaction Date </th>
				<th> Transaction Status </th>
				<th> Email </th>
				<th> Name </th>
				<th> Transaction Total </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$row = 0;
				foreach($transactionData as $transaction)
				{
					$row++;
					$transactionID = $transaction['transactionID'];
					echo "<tr>";
						echo "<td>" .$row. "</td>"; 
						echo "<td>" .$transaction['transactionID']. "</td>";
						echo "<td>" .$transaction['transactionDate']. "</td>";
						echo "<td>" .$transaction['status']. "</td>";
						echo "<td>" .$transaction['email']. "</td>";
						echo "<td>" .$transaction['name']. "</td>";
						echo "<td>" .$transaction['TotalTransaksi']. "</td>";
						echo "<td>";
							echo "<a href='".base_url("index.php/CMSController/transactionDetailView?transactionID=$transactionID")."'
									style='margin-right:10px;color:rgb(0,200,255);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-search'></span>";
								echo "</button>";
							echo "</a>";
							
							echo "<a href='".base_url("index.php/CMSController/transactionEditView?transactionID=$transactionID")."'
									style='margin-right:10px;color:rgb(255,215,0);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-edit'></span>";
								echo "</button>";
							echo "</a>";                        
						echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		<tfoot>
			<td> </td>
			<td> Transaction ID </td>
			<td> Transaction Date </td>
			<td> Transaction Status </td>
			<td> Email </td>
			<td> Name </td>
			<td> Transaction Total </td>
			<td> </td>
		</tfoot>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#transactionTable').DataTable();
	})
</script>
