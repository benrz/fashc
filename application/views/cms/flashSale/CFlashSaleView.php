<div class="right_col" role="main">
	<a href="<?php echo base_url('index.php/CMSController/addFlashSaleView') ?>" style="float:right" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Flash Sale Session</a><br><br>    
	<table id="flashSaleTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th> </th>
				<th> Flash Sale ID </th>
				<th> Date </th>
				<th> Start Time </th>
				<th> End Time </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$row = 0;
				foreach($flashSaleData as $flashSale)
				{
					$row++;
					$flashSaleID = $flashSale['flashSaleID'];
					echo "<tr>";
						echo "<td>" .$row. "</td>"; 
						echo "<td>" .$flashSale['flashSaleID']. "</td>";
						echo "<td>" .$flashSale['flashSaleDate']. "</td>";
						echo "<td>" .$flashSale['flashSaleStartTime']. "</td>";
						echo "<td>" .$flashSale['flashSaleEndTime']. "</td>";
						echo "<td>";
							echo "<a href='".site_url("/CMSController/flashSaleDetailView?flashSaleID=$flashSaleID")."'
									style='margin-right:10px;color:rgb(0,200,255);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-search'></span>";
								echo "</button>";
							echo "</a>";
							
							echo "<a href='".site_url("/CMSController/flashSaleEditView?flashSaleID=$flashSaleID")."'
									style='margin-right:10px;color:rgb(255,215,0);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-edit'></span>";
								echo "</button>";
							echo "</a>";   
							
							echo "<a href='".site_url("/CMSController/flashSaleDelete?flashSaleID=$flashSaleID")."'
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
				<td> Flash Sale ID </td>
				<td> Date </td>
				<td> Start Time </td>
				<td> End Time </td>
			<td> </td>
		</tfoot>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#flashSaleTable').DataTable();
	})
</script>
