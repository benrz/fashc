<div class="right_col" role="main">
	<table id="customerTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th> </th>
				<th> User ID </th>
				<th> Email </th>
				<th> Name </th>
				<th> Image </th>
				<th> Role </th>
				<th> Date Registered </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$row = 0;
				foreach($customerData as $customer)
				{
					$row++;
					$customerID = $customer['user_id'];
					echo "<tr>";
						echo "<td>" .$row. "</td>"; 
						echo "<td>" .$customer['user_id']. "</td>";
						echo "<td>" .$customer['email']. "</td>";
						echo "<td>" .$customer['name']. "</td>";
						echo "<td><img src='" .$customer['image']. "'></td>";
						echo "<td>" .$customer['role']. "</td>";
						echo "<td>" .date('Y-m-d H:i:s', $customer['date_created']). "</td>";
						// echo "<td>";
						//     echo "<a href='".base_url("index.php/CMSController/customerDetail?customerID=$customerID")."'
						//             style='margin-right:10px;color:rgb(0,200,255);'>";
						//         echo "<button class='btn'>";
						//             echo "<span class='glyphicon glyphicon-search'></span>";
						//         echo "</button>";
						//     echo "</a>";
						// echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		<tfoot>
			<td> </td>
			<td> User ID </td>
			<td> Email </td>
			<td> Name </td>
			<td> Image </td>
			<td> Role </td>
			<td> Date Registered </td>
			<td> </td>
		</tfoot>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#customerTable').DataTable();
	})
</script>
