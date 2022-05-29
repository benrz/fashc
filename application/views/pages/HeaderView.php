<?php 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user = $data['user']['name'];
?>
<div class="header-top-furniture wrapper-padding-2 res-header-sm">
	<div class="container-fluid">
		<div class="header-bottom-wrapper">
			<div class="logo-2 furniture-logo ptb-30">
				<a href="<?php echo base_url();?>">
					<img src="<?= base_url('assets/img/logo/fashcLogo.png') ?>" style="width: 180px; height: auto;" alt="">
				</a>
			</div>
			<div class="menu-style-2 furniture-menu menu-hover">
				<nav>
					<ul>
						<?php
							if($this->uri->segment(1) == NULL) {
								echo "<li><a href='".base_url()."'>home</a></li>";
								echo "<li><a href='#allproduct'>Product</a></li>";
								echo "<li><a href='#flashsale'>Flash Sale</a></li>";
								echo "<li><a href='#contact'>contact</a></li>";
								if($this->session->userdata('email')){
									echo "<li><a href='".base_url('customer/trackOrder')."'>My Order</a></li>";
								}
							}
							else
							{
								echo "<li><a href='".base_url()."'>home</a></li>";
								echo "<li><a href='".base_url()."#allproduct'>Product</a></li>";
								echo "<li><a href='".base_url()."#flashsale'>Flash Sale</a></li>";
								echo "<li><a href='".base_url()."#contact'>contact</a></li>";
								if($this->session->userdata('email')){
									echo "<li><a href='".base_url('customer/trackOrder')."'>My Order</a></li>";
								}
							}
						?>
					</ul>
				</nav>
			</div>
			
			<?php
				if($this->uri->segment(1) != 'ShoppingCartController' && $this->uri->segment(1) != 'customer' ) {
					echo "<div class='header-cart'>";
						echo "<a class='icon-cart-furniture' href=''>";
							echo "<i class='ti-shopping-cart'></i>";
							echo "<span class='shop-count-furniture green' id='logoQuantity'>";
								echo count($shoppingCartList);
							echo "</span>";
						echo "</a>";
						echo "<ul class='cart-dropdown'>";
							echo "<script>";
								echo "var shoppingCartList = ". json_encode($shoppingCartList) .";";
								echo "var countData = ".count($shoppingCartList).";";
								echo "console.log(shoppingCartList)";
							echo "</script>";
							
							foreach($shoppingCartList as $shoppingList){   
								echo "<li class='single-product-cart' id='cart".$shoppingList['shoppingcartID']."'>";
									echo"<div class='cart-img'>";
										echo "<img src='".base_url().$shoppingList['itemImage']."' style='widht: 85px; height: 101px;'></<img>";
									echo "</div>";
									echo "<div class='cart-title'>";
										echo "<h5>".$shoppingList['itemName']."<h5>";
										echo "<h6>".$shoppingList['itemColorName']." - ".$shoppingList['itemSizeName']."</h6>";
										echo "<span id='itemQuantityView".$shoppingList['shoppingcartID']."'>".$shoppingList['itemQuantity']."</span>";
										echo "<span id='itemPriceView".$shoppingList['shoppingcartID']."'>".$shoppingList['itemPrice']*$shoppingList['itemQuantity']."</span>";
									echo "</div>";
									echo "<div class='cart-delete'>";
									//onclick='deleteSelectedItem(".$shoppingList['itemDetailID'].",".$shoppingList['shoppingcartID'].")'
										echo "<button onclick='deleteSelectedItem(".$shoppingList['itemDetailID'].",".$shoppingList['shoppingcartID'].")'><i class='ti-trash'></i></button>";
									echo "</div>";
								echo "</li>";
									
							}
							if(count($shoppingCartList) > 0){
								echo "<li class='cart-btn-wrapper'>";
									echo "<a class='cart-btn btn-hover' href='".site_url('ShoppingCartController')."'>view cart</a>";
									echo "<a class='cart-btn btn-hover' href='".site_url('customer/checkout')."'>checkout</a>";
								echo "</li>";
							}
							else{
								echo "<li class='cart-btn-wrapper'>";
									echo "Shopping cart is empty";
								echo "</li>";
							}
						echo "</ul>";
					echo "</div>";
				}
			?>
		</div>
		<div class="row">
			<div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
				<div class="mobile-menu">
					<nav id="mobile-menu-active">
						<ul class="menu-overflow">
							<?php
								if($this->uri->segment(1) == NULL) {
									echo "<li><a href='".base_url()."'>home</a></li>";
									echo "<li><a href='#allproduct'>Product</a></li>";
									echo "<li><a href='#flashsale'>Flash Sale</a></li>";
									echo "<li><a href='#contact'>contact</a></li>";
									if($this->session->userdata('email')){
										echo "<li><a href='".base_url('customer/trackOrder')."'>My Order</a></li>";
									}
								}
								else
								{
									echo "<li><a href='".base_url()."'>home</a></li>";
									echo "<li><a href='".base_url()."#allproduct'>Product</a></li>";
									echo "<li><a href='".base_url()."#flashsale'>Flash Sale</a></li>";
									echo "<li><a href='".base_url()."#contact'>contact</a></li>";
									if($this->session->userdata('email')){
										echo "<li><a href='".base_url('customer/trackOrder')."'>My Order</a></li>";
									}
								}
							?>
						</ul>
					</nav>							
				</div>
			</div>
		</div>
	</div>
</div>
<div class="header-bottom-furniture wrapper-padding-2 border-top-3">
	<div class="container-fluid">
		<div class="furniture-bottom-wrapper">
			<div class="furniture-login">
				<ul>
					<?php
						if($this->session->userdata("email")){
							echo "<li>Get Access: <a href='".base_url()."index.php/Auth/logout'>Logout </a></li>";
						}
						else{
							echo "<li>Get Access: <a href='".base_url()."index.php/Auth'>Login </a></li>";
							echo "<li><a href='".base_url()."index.php/Auth/register'>Reg </a></li>";
						}
					?>
				</ul>
			</div>
			<div class="furniture-search">
				<form action="<?php echo base_url();?>index.php/SearchPageController/search" method="post">
					<input name="userInput" placeholder="I am Searching for . . ." type="text">
					<button>
						<i class="ti-search"></i>
					</button>
				</form>
			</div>
			<div class="furniture-wishlist">
				<ul>
					<?= $this->session->flashdata('message'); ?>
					<?php 
						echo "<li><a href='".base_url()."index.php/auth/profile'><i class=''></i>".$user."</a></li>"; 
					?>
					<!-- <li><a data-toggle="modal" data-target="#exampleCompare" href="#"><i class="ti-reload"></i> Login</a></li>
					<li><a href="wishlist.html"><i class="ti-heart"></i> Register</a></li> -->
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	function deleteSelectedItem(itemDetailID, shoppingcartID){
		event.preventDefault();
        var itemQuantity = parseInt(document.getElementById('itemQuantityView'+shoppingcartID).innerHTML);
        var logoQuantity = parseInt(document.getElementById('logoQuantity').textContent);
		
		document.getElementById('logoQuantity').innerHTML = logoQuantity-1;
		$('#cart'+shoppingcartID).remove();

		$.ajax({
			url: "<?php echo site_url('/ShoppingCartController/deleteCart'); ?>",
			type: "POST",
			data: {
				itemDetailID: itemDetailID,
				shoppingCartID: shoppingcartID,
				itemQuantity: itemQuantity,
			},             
		})
	}

</script>
