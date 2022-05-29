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
				<div class="container-fluid">
					<div style="border-bottom: 1px solid black;">
						<p style="text-align: center;"> 
							<font size="7" color="black"> Add Product </font>
						</p>
					</div>
				</div>
				<div class="container" style="margin-top: 35px;">
					<?php echo form_open_multipart('CMSController/addFlashSaleDetail', 'class="form-horizontal"'); ?>			
							<?php
								$data = array (
									'flashSaleID' => $flashSaleID
								);
								echo form_hidden($data); 
							?>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemID">Item Name:</label>
								<div class="col-sm-10"> 
									<?php
										foreach($itemID as $ID) {
											$idOptions[$ID['itemID']] = $ID['itemName'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemID',
											'id'            => 'itemID',
											'value'			=>  set_value('itemID'),
										);
										
										echo form_dropdown($data, $idOptions);
									?>
									<?php echo form_error('itemID', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="flashSaleDiscount">Discount (%):</label>
								<div class="col-sm-10"> 
									<?php                            
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control itemPrice',
											'name'			=> 'flashSaleDiscount',
											'id'            => 'flashSaleDiscount',
											'value'			=> set_value('flashSaleDiscount'),
											'placeholder'	=> 'Discount',
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('flashSaleDiscount', '<div class="error">', '</div>'); ?>
								</div>
							</div>
			
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url().'/CMSController/flashSaleDetailView?flashSaleID='.$flashSaleID.''?>" class="btn btn-danger">Cancel</a>
								</div>
							</div>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php echo $FooterView; ?>
	<?php echo $js; ?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
		$("#flashSaleDiscount").bind("keypress", function (e) {
			var keyCode = e.which ? e.which : e.keyCode
			var discount = document.getElementById("flashSaleDiscount").value;
			if(discount < 1){
				if (!(keyCode >= 49 && keyCode <= 57)) {
					return false;
				}
			}
			else{
				if (!(keyCode >= 48 && keyCode <= 57)) {
					return false;
				}
			}
		});

		$("#flashSaleDiscount").on("keypress", function(e){
			var currentValue = String.fromCharCode(e.which);
			var finalValue = $(this).val() + currentValue;

			if(finalValue > 100){	
				document.getElementById("flashSaleDiscount").value = 100;
				e.preventDefault();
			}
		});
    });
</script>
