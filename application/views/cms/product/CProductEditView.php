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
					<?php echo form_open_multipart('CMSController/productEdit', 'class="form-horizontal"'); ?>
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemAvailability">Availability:</label>
								<div class="col-sm-10"> 
									<?php
										$availabilityOptions = array(
											'0'             => 'Unavailable',
											'1'             => 'Available',
										);
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemAvailability',
											'id'            => 'itemAvailability',
										);
										
										echo form_dropdown($data, $availabilityOptions, $itemData[0]['itemAvailability']);
									?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemID">ID:</label>
								<div class="col-sm-10"> 
									<?php
										$data = array(
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'itemID',
											'id'            => 'itemID',
											'readonly'      => 'true',
											'value'	        => $itemData[0]['itemID']
										);
										echo form_input($data);
									?>
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
											'value'	        => $itemData[0]['itemName']
										);
										echo form_input($data); 
									?>
									<?php echo form_error('itemName', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemCategoryName">Category:</label>
								<div class="col-sm-10"> 
									<?php
										foreach($itemCategory as $category) {
											$categoryOptions[$category['itemCategoryID']] = $category['itemCategoryName'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemCategoryName',
											'id'            => 'itemCategoryName',
											'placeholder'	=> 'Size',
										);
										
										echo form_dropdown($data, $categoryOptions, $itemData[0]['itemCategoryID']);
									?>
									<?php echo form_error('itemCategoryName', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemAge">Age:</label>
								<div class="col-sm-10"> 
									<?php                            
										$ageOptions = array(
											'Anak-Anak'     => 'Anak-Anak',
											'Remaja'        => 'Remaja',
											'Dewasa'        => 'Dewasa',
										);
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemAge',
											'id'            => 'itemAge',
											'placeholder'	=> 'Age',
										);
										
										echo form_dropdown($data, $ageOptions, $itemData[0]['itemAge']);
									?>
									<?php echo form_error('itemAge', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemDescription">Description:</label>
								<div class="col-sm-10"> 
									<?php                            
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'itemDescription',
											'id'            => 'itemDescription',
											'value'	        => $itemData[0]['itemDescription']
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('itemDescription', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemDiscount">Discount (%):</label>
								<div class="col-sm-10"> 
									<?php                            
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control itemDiscount',
											'name'			=> 'itemDiscount',
											'id'            => 'itemDiscount',
											'value'	        => $itemData[0]['itemDiscount']
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('itemDiscount', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="itemImage">Image:</label>
								<div class="col-sm-10"> 
									<?php
										$data = array (
											'type'			=> 'file',
											'class'			=> 'form-control',
											'name'			=> 'itemImage',
											'id'            => 'itemImage',
										);
										echo form_input($data); 
									?>
									<br>
									<img src='<?php echo base_url().$itemData[0]['itemImage']?>' style='width: 90px; height: 100px;'>
									<?php echo form_error('itemImage', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url().'/CMSController/CMS/Product/'.$itemData[0]['itemAge'].''?>" class="btn btn-danger">Cancel</a>
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

      
      $(".itemDiscount").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
          }
      });
    });
</script>
