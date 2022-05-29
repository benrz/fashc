<?php
	if (!isset($_SESSION)) session_start();

	if ($_POST) {
		$_SESSION['postdata'] = $_POST;
		unset($_POST);
		header("Location: ".$_SERVER['PHP_SELF']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Fashc</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
    <?php
        echo $css;
	?>
	<script type="text/javascript" src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js'); ?>"></script>
	
</head>
<body>
    <?php echo $HeaderView;?>

    <?php
        // any valid date in the past
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // always modified right now
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        // HTTP/1.1
        header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
        // HTTP/1.0
        header("Pragma: no-cache");
	?>
	
	<div class="cart-main-area pt-95 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="cart-heading">My Shopping Cart</h1>
					<form action="#">
						<div class="table-content table-responsive">
							<table id="shoppingCartTable">
								<thead>
									<tr>
										<th></th>
										<th>Product</th>
										<th>Variants</th>
										<th>Size</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Amount</th>
										<th>Remove</th>
									</tr>
								</thead>
								<tbody>
									<?php
										echo "<script>";
											echo "var shoppingCartList = ". json_encode($shoppingCartList) .";";
											echo "var countData = ".count($shoppingCartList).";";
											echo "console.log(shoppingCartList)";
										echo "</script>";
										
										foreach($shoppingCartList as $shoppingList){   
											echo "<tr id='shoppingCart".$shoppingList['shoppingcartID']."'>";
												echo "<td> <img src='".base_url().$shoppingList['itemImage']."'></td>";
												echo "<td>".$shoppingList['itemName']."</td>";
												echo "<td>".$shoppingList['itemColorName']."</td>";
												echo "<td>".$shoppingList['itemSizeName']."</td>";
												echo "<td id='itemPrice".$shoppingList['shoppingcartID']."'>".$shoppingList['itemPrice']."</td>";
												echo "<td> <p id='itemQuantity".$shoppingList['shoppingcartID']."'>".$shoppingList['itemQuantity']."</p> 
													<input type='submit' value='-' onclick='changeValueSelectedItem(".$shoppingList['itemDetailID'].",".$shoppingList['shoppingcartID'].",0, this)'>  
													<input type='submit' value='+' onclick='changeValueSelectedItem(".$shoppingList['itemDetailID'].",".$shoppingList['shoppingcartID'].",1, this)'></td>";
												echo "<td id='itemAmount".$shoppingList['shoppingcartID']."'>".$shoppingList['itemPrice'] * $shoppingList['itemQuantity']."</td>";
												echo "<td id='deleteOrder".$shoppingList['shoppingcartID']."' onclick='deleteSelectedItem(".$shoppingList['itemDetailID'].",".$shoppingList['shoppingcartID'].", this)'><h4 style='color:red'>X</h4></td>";
											echo "</tr>";   
										}
									?>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-5 ml-auto">
								<div class="cart-page-total">
									<h2>Cart totals</h2>
									<ul>
										<li>Total<span id="totalPrice"><?php echo $shoppingCartTotalPrice?></span></li>
									</ul>
									<a href="<?= base_url('index.php/customer/checkout')?>" class="cart_checkout">CHECKOUT</a>
									<?php
										//echo form_open('ShoppingCartController/transaction');
										// echo form_open();
											//echo form_hidden('user_id',$shoppingCartList[0]['user_id']);
											//echo form_hidden('hiddenData', '0');

											//$submitData = array(
												//'name' => 'checkOut',
												//'id' => 'checkOut',
												//'value' => 'CHECKOUT',
												//'class' => 'cart_checkout',
												//'onclick' => 'getLatestQuantity()'
											//);
											//echo form_submit($submitData);
										//echo form_close();
									?>

									<!-- <a href="#">Proceed to checkout</a> -->
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- shopping-cart-area end -->
	
    <!--  -->
	<?php echo $FooterView;?>
	<?php
		echo $js;
	?>
</body>
</html>

<script>
    function changeValueSelectedItem(itemDetailID, shoppingcartID, changeMode, row){
        var value;
        var price = parseInt(document.getElementById('itemPrice'+shoppingcartID).innerHTML);
		var totalPrice = parseInt(document.getElementById('totalPrice').innerHTML);

        if(changeMode){ 
            value = parseInt(document.getElementById('itemQuantity'+shoppingcartID).innerHTML) + 1;
       		totalPrice += price;
			updateItemDetailStock(itemDetailID, shoppingcartID, 1);				
        }
        else{
            value = parseInt(document.getElementById('itemQuantity'+shoppingcartID).innerHTML) - 1;
       		totalPrice -= price;
			updateItemDetailStock(itemDetailID, shoppingcartID, 0);			
        }
		
		document.getElementById('totalPrice').innerHTML = totalPrice;
        
		$.ajax({
			url: "<?php echo base_url('index.php/ShoppingCartController/checkItemStock'); ?>",
			type: "POST",
			data: {
				itemDetailID: itemDetailID,
				itemQuantity: changeMode,
			},
			success: function(response){
				if(response == "Sufficient"){
					document.getElementById('itemQuantity'+shoppingcartID).innerHTML = value;
					document.getElementById('itemAmount'+shoppingcartID).innerHTML = value * price;
				}
				else{
					alert(response);
				}
			}             
		})


		if(value == 0){
			var iRow = row.parentNode.parentNode.rowIndex;
			document.getElementById("shoppingCartTable").deleteRow(iRow);
			countData--;
        }

    }

	function deleteSelectedItem(itemDetailID, shoppingcartID, row){
		event.preventDefault();
        var itemQuantity = parseInt(document.getElementById('itemQuantity'+shoppingcartID).innerHTML);
        var price = parseInt(document.getElementById('itemPrice'+shoppingcartID).innerHTML);
		var totalPrice = parseInt(document.getElementById('totalPrice').innerHTML);

		totalPrice -= (itemQuantity * price);
		document.getElementById('totalPrice').innerHTML = totalPrice;

		var iRow = row.parentNode.rowIndex;
		document.getElementById("shoppingCartTable").deleteRow(iRow);
		countData--;

		$.ajax({
			url: "<?php echo base_url('index.php/ShoppingCartController/deleteCart'); ?>",
			type: "POST",
			data: {
				itemDetailID: itemDetailID,
				shoppingCartID: shoppingcartID,
				itemQuantity: itemQuantity,
			},             
		})
	}

	function updateItemDetailStock(itemDetailID, shoppingCartID, update){
            event.preventDefault();
			console.log("ITEMDETAILID: "+itemDetailID);
			console.log("shoppingCartID: "+shoppingCartID);
			console.log("UPDATE: "+update);
            $.ajax({
                url: "<?php echo base_url('index.php/ShoppingCartController/updateCart'); ?>",
                type: "POST",
                data: {
                    itemDetailID: itemDetailID,
					shoppingCartID: shoppingCartID,
					update: update,
                },             
            })
    }

    // function getLatestQuantity(){
    //     // event.preventDefault();
    //     console.log("GETLATEST");
    //     var hiddenData = {};
        
    //     for(let idx = 0; idx < countData; idx++){
    //         hiddenData[idx] = {};

	// 		hiddenData[idx]['shoppingCartID'] = shoppingCartList[idx]['shoppingcartID'];
    //         hiddenData[idx]['itemDetailID'] = shoppingCartList[idx]['itemdetailID'];
    //         hiddenData[idx]['itemQuantity'] = document.getElementById('itemQuantity'+shoppingCartList[idx]['shoppingcartID']).innerHTML;
    //     }
        
    //     $("input[name=hiddenData]").attr('value', JSON.stringify(hiddenData));
    //     console.log(hiddenData);
    // }
</script>
