<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Fashc - Product Detail</title>
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
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- header start -->
        <header>
			<?php echo $HeaderView;?>
        </header>
        <!-- header end -->

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

		<!-- <div class="breadcrumb-area pt-205 pb-210" style="background-image: url(assets/img/bg/breadcrumb.jpg)">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2>product details</h2>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li> product details </li>
                    </ul>
                </div>
            </div>
        </div> -->

        <?php
			echo "<script>";
			echo "var itemDetailList = ". json_encode($itemDetails) .";";
			echo "console.log(itemDetailList);";
            echo "</script>";
            
            $itemID = $itemDetails[0]['itemID'];
            $itemsImage = $itemDetails[0]['itemImage'];
            $itemsName = $itemDetails[0]['itemName'];
            $itemsRating = $itemDetails[0]['itemRating'];
            $itemsDescription = $itemDetails[0]['itemDescription'];
			$itemsView = $itemDetails[0]['itemView'];
			$customerLikes = FALSE;

            echo "<div class='product-details ptb-100 pb-90'>";
                echo "<div class='container'>";
                    echo "<div class='row'>";
                        echo "<div class='col-md-12 col-lg-7 col-12'>";
                            echo "<div class='product-details-img-content'>";
                                echo "<div class='product-details-tab mr-70'>";
                                    echo "<div class='product-details-large tab-content'>";
                                        echo "<div class='tab-pane active show fade' id='pro-details1' role='tabpanel'>";
                                            echo "<div class='easyzoom easyzoom--overlay'>";
                                                echo "<a href='".base_url()."$itemsImage'>";
                                                    echo "<img src='".base_url()."$itemsImage' alt=''>";
                                                echo "</a>";
                                            echo "</div>";
                                        echo "</div>";
                                        // echo "<div class='tab-pane fade' id='pro-details2' role='tabpanel'>";
                                        //     echo "<div class='easyzoom easyzoom--overlay'>";
                                        //         echo "<a href='".base_url()."assets/img/product-details/bl2.jpg'>";
                                        //             echo "<img src='".base_url()."assets/img/product-details/l2.jpg' alt=''>";
                                        //         echo "</a>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                        // echo "<div class='tab-pane fade' id='pro-details3' role='tabpanel'>";
                                        //     echo "<div class='easyzoom easyzoom--overlay'>";
                                        //         echo "<a href='".base_url()."assets/img/product-details/bl3.jpg'>";
                                        //             echo "<img src='".base_url()."assets/img/product-details/l3.jpg' alt=''>";
                                        //         echo "</a>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                        // echo "<div class='tab-pane fade' id='pro-details4' role='tabpanel'>";
                                        //     echo "<div class='easyzoom easyzoom--overlay'>";
                                        //         echo "<a href='".base_url()."assets/img/product-details/bl4.jpg'>";
                                        //             echo "<img src='".base_url()."assets/img/product-details/l4.jpg' alt=''>";
                                        //         echo "</a>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                    echo "</div>";

                                    // echo "<div class='product-details-small nav mt-12' role=tablist>";
                                    //     echo "<a class='active mr-12' href='#pro-details1' data-toggle='tab' role='tab' aria-selected='true'>";
                                    //         echo "<img src='".base_url()."assets/img/product-details/s1.jpg' alt=''>";
                                    //     echo "</a>";
                                    //     echo "<a class='mr-12' href='#pro-details2' data-toggle='tab' role='tab' aria-selected='true'>";
                                    //         echo "<img src='".base_url()."assets/img/product-details/s2.jpg' alt=''>";
                                    //     echo "</a>";
                                    //     echo "<a class='mr-12' href='#pro-details3' data-toggle='tab' role='tab' aria-selected='true'>";
                                    //         echo "<img src='".base_url()."assets/img/product-details/s3.jpg' alt=''>";
                                    //     echo "</a>";
                                    //     echo "<a class='mr-12' href='#pro-details4' data-toggle='tab' role='tab' aria-selected='true'>";
                                    //         echo "<img src='".base_url()."assets/img/product-details/s4.jpg' alt=''>";
                                    //     echo "</a>";
                                    // echo "</div>";

                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-12 col-lg-5 col-12'>";
                            echo "<div class='product-details-content'>";
                                echo "<h3>$itemsName</h3>";
                                echo "<div class='rating-number'>";
                                    echo "<div class='quick-view-rating'>";
                                        for($i=0; $i<5; $i++){
                                            if($i<$itemsRating){
                                                //echo "<i class='pe-7s-star red-star'></i>";
                                                echo "<span class='fa fa-star pr-1' style='color: orange;'></span>";
                                            }
                                            else if($itemsRating%1 != 0){
                                                echo "<span class='fa fa-star pr-1' style='color: orange;'></span>";
                                            }
                                            else{
                                                echo "<span class='fa fa-star pr-1'></span>";
                                            }		
                                        }
                                        // echo "<i class='pe-7s-star red-star'></i>";
                                        // echo "<i class='pe-7s-star red-star'></i>";
                                        // echo "<i class='pe-7s-star'></i>";
                                        // echo "<i class='pe-7s-star'></i>";
                                        // echo "<i class='pe-7s-star'></i>";
                                    echo "</div>";
                                    echo "<div class='quick-view-number'>";
                                        echo "<span>$itemsRating. Ratting (S)</span>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='details-price'>";
                                    echo "<span id='itemPrice'>". $itemDetails[0]['itemPrice'] ."</span>";
                                echo "</div>";
                                echo "<p>";
                                    echo "<p class='d-inline'>Stock: </p>";
                                    echo "<p class='d-inline' id='itemStock'>".$itemDetails[0]['itemStock']."</p>";
                                echo "</p>";
                                echo "<p>$itemsDescription</p>";
                                echo "<div class='quick-view-select'>";
                                    echo "<div class='select-option-part'>";
                                        //echo "<label>Variant*</label>";
                                        // echo "<select class='select'>";
                                        //     echo "<option value=''>- Please Select -</option>";
                                        //     foreach($itemDetails as $itemDetail){
                                        //         $itemDetailID = $itemDetail['itemDetailID'];
                                        //         $itemVariation = $itemDetail['itemColorName'] . " ~ " . $itemDetail['itemSizeName'];
                                        //         //echo "<button class='dropdown-item' id='itemVariation' onclick='selectedVariation($itemDetailID)'>$itemVariation</button>";
                                        //         echo "<option value='itemVariation' id='itemVariation' onclick='selectedVariation($itemDetailID)'>$itemVariation</option>";      
                                        //     }
                                        // echo "</select>";
                                        echo "<div class='btn-group'>";
                                            echo "<button type='button' class='btn btn-light'>Variant</button>";
                                            echo "<button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                                                echo "<span class='sr-only'>Toggle Dropdown</span>";
                                            echo "</button>";
                                            echo "<div class='dropdown-menu'>";
                                                foreach($itemDetails as $itemDetail){
                                                    $itemDetailID = $itemDetail['itemDetailID'];
                                                    $itemVariation = $itemDetail['itemColorName'] . " ~ " . $itemDetail['itemSizeName'];
                                                    echo "<button class='dropdown-item' id='itemVariation' onclick='selectedVariation($itemDetailID)'>$itemVariation</button>";
                                                }
                                            echo"</div>";
                                        echo"</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='quickview-plus-minus'>";
                                    echo "<div>";
                                        echo form_open('ShoppingCartController/index');
                                        //echo form_open('customer/shoppingcart');
                                            $itemData = array(
                                                // 'itemNameHidden' => $itemDetails[0]['itemName'],
                                                'itemDetailIDHidden' => $itemDetails[0]['itemDetailID'],
                                                // 'user_id' => 18
                                            );
                                            echo form_hidden($itemData);
                                            
                                            $itemQuantity = array(
                                                'type' => 'text',
                                                'name' => 'itemQuantityHidden',
                                                'id' => 'itemQuantityHidden',
                                                'value' => 1,
                                                // 'disabled' => TRUE
                                                //Cara atur min, max, sm huruf apa aja yg bs?
                                            );
                                            echo form_input($itemQuantity);
            
                                            echo "<button type='button' class='btn btn-light' onclick='increaseQuantity(this)' style='border-radius: 15px 0px 0px 15px; width: 50px; height: 30px; padding: 0px;'>+</button>";
                                            echo "<button type='button' class='btn btn-light' onclick='decreaseQuantity(this)' style='border-radius: 0px 15px 15px 0px; width: 50px; height: 30px; padding: 0px;'>-</button>";
            
                                            // Cobain apakah form hidden keganti datanya menggunakan JQUERY
                                            // echo "<br> Ini Nama: ".form_input('itemNameHidden', $itemDetails[0]['itemName']);
                                            // echo "<br> Ini Harga: ".form_input('itemPriceHidden', $itemDetails[0]['itemPrice']);
                                            // echo "<br> Ini Stock: ".form_input('itemStockHidden', $itemDetails[0]['itemStock']);
                                            // echo "<br> Ini Warna: ".form_input('itemColorHidden', $itemDetails[0]['itemColorName']);
                                            // echo "<br> Ini Size: ".form_input('itemSizeHidden', $itemDetails[0]['itemSizeName']);
                                    echo "</div>";
                                    echo "<div class='quickview-btn-cart'>";
                                            //echo "<a class='btn-hover-black' href='#'>add to cart</a>";
                                            echo form_submit(array(
                                                'name' => 'submit', 
                                                'value' => 'add to cart', 
                                                'class' => 'btnaddtocart'
                                            ));
                                        echo form_close();
									echo "</div>";
									
									foreach($customerLikedItems as $customerLikedItem){
										if($customerLikedItem['itemID'] == $itemID){
											$customerLikes = TRUE;
											break;
										}
									}

									echo "<div class='quickview-btn-wishlist bg-dark'>";
										if($customerLikes){
											echo "<a class='btn-hover'><i id='likeProductButton".$itemID."' class='pe-7s-like' style='color:red;' onclick='likeProductFunction(".$itemID.",\"".$user_id."\")'></i></a>";
											// echo "<button id='likeButton' onclick='deleteLikeFunction(".$itemID.",\"".$user_id."\")'>Red Love</button>";
										}
										else{
											echo "<a class='btn-hover'><i id='likeProductButton".$itemID."' class='pe-7s-like' style='color: white;' onclick='likeProductFunction(".$itemID.",\"".$user_id."\")'></i></a>";
											// echo "<button id='likeButton' onclick='addLikeFunction(".$itemID.",\"".$user_id."\")'>Plain Love</button>";
										}

                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='product-details-cati-tag mt-35 mb-10'>";
                                    echo "<ul>";
                                        echo "<li class='categories-title'>Categories :</li>";
                                        foreach($itemCategory as $category){
                                            echo "<li>";
                                                $categoryID = $category['itemCategoryID'];
                                                $categoryName = $category['itemCategoryName'];
                                                
                                                echo "<a href='".base_url()."index.php/CategoryPageController/index/$categoryName/'>$categoryName</a>";
                                            echo "</li>";
                                        }    
                                    echo "</ul>";
                                echo "</div>";
                                // echo "<div class='product-details-cati-tag mtb-10'>";
                                //     echo "<ul>";
                                //         echo "<li class='categories-title'>Tags :</li>";
                                //         echo "<li><a href='#'>fashion</a></li>";
                                //         echo "<li><a href='#'>electronics</a></li>";
                                //         echo "<li><a href='#'>toys</a></li>";
                                //         echo "<li><a href='#'>food</a></li>";
                                //         echo "<li><a href='#'>jewellery</a></li>";
                                //     echo "</ul>";
                                // echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        ?>

		<div class="product-description-review-area">
			<div class="container">
				<div class="product-description-review">
					<div class="description-review-title nav" role=tablist>
						<a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
							Description
						</a>
						<a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
							Reviews
						</a>
					</div>
					<div class="description-review-text tab-content">
						<div class="tab-pane active show fade text-center" id="pro-dec" role="tabpanel">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
						</div>
						<div class="tab-pane fade" id="pro-review" role="tabpanel">
							<!-- <a href="#">Be the first to write your review!</a> -->
							<div class="container">
								<div class="bg-light text-center">
									<span>
										<br>
										<!-- AVERAGE RATING -->
										<?php
										foreach ($rating_comment as $ratings_comment) {
											if ($ratings_comment == NULL) {
												$ratings_comment = 5.0;
											}
											echo "<h1>" . (float)$ratings_comment . " / 5.0 </h1>";

											for ($i = 0; $i < $ratings_comment; $i++) {
												echo '<span class="fa fa-star faa-tada animated fa-3x checked" style="size: 100pt; color:orange; "> </span>';
												echo "  ";
											}

											for ($i = 4; $i >= $ratings_comment; $i--) {
												echo '<span class="fa fa-star-o fa-3x"></span>';
												echo "  ";
											}
										}
										?>
										<br><br>
									</span>
								</div>
							</div>
							<br>
							<div class="container mb-3">
								<?php
								$i = 0;
								foreach ($comment as $comments) :
									if ($i % 3 == 0)
										echo '<div class="card col-12" style="background-color:#e8f7ff;">';
									else if ($i % 3 == 1)
										echo '<div class="card col-12" style="background-color:#fcffce;">';
									else
										echo '<div class="card col-12" style="background-color:#c6ffa9;">';
									?>
									<div class="card-body" style="font-size: 18px;">
										<b><?php echo $comments->CommentName ?></b>
										<br><?php
												for ($i = 0; $i < $comments->itemRating; $i++) {
													echo '<span class="fa fa-star checked" style="color: orange;"></span>';
												}
												for ($i = 4; $i >= $comments->itemRating; $i--) {
													echo '<span class="fa fa-star" style="color: black;"></span>';
												}
												?>
										<br><?php echo "<p style='float:left;'>" . $comments->CommentIsi . "</p>" ?>
									</div>
							</div>
						<?php $i++;
						endforeach; ?>
						</div>

						<br>
						<div class="container">
							<div class="bg-light">
								<div class="p-3" style="background-color: darkgray;">
									<center>
										<h4><b>Kolom Komentar</b></h4>
									</center>
								</div>
								<form class="form-control" style="font-size: 18px;" method="POST" action="<?php echo site_url('ProductPageController/kirimKomen/' . $itemDetails[0]['itemID']) ?>">
									<br>

									<div class="row">
										<div class="col-12">
											<div class="col-6">
												<input class="form-group" type="text" placeholder="Nama" name="nama" required>
											</div>
											<div class="col-6">
												<input class="form-group" type="number" step="0.5" min="0" max="5" placeholder="Rating" name="rating" required>
											</div>
										</div>
									</div>
									<div class="col-12">
										<input class="form-group" type="email" placeholder="Email" name="email" required>
									</div>
									<div class="col-12">
										<textarea name="isi_komentar" placeholder="Komentar"></textarea>
									</div>
									<div class="col-12 text-center">
										<br>
										<button class="btn btn-primary mb-3" type="submit">Kirim Komentar</button>
									</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

        <!-- product area start -->
        <div class="product-area pb-95" style="padding-top: 100px;">
            <div class="container">
                <div class="section-title-3 text-center mb-50">
                    <h2>Related products</h2>
                </div>
                <div class="product-style">
                    <div class="related-product-active owl-carousel">
                        <?php
                            foreach($relatedItem as $itemGroup){
                                $itemID = $itemGroup['itemID']; //ID barang
                                $itemName = $itemGroup['itemName']; //Nama barang
                                $itemImage = $itemGroup['itemImage']; //Gambar barang
                                $itemRating = $itemGroup['itemRating']; //Rating barang (Frontend: 5 Bintang kuning &/ abu)
                                $itemDescription = $itemGroup['itemDescription']; //Frekuensi barang diakses customer
                                $itemDiscount = $itemGroup['itemDiscount']; //Discount per barang
                                $itemMinPrice = $itemGroup['itemMinPrice']; //Harga minimal yang dimiliki barang
                                $itemMaxPrice = $itemGroup['itemMaxPrice']; //Harga maximal yang dimiliki barang
								$customerLikes = FALSE;
								
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
                                
                                echo "<div class='product-wrapper'>";
                                    echo "<div class='product-img'>";
                                        echo "<img src='".base_url($itemImage)."' alt=''>";
                                        //echo "<span>hot</span>";
                                        echo "<div class='product-action'>";
											echo "<a class='animate-left' title='Wishlist' href='#'>";
												if($customerLikes){
													echo "<i id='likeButton".$itemID."' class='pe-7s-like' style='color:red;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></i>";
													// echo "<button id='likeButton' onclick='deleteLikeFunction(".$itemID.",\"".$user_id."\")'>Red Love</button>";
												}
												else{
													echo "<i id='likeButton".$itemID."' class='pe-7s-like' style='color: white;' onclick='likeFunction(".$itemID.",\"".$user_id."\")'></i>";
													// echo "<button id='likeButton' onclick='addLikeFunction(".$itemID.",\"".$user_id."\")'>Plain Love</button>";
												}
                                                //echo "<i class='pe-7s-like'></i>";
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
                                        echo "<h4><a href='".base_url()."index.php/ProductPageController/index/$itemID/". html_escape($itemName)."'>$itemName</a></h4>";
                                        echo "<span>$itemPrice</span>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- product area end -->

		<!-- modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="pe-7s-close" aria-hidden="true"></span>
            </button>
            <div class="modal-dialog modal-quickview-width" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="qwick-view-left">
                            <div class="quick-view-learg-img">
                                <div class="quick-view-tab-content tab-content">
                                    <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                        <img src="assets/img/quick-view/l1.jpg" alt="">
                                    </div>
                                    <div class="tab-pane fade" id="modal2" role="tabpanel">
                                        <img src="assets/img/quick-view/l2.jpg" alt="">
                                    </div>
                                    <div class="tab-pane fade" id="modal3" role="tabpanel">
                                        <img src="assets/img/quick-view/l3.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="quick-view-list nav" role="tablist">
                                <a class="active" href="#modal1" data-toggle="tab" role="tab">
                                    <img src="assets/img/quick-view/s1.jpg" alt="">
                                </a>
                                <a href="#modal2" data-toggle="tab" role="tab">
                                    <img src="assets/img/quick-view/s2.jpg" alt="">
                                </a>
                                <a href="#modal3" data-toggle="tab" role="tab">
                                    <img src="assets/img/quick-view/s3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="qwick-view-right">
                            <div class="qwick-view-content">
                                <h3>Handcrafted Supper Mug</h3>
                                <div class="price">
                                    <span class="new">$90.00</span>
                                    <span class="old">$120.00  </span>
                                </div>
                                <div class="rating-number">
                                    <div class="quick-view-rating">
                                        <i class="pe-7s-star"></i>
                                        <i class="pe-7s-star"></i>
                                        <i class="pe-7s-star"></i>
                                        <i class="pe-7s-star"></i>
                                        <i class="pe-7s-star"></i>
                                    </div>
                                    <div class="quick-view-number">
                                        <span>2 Ratting (S)</span>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                                <div class="quick-view-select">
                                    <div class="select-option-part">
                                        <label>Size*</label>
                                        <select class="select">
                                            <option value="">- Please Select -</option>
                                            <option value="">900</option>
                                            <option value="">700</option>
                                        </select>
                                    </div>
                                    <div class="select-option-part">
                                        <label>Color*</label>
                                        <select class="select">
                                            <option value="">- Please Select -</option>
                                            <option value="">orange</option>
                                            <option value="">pink</option>
                                            <option value="">yellow</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="quickview-plus-minus">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                    </div>
                                    <div class="quickview-btn-cart">
                                        <a class="btn-hover-black" href="#">add to cart</a>
                                    </div>
                                    <div class="quickview-btn-wishlist">
                                        <a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- modal -->
        <div class="modal fade" id="exampleCompare" tabindex="-1" role="dialog" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="pe-7s-close" aria-hidden="true"></span>
            </button>
            <div class="modal-dialog modal-compare-width" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="#">
                            <div class="table-content compare-style table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <a href="#">Remove <span>x</span></a>
                                                <img src="assets/img/cart/4.jpg" alt="">
                                                <p>Blush Sequin Top </p>
                                                <span>$75.99</span>
                                                <a class="compare-btn" href="#">Add to cart</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="compare-title"><h4>Description </h4></td>
                                            <td class="compare-dec compare-common">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has beenin the stand ard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Sku </h4></td>
                                            <td class="product-none compare-common">
                                                <p>-</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Availability  </h4></td>
                                            <td class="compare-stock compare-common">
                                                <p>In stock</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Weight   </h4></td>
                                            <td class="compare-none compare-common">
                                                <p>-</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Dimensions   </h4></td>
                                            <td class="compare-stock compare-common">
                                                <p>N/A</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>brand   </h4></td>
                                            <td class="compare-brand compare-common">
                                                <p>HasTech</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>color   </h4></td>
                                            <td class="compare-color compare-common">
                                                <p>Grey, Light Yellow, Green, Blue, Purple, Black </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>size    </h4></td>
                                            <td class="compare-size compare-common">
                                                <p>XS, S, M, L, XL, XXL </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"></td>
                                            <td class="compare-price compare-common">
                                                <p>$75.99 </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>	
		
        <?php echo $FooterView;?>
        <?php
            echo $js;
        ?>
    </body>
</html>

<script>
    function selectedVariation(itemDetailID){
        var itemPrice, itemStock, itemID;

        $.each(itemDetailList,function(i, item){
            if(item['itemDetailID'] == itemDetailID){
                itemPrice = item['itemPrice'];
                itemStock = item['itemStock'];
                itemID = item['itemDetailID'];
            }
        });
        $("input[name=itemPriceHidden]").attr('value', itemPrice);
        $("input[name=itemStockHidden]").attr('value', itemStock);
        $("input[name=itemDetailIDHidden]").attr('value', itemID);
        document.getElementById('itemPrice').innerHTML = itemPrice;
        document.getElementById('itemStock').innerHTML = itemStock;
    }

	function increaseQuantity(row) {
        var i = document.getElementById("itemQuantityHidden").value;
		var j = parseInt(document.getElementById('itemStock').innerHTML);
		if(i < j) {
            document.getElementById("itemQuantityHidden").value++;
			console.log(document.getElementById("itemQuantityHidden").value);
        }
    }

    function decreaseQuantity(row) {
        var i = document.getElementById("itemQuantityHidden").value;

        if(i > 1) {
            document.getElementById("itemQuantityHidden").value--;
        } 
        else {
            deleteProduct(row.parentNode);    
        }
    }

	
	// Membuat user tidak bisa menginput selain 0-9 apabila karakter pertama tidak kosong
	// Membuat user tidak bisa menginput selain 1-9 apabila karakter pertama kosong
	$("#itemQuantityHidden").bind("keypress", function (e) {
		var keyCode = e.which ? e.which : e.keyCode
		var quantity = document.getElementById("itemQuantityHidden").value;
		if(quantity < 1){
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

	//Membuat value dr quantity = stock apabila user menginput lebih besar dari stock yg tersedia
	$("#itemQuantityHidden").on("keypress", function(e){
		var currentValue = String.fromCharCode(e.which);
		var finalValue = $(this).val() + currentValue;
		var stock = parseInt(document.getElementById("itemStock").innerHTML);

		if(finalValue > stock){	
			document.getElementById("itemQuantityHidden").value = stock;
			e.preventDefault();
		}
	});

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

	function likeProductFunction(itemID, user_id){
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
                        var like = document.getElementById("likeProductButton"+itemID);
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

</script>

<!-- 
    Untuk Kuantitas pembalian
<script>
$(document).ready(function(){
  $("input[type=text]").change(function(){
  	if($("input[type=text]").val() >= 3000){
    alert("The text has been changed.");
    }
  });
});
</script> -->
