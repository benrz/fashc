<!DOCTYPE html>
<html class="no-js" lang="en">
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
    
	<!-- Category Carousel -->
	<div class="row justify-content-center mt-5">
		<div class="container-fluid col-lg-11  product">
			<table class="table table-striped table-bordered" cellspacing="0" width="100%">
				<?php
					$count = 0;
					// Nampilin list category berupa gambar
					echo "<tr>";
					foreach($itemGroupList as $itemGroup){
						$itemID = $itemGroup['itemID']; //ID barang
						$itemName = $itemGroup['itemName']; //Nama barang
						$itemImage = $itemGroup['itemImage']; //Gambar barang
						$itemRating = $itemGroup['itemRating']; //Rating barang (Frontend: 5 Bintang kuning &/ abu)
						$itemDescription = $itemGroup['itemDescription']; //Frekuensi barang diakses customer
						$itemDiscount = $itemGroup['itemDiscount']; //Discount per barang
						$itemMinPrice = $itemGroup['itemMinPrice']; //Harga minimal yang dimiliki barang
						$itemMaxPrice = $itemGroup['itemMaxPrice']; //Harga maximal yang dimiliki barang
						$customerLikes = FALSE;

						//$itemPrice yang ditampilkan dihalaman user
						if($itemMinPrice == $itemMaxPrice){
							$itemPrice = (string)$itemMinPrice; //Apabila harga minimal == harga maksimal, ambil salah satu nilai, ubah jadi string
						}
						else{
							$itemPrice = $itemMinPrice . " ~ " . $itemMaxPrice; //Jika harga minimal != harga maksimal, gabungkan 2 harga tsb dg penghubung "~"
						}

						foreach($customerLikedItems as $customerLikedItem){
							if($customerLikedItem['itemID'] == $itemID){
								$customerLikes = TRUE;
								break;
							}
						}

						if($count % 4 == 0){
							echo "</tr>";
							echo "<tr>";
						}
						
						echo "<td class='col-3'>";
							// Apabila tombol diklik, akan pindah halaman
							echo "<img src='".base_url()."$itemImage' class='img-fluid' alt='12'>";
							echo "<div class='p-3 bg-light'>";
								if(strlen($itemName) > 20)
									echo "<p><a class='product_name' href='".base_url()."index.php/ProductPageController/index/$itemID/". html_escape($itemName)."'>".substr($itemName, 0, 20). '...' ."</a></p>";
								else
									echo "<p><a class='product_name' href='".base_url()."index.php/ProductPageController/index/$itemID/". html_escape($itemName)."'>".substr($itemName, 0, 20)."</a></p>";
								echo "<div class='mb-3'>";
									for($i=0; $i<5; $i++){
										if($i<$itemRating){
											echo "<span class='fa fa-star' style='color: orange;'></span>";
										}
										else{
											echo "<span class='fa fa-star' style='color: orange;'></span>";
										}		
									}
								echo"</div>";
								if(strlen($itemName) > 30)
									echo "<p style='color:black'>".substr($itemDescription, 0, 30). '...' ."</p>";
								else
									echo "<p style='color:black'>".substr($itemDescription, 0, 30)."</p>";
								echo "<p style='color:black'>$itemPrice</p>";

								
								echo "<span class='glyphicon glyphicon-share mr-5' style='color:black'></span>";
								$user_id = 18;

								if($customerLikes){
									echo "<span id='likeButton".$itemID."' class='glyphicon glyphicon-heart' style='color:red;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></span>";
									// echo "<button id='likeButton' onclick='deleteLikeFunction(".$itemID.",\"".$user_id."\")'>Red Love</button>";
								}
								else{
									echo "<span id='likeButton".$itemID."' class='glyphicon glyphicon-heart' style='color: black;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></span>";
									// echo "<button id='likeButton' onclick='addLikeFunction(".$itemID.",\"".$user_id."\")'>Plain Love</button>";
								}
							echo "</div>";
						echo "</td>";
						$count++; 
					}
					echo "</tr>";
				?>
			</table>
		</div>
	</div>

    <!--  -->
	<?php echo $FooterView;?>
	<?php
        echo $js;
	?>
</body>
</html>

<script>
    function likeFunction(itemID, user_id){
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url('index.php/HomePageController/customerLikedItems'); ?>",
                type: "POST",
                data: {
                    user_id: user_id,
                    itemID: itemID
                },
                success: function(response){
                    if(response == "success"){
                        var like = document.getElementById("likeButton"+itemID);
						console.log(like.id);
                        if(like.style.color == "black"){
                            like.style.color = "red";
                        }
                        else if(like.style.color == "red"){
                            like.style.color = "black";
                        }
                    }
                    else{
                        alert('error');
                    }
                }              
            })
    }
</script>
