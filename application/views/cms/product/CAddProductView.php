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
					<?php
						echo "<script>";
						echo "var itemList = ". json_encode($itemID) .";";
						echo "var countData = " .count($itemID) . ";";
						echo "console.log(itemList);";
						echo "</script>";
						
					?>
					<?php echo form_open_multipart('CMSController/addProduct', 'class="form-horizontal"'); ?>
							<div class="form-group">
								<label class="control-label col-sm-2" for="newData">New Data?</label>
								<div class="col-sm-10">
									<?php
										$data = array(
											'name'          => 'newData',
											'id'            => 'newData',
											'value'         => 'accept',
											'checked'       =>  true,
											'style'         => 'margin:10px',
										);
										echo form_checkbox($data);
									?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemID">ID:</label>
								<div class="col-sm-10"> 
									<?php
										// $itemDescription = "<script>
										//     document.write($('input[type=text].itemDescription').val());
										// </script>";
										// echo $itemDescription;

										foreach($itemID as $ID) {
											$idOptions[$ID['itemID']] = $ID['itemID'];
										}
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemID',
											'id'            => 'itemID',
											'placeholder'	=> 'Size',
											'disabled'      =>  true,
											'value'			=>  set_value('itemID'),
											'onchange'       => 'getItemData()'
										);
										
										echo form_dropdown($data, $idOptions);
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
											'value'			=> set_value('itemName'),
											'placeholder'	=> 'Product Name'
										);
										echo form_input($data); 
									?>
									<?php echo form_error('itemName', '<div class="error">', '</div>'); ?>
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
											'value'			=>  set_value('itemDescription'),
											'placeholder'	=> 'Description',
										);
										echo form_input($data); 
									?>
									<?php echo form_error('itemDescription', '<div class="error">', '</div>'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="itemAge">Age:</label>
								<div class="col-sm-10"> 
									<?php
										$ageOptions = array(
											'Anak-Anak'         => 'Anak-Anak',
											'Remaja'           => 'Remaja',
											'Dewasa'         => 'Dewasa',
										);
										
										$data = array (
											'class'			=> 'form-control',
											'name'			=> 'itemAge',
											'id'            => 'itemAge',
											'placeholder'	=> 'Age',
										);
										
										echo form_dropdown($data, $ageOptions, set_value('itemAge'));
									?>
									<?php echo form_error('itemAge', '<div class="error">', '</div>'); ?>
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
											'placeholder'	=> 'Category',
										);
										
										echo form_dropdown($data, $categoryOptions, set_value('itemCategoryID'));
									?>
									<?php echo form_error('itemCategoryName', '<div class="error">', '</div>'); ?>
								</div>
							</div>
			<!-- ////////////////////////////////////////////////////////////////////////// -->
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
											'value'			=> set_value('itemSizeID'),
											'disabled'		=> true,
										);
										
										echo form_dropdown($data, $sizeOptions);
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
											'value'			=> set_value('itemColorID'),
											'disabled'		=> true,
										);
										
										echo form_dropdown($data, $colorOptions);
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
											'value'			=> set_value('itemPrice'),
											'placeholder'	=> 'Price',
											'disabled'		=> true,
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
											'value'			=> set_value('itemStock'),
											'placeholder'	=> 'Stock',
											'disabled'		=> true,
										);
										
										echo form_input($data);
									?>
									<?php echo form_error('itemStock', '<div class="error">', '</div>'); ?>
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
											'value'			=> set_value('itemImage'),
										);
										echo form_input($data); 
									?>
									<br>
									<img src='' id='itemImageSrc'>
									<?php echo form_error('itemImage', '<div class="error">', '</div>'); ?>
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url().'/CMSController/CMS'?>" class="btn btn-danger">Cancel</a>
								</div>
							</div>

					<?php echo form_close(); ?>
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
	  
	  $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#itemImageSrc').attr('src', '');
            	$("#itemID").prop("disabled", true); 
				$('#itemName').prop("disabled", false); 
				$('#itemDescription').prop("disabled", false); 
				$('#itemCategoryName').prop("disabled", false); 
				$('#itemAge').attr("disabled", false); 
				
				$('#itemSizeName').attr("disabled", true); 
				$('#itemColorName').attr("disabled", true); 
				$('#itemPrice').attr("disabled", true); 
				$('#itemStock').attr("disabled", true); 
				$('#itemImage').attr("disabled", false); 
            }
            else if($(this).prop("checked") == false){	
				for(let idx = 0; idx < countData; idx++){
		            if(itemList[idx]['itemID'] == $( "#itemID option:selected" ).text()){	
						$('#itemName').val(itemList[idx]['itemName']);
						$('#itemDescription').val(itemList[idx]['itemDescription']);
						$('#itemCategoryName').val(itemList[idx]['itemCategoryID']);
						$('#itemAge').val(itemList[idx]['itemAge']);
						$('#itemImageSrc').attr('src', itemList[idx]['itemImage']);	
						break;
					}
				}
            	$("#itemID").prop("disabled", false); 
				$('#itemName').prop("disabled", true); 
				$('#itemDescription').prop("disabled", true); 
				$('#itemCategoryName').prop("disabled", true); 
				$('#itemAge').attr("disabled", true); 

				$('#itemSizeName').attr("disabled", false); 
				$('#itemColorName').attr("disabled", false); 
				$('#itemPrice').attr("disabled", false); 
				$('#itemStock').attr("disabled", false); 
				$('#itemImage').attr("disabled", true); 
            }
        });
    });

    function getItemData(){		
        for(let idx = 0; idx < countData; idx++){
			console.log(itemList[idx]['itemID']);
            if(itemList[idx]['itemID'] == $( "#itemID option:selected" ).text()){
                $('#itemName').val(itemList[idx]['itemName']);
                $('#itemDescription').val(itemList[idx]['itemDescription']);
                $('#itemCategoryName').val(itemList[idx]['itemCategoryID']);
                $('#itemAge').val(itemList[idx]['itemAge']);
                $('#itemImageSrc').attr('src', itemList[idx]['itemImage']);
				break;
            }
        }

        // $('#itemName').attr("disabled", true); 
        // $('#itemDescription').attr("disabled", true); 
        // $('#itemCategoryName').attr("disabled", true); 
        // $('#itemAge').attr("disabled", true); 
    }
</script>
