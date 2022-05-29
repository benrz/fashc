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
							<font size="7" color="black"> Edit Product </font>
						</p>
					</div>
				</div>
				<div class="container" style="margin-top: 35px;">
					<?php
						echo "<script>";
						echo "var itemID = ". json_encode($itemID) .";";
						echo "</script>";
					?>
					<?php echo form_open_multipart('CMSController/productDetailEdit', 'class="form-horizontal"'); ?>
						<?php echo form_hidden('itemID', $itemDetail[0]['itemID']); ?>
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemDetailAvailability">Availability:</label>
								<div class="col-sm-10"> 
									<?php
										$availabilityOptions = array(
											'0'             => 'Unavailable',
											'1'             => 'Available',
										);
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemDetailAvailability',
											'id'            => 'itemDetailAvailability',
										);
										
										echo form_dropdown($data, $availabilityOptions, $itemDetail[0]['itemDetailAvailability']);
									?>
									<?php echo form_error('itemDetailAvailability', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemID">Detail ID:</label>
								<div class="col-sm-10"> 
									<?php
										$data = array(
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'itemDetailID',
											'id'            => 'itemDetailID',
											'readonly'      => 'true',
											'value'	        => $itemDetail[0]['itemDetailID']
										);
										echo form_input($data);
									?>
									<?php echo form_error('itemDetailID', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemName">Name:</label>
								<div class="col-sm-10">
									<?php
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'itemName',
											'id'            => 'itemName',
											'disabled'      => 'true',
											'value'	        => $itemDetail[0]['itemName']
										);
										echo form_input($data); 
									?>
									<?php echo form_error('itemName', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemSizeName">Size:</label>
								<div class="col-sm-10"> 
									<?php
										foreach($itemSize as $size) {
											$sizeOptions[$size['itemSizeID']] = $size['itemSizeName'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemSizeName',
											'id'            => 'itemSizeName',
											'placeholder'	=> 'Size',
										);
										
										echo form_dropdown($data, $sizeOptions, $itemDetail[0]['itemSizeID']);
									?>
									<?php echo form_error('itemSizeName', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemColorName">Color:</label>
								<div class="col-sm-10"> 
									<?php
										foreach($itemColor as $color) {
											$colorOptions[$color['itemColorID']] = $color['itemColorName'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemColorName',
											'id'            => 'itemColorName',
											'placeholder'	=> 'Color',
										);
										
										echo form_dropdown($data, $colorOptions, $itemDetail[0]['itemColorID']);
									?>
									<?php echo form_error('itemColorName', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemPrice">Price:</label>
								<div class="col-sm-10"> 
									<?php                            
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control itemPrice',
											'name'			=> 'itemPrice',
											'id'            => 'itemPrice',
											'value'	        => $itemDetail[0]['itemPrice']
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('itemPrice', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemStock">Stock:</label>
								<div class="col-sm-10"> 
									<?php                            
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control itemStock',
											'name'			=> 'itemStock',
											'id'            => 'itemStock',
											'value'	        => $itemDetail[0]['itemStock']
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('itemStock', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemImage">Image:</label>
								<img src='<?php echo base_url().$itemDetail[0]['itemImage']?>' style='width: 90px; height: 100px;'>
								<!-- <div class="col-sm-10"> 
									<?php
										$data = array (
											'type'			=> 'file',
											'class'			=> 'form-control',
											'name'			=> 'itemImage',
											'id'            => 'itemImage',
											'disabled'      => 'true'
										);
										echo form_input($data); 
									?>
									<?php echo form_error('itemImage', '<div class="error">', '</div>'); ?>
								</div> -->
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url().'/CMSController/productDetail?itemID='.$itemDetail[0]['itemID'].''?>" class="btn btn-danger">Cancel</a>
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
      $(".itemPrice").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
          }
      });

      
      $(".itemStock").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
          }
      });
    });
</script>
