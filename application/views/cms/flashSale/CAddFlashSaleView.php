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
							<font size="7" color="black"> Add Flash Sale Data </font>
						</p>
					</div>
				</div>
				<div class="container" style="margin-top: 35px;">
					<?php echo form_open_multipart('CMSController/addFlashSale', 'class="form-horizontal"'); ?>
						<div class="form-group">
							<label class="control-label col-sm-2" for="flashSaleDate">Flash Sale Date:</label>
							<div class="col-sm-10"> 
								<?php
									$data = array(
										'type'			=> 'date',
										'class'			=> 'form-control',
										'name'			=> 'flashSaleDate',
										'id'            => 'flashSaleDate',
										'value'			=> set_value('flashSaleDate'),
									);
									echo form_input($data);
								?>
								<?php echo form_error('flashSaleDate', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="flashSaleStartTime">Start Time:</label>
							<div class="col-sm-10"> 
								<?php              
									$data = array (
										'type'          => 'time',
										'class'			=> 'form-control',
										'name'			=> 'flashSaleStartTime',
										'id'            => 'flashSaleStartTime',
										'value'			=> set_value('flashSaleStartTime'),
									);
									
									echo form_input($data);
								?>
								<?php echo form_error('flashSaleStartTime', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="flashSaleEndTime">End Time:</label>
							<div class="col-sm-10"> 
								<?php              
									$data = array (
										'type'          => 'time',
										'class'			=> 'form-control',
										'name'			=> 'flashSaleEndTime',
										'id'            => 'flashSaleEndTime',
										'value'			=> set_value('flashSaleEndTime'),
									);
									
									echo form_input($data);
								?>
								<?php echo form_error('flashSaleEndTime', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="<?php echo site_url().'/CMSController/CMS/FlashSale'?>" class="btn btn-danger">Cancel</a>
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
