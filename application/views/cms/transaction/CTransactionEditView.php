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
							<font size="7" color="black"> Edit Transaction Status </font>
						</p>
					</div>
				</div>
				<div class="container" style="margin-top: 35px;">
					<?php echo form_open_multipart('CMSController/transactionEdit', 'class="form-horizontal"'); ?>                
							<div class="form-group">
								<label class="control-label col-sm-2" for="transactionID">Transaction ID:</label>
								<div class="col-sm-10"> 
									<?php
										$data = array(
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'transactionID',
											'id'            => 'transactionID',
											'readonly'      => 'true',
											'value'	        => $transactionData[0]['transactionID']
										);
										echo form_input($data);
									?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="transactionDate">Transaction Date:</label>
								<div class="col-sm-10"> 
									<?php              
										$data = array (
											'type'          => 'text',
											'class'			=> 'form-control',
											'name'			=> 'transactionDate',
											'id'            => 'transactionDate',
											'value'         => $transactionData[0]['transactionDate'],
											'disabled'      => true
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('transactionDate', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="status">Status:</label>
								<div class="col-sm-10"> 
									<?php
										foreach($statusList as $status) {
											$statusOptions[$status['status_id']] = $status['status'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'status',
											'id'            => 'status',
										);
										
										echo form_dropdown($data, $statusOptions, $transactionData[0]['transactionStatus']);
									?>
									<?php echo form_error('status', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email:</label>
								<div class="col-sm-10">
									<?php
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'email',
											'id'            => 'email',
											'value'	        => $transactionData[0]['email'],
											'disabled'      => true
										);
										echo form_input($data); 
									?>
									<?php echo form_error('name', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="name">Name:</label>
								<div class="col-sm-10">
									<?php
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'name',
											'id'            => 'name',
											'value'	        => $transactionData[0]['name'],
											'disabled'      => true
										);
										echo form_input($data); 
									?>
									<?php echo form_error('name', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="totalTransaction">Total Transaction:</label>
								<div class="col-sm-10">
									<?php
										$data = array (
											'type'			=> 'text',
											'class'			=> 'form-control',
											'name'			=> 'totalTransaction',
											'id'            => 'totalTransaction',
											'value'         => $transactionData[0]['TotalTransaksi'],
											'disabled'      => true
										);
										echo form_input($data); 
									?>
									<?php echo form_error('name', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url().'/CMSController/CMS/Transaction'?>" class="btn btn-danger">Cancel</a>
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
