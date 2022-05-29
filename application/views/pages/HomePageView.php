<!DOCTYPE html>
<html class="no-js" lang="en">
<style>
	html {
		scroll-behavior: smooth;
	}
</style>
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
	<header>
		<?php echo $HeaderView;?>
	</header>
    

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

	<div class="slider-area">
		<div class="slider-active owl-carousel">
		<?php echo "<div class='single-slider-4 slider-height-6 bg-img' style='background-image: url(".base_url()."assets/img/slider/21.jpg)'>"?>
				<div class="container">
					<div class="row">
						<div class="ml-auto col-lg-6">
							<div class="furniture-content fadeinup-animated">
								<h2 class="animated">Comfort  <br>Collection.</h2>
								<p class="animated">Shopping has never been so easy</p>
								<a class="furniture-slider-btn btn-hover animated" href="#flashsale">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo "<div class='single-slider-4 slider-height-6 bg-img' style='background-image: url(".base_url()."assets/img/slider/22.jpg)'>"?>
				<div class="container">
					<div class="row">
						<div class="ml-auto col-lg-6">
							<div class="furniture-content fadeinup-animated">
								<h2 class="animated">Comfort  <br>Collection.</h2>
								<p class="animated">Shopping has never been so easy</p>
								<a class="furniture-slider-btn btn-hover animated" href="#flashsale">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- product area start -->
	<div class="product-area pb-95 pt-120" id="flashsale">
		<div class="container">
			<div class="section-title-3 text-center mb-50">
				<h2>FLASH SALE</h2>
			</div>
			<div class="product-style">
				<div class="related-product-active owl-carousel">
					<?php
						date_default_timezone_set("Asia/Jakarta");
						$flashSaleFound = 0;
						$dateFlashSale = $flashSales[0]['flashSaleDate'];
						$timeStart = $flashSales[0]['flashSaleStartTime'];
						$timeEnd = $flashSales[0]['flashSaleEndTime'];
						
						foreach($flashSales as $flashSale){
						    if($flashSale['flashSaleDate'] <= $dateFlashSale){
						        if($flashSale['flashSaleStartTime'] <= $timeStart){
            						$dateFlashSale = $flashSale['flashSaleDate'];
            						$timeStart = $flashSale['flashSaleStartTime'];
            						$timeEnd = $flashSale['flashSaleEndTime'];
						        }    
						    }
						    
							if($flashSale['flashSaleStartTime'] <= date('H:i:s') && $flashSale['flashSaleEndTime'] > date('H:i:s')){
						        $flashSaleFound = 1;
						
								$flashSaleID = $flashSale['itemID']; //ID barang
								$flashSaleName = $flashSale['itemName']; //Nama barang
								$flashSaleImage = $flashSale['itemImage']; //Gambar barang
								$flashSaleRating = $flashSale['itemRating']; //Rating barang (Frontend: 5 Bintang kuning &/ abu)
								$flashSaleDescription = $flashSale['itemDescription']; //Frekuensi barang diakses customer
								$flashSaleDiscount = $flashSale['itemDiscount']; //Discount per barang
								$customerLikes = FALSE;
								$flashSalePrice = 0;
								
								if($flashSale['itemMinPrice'] != $flashSale['itemMaxPrice']){
									$flashSalePrice = $flashSale['itemMinPrice'] . ' ~ ' . $flashSale['itemMaxPrice'];
								}
								else{
									$flashSalePrice = $flashSale['itemMinPrice'];
								}

								foreach($customerLikedItems as $customerLikedItem){
									if($customerLikedItem['itemID'] == $flashSaleID){
										$customerLikes = TRUE;
										break;
									}
								}
								
								echo "<div class='product-wrapper'>";
									echo "<div class='product-img'>";
										echo "<img src='".base_url()."$flashSaleImage' alt=''>";
										//echo "<span>hot</span>";
										echo "<div class='product-action'>";
											echo "<a class='animate-left' title='Wishlist'>";
												echo "<i class='pe-7s-like'></i>";
											echo "</a>";
											echo "<a class='animate-top' title='Add To Cart' href='#'>";
												echo "<i class='pe-7s-cart'></i>";
											echo "</a>";
											echo "<a class='animate-right' title='Quick View' data-toggle='modal' data-target='#exampleModal' href='#'>";
												echo "<i class='pe-7s-look'></i>";
											echo "</a>";
										echo "</div>";
									echo "</div>";
									echo "<div class='product-content'>";
										echo "<h4><a href='".base_url()."ProductPageController/index/$flashSaleID'>$flashSaleName</a></h4>";
										echo "<span>$flashSalePrice</span>";
									echo "</div>";
								echo "</div>";
							}
						}
						
						if(!$flashSaleFound){
						    echo "<p style='text-align: center;'>";
						    echo "Sorry there is no Flash Sale available at this moment. Stay tune for the next Flash Sale On ".date('l, d F Y', strtotime($dateFlashSale)).', '.date('H:i',strtotime($timeStart)).' - '.date('H:i',strtotime($timeEnd)).'.';
						    echo "</p>";
						}
						
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- product area end -->

	<!-- product area start -->
	<div class="product-style-area pt-120" id="allproduct">
		<div class="coustom-container-fluid">
			<div class="section-title-7 text-center">
				<h2>All Products</h2>
			</div>
			<div class="shop-page-wrapper shop-page-padding ptb-100">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<div class="shop-sidebar mr-50">
								<div class="sidebar-widget mb-50">
									<h3 class="sidebar-title">Search Products</h3>
									<div class="sidebar-search">
										<form action="<?php echo base_url();?>SearchPageController/search" method="post">
											<input placeholder="Search Products..." type="text">
											<button><i class="ti-search"></i></button>
										</form>
									</div>
								</div>
								<div class="sidebar-widget mb-45">
									<h3 class="sidebar-title">Categories</h3>
									<div class="sidebar-categories">
										<ul>
											<?php
												foreach($itemCategory as $category){
													echo "<li>";
														$categoryID = $category['itemCategoryID'];
														$categoryName = $category['itemCategoryName'];
														
														if($categoryID == 'IC004'){
															echo "<a href='".base_url()."CategoryPageController/index/$categoryName/'>Celana Pendek</a>";
														}
														else{
															echo "<a href='".base_url()."CategoryPageController/index/$categoryName/'>$categoryName</a>";
														}
													echo "</li>";
												}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- All Product -->
						<div class="col-lg-9">
							<div class="shop-product-wrapper res-xl res-xl-btn">
								<div class="shop-bar-area">
									<!-- <div class="shop-bar pb-60">
										<div class="shop-found-selector">
											<div class="shop-found">
												<p><span>23</span> Product Found of <span>50</span></p>
											</div>
										</div>
									</div> -->
									<div class="shop-product-content tab-content">
										<div id="grid-sidebar1" class="tab-pane fade active show">
											<div class="row">
												<?php
													foreach($itemAll as $item){
														$itemID = $item['itemID'];
														$itemName = $item['itemName'];
														$itemImage = $item['itemImage'];
														$itemLike = $item['itemLike'];
														$itemRating = $item['itemRating'];
														$itemView = $item['itemView'];
														$itemDiscount = $item['itemDiscount'];
														$itemDescription = $item['itemDescription'];
														$customerLikes = FALSE;
														
														if($item['itemMinPrice'] != $item['itemMaxPrice']){
															$itemPrice = $item['itemMinPrice'] . ' ~ ' . $item['itemMaxPrice'];
														}
														else{
															$itemPrice = $item['itemMinPrice'];
														}

														// Apabila tombol diklik, akan pindah halaman kategori yang dipilih
														// if($count == count($itemCategory)){
														// 	echo "<tr>";

														// }
														// else if($count == count($itemCategory)/2){           
														// 	echo "</tr>";
														// 	echo "<tr>";
														// }
														// echo "<td>";
															// Love Button
															// Cek dulu user sudah login atau blm. Klw udah, ganti tulisan "18" dg user_id
														foreach($customerLikedItems as $customerLikedItem){
															if($customerLikedItem['itemID'] == $itemID){
																$customerLikes = TRUE;
																break;
															}
														}

														echo "<div class='col-lg-6 col-md-6 col-xl-3'>";
															echo "<div class='product-wrapper mb-30'>";
																echo "<div class='product-img'>";
																	echo "<a href='".base_url()."ProductPageController/index/$itemID'>";
																		echo "<img src='". base_url() ."$itemImage'>";
																	echo "</a>";
																	// echo "<span>hot</span>";
																	echo "<div class='product-action'>";
																		echo "<a class='animate-left' title='Wishlist' >";
																			if($customerLikes && $user_id != NULL){
																				echo "<i id='likeButton".$itemID."' class='pe-7s-like' style='color:red;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></i>";
																				// echo "<button id='likeButton' onclick='deleteLikeFunction(".$itemID.",\"".$user_id."\")'>Red Love</button>";
																			}
																			else{
																				echo "<i id='likeButton".$itemID."' class='pe-7s-like' style='color: white;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></i>";
																				// echo "<button id='likeButton' onclick='addLikeFunction(".$itemID.",\"".$user_id."\")'>Plain Love</button>";
																			}
																			// echo "<i class='pe-7s-like'></i>";
																		echo "</a>";
																		echo "<a class='animate-right' title='Quick View' href='".base_url()."ProductPageController/index/$itemID'>";
																			echo "<i class='pe-7s-look'></i>";
																		echo "</a>";
																	echo "</div>";
																echo "</div>";
																echo "<div class='product-content'>";
																	echo "<h4><a href='".base_url()."ProductPageController/index/$itemID'>$itemName</a></h4>";
																	echo "<span>$itemPrice</span>";
																echo "</div>";
															echo "</div>";
														echo "</div>";
													}
												?>
											</div>
										</div>

										<div id="grid-sidebar2" class="tab-pane fade">
											<div class="row">
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/1.jpg" alt="">
															</a>
															<span>hot</span>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Dagger Smart Trousers</a></h4>
																<span>$150.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/2.jpg" alt="">
															</a>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Homme Tapered Smart</a></h4>
																<span>$180.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/3.jpg" alt="">
															</a>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Skinny Jeans Terry</a></h4>
																<span>$130.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/4.jpg" alt="">
															</a>
															<span>new</span>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Navy Bird Print</a></h4>
																<span>$120.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/5.jpg" alt="">
															</a>
															<span>hot</span>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Leg Smart Trousers </a></h4>
																<span>$170.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-xl-6">
													<div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
														<div class="product-img list-img-width">
															<a href="#">
																<img src="assets/img/product/fashion-colorful/1.jpg" alt="">
															</a>
															<div class="product-action-list-style">
																<a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
																	<i class="pe-7s-look"></i>
																</a>
															</div>
														</div>
														<div class="product-content-list">
															<div class="product-list-info">
																<h4><a href="#">Arifo Stylas Dress</a></h4>
																<span>$190.00</span>
																<p>Lorem ipsum dolor sit amet, mana consectetur adipisicing elit, sed do eiusmod tempor labore. </p>
															</div>
															<div class="product-list-cart-wishlist">
																<div class="product-list-cart">
																	<a class="btn-hover list-btn-style" href="#">add to cart</a>
																</div>
																<div class="product-list-wishlist">
																	<a class="btn-hover list-btn-wishlist" href="#">
																		<i class="pe-7s-like"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="pagination-style mt-30 text-center">
								<ul>
									<li><a href="#"><i class="ti-angle-left"></i></a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">...</a></li>
									<li><a href="#">19</a></li>
									<li class="active"><a href="#"><i class="ti-angle-right"></i></a></li>
								</ul>
							</div> -->
							<?php echo $pagination; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- product area end -->

	<?php 
		echo "<span id='contact'></span>";
		echo $FooterView;
	?>
	<?php
        echo $js;
	?>
</body>
</html>

<script>
    function likeFunction(itemID, user_id){
        if(user_id != ''){
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url('HomePageController/customerLikedItems'); ?>",
                type: "POST",
                data: {
                    user_id: user_id,
                    itemID: itemID
                },
                success: function(response){
                    if(response == "success"){
                        var like = document.getElementById("likeButton"+itemID);
						console.log(like.id);
                        if(like.style.color == "white"){
                            like.style.color = "red";
                        }
                        else if(like.style.color == "red"){
                            like.style.color = "white";
                        }
                    }
                    else{
                        alert('error');
                    }
                }              
            })
        }
        else{
            window.location.href="<?php echo site_url(); ?>/Auth/";
        }
    }
</script>
