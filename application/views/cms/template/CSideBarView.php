<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
		<a href="<?php echo base_url('index.php/CMSController') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Fashc</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile clearfix">
		<div class="profile_pic">
			<img src="<?php echo base_url('assets/img/admin/adminprofile.png') ?>" alt="..." class="img-circle profile_img">
		</div>
		<div class="profile_info">
			<span>Welcome,</span>
			<h2>Admin</h2>
		</div>
	</div>
	<!-- /menu profile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<div class="menu_section">
			<ul class="nav side-menu">
				<?php
					echo "<li><a href='".base_url('index.php/CMSController')."'><i class='fa fa-home'></i>Home</a>";
					echo "<li><a><i class='fa fa-cube'></i>Product<span class='fa fa-chevron-down'></span></a>";
					echo "<ul class='nav child_menu'>";
						echo "<li><a href='".site_url('CMSController/CMS/Product/Anak-Anak')."'>Child Product</a></li>";
						echo "<li><a href='".site_url('CMSController/CMS/Product/Remaja')."'>Teenager Product</a></li>";
						echo "<li><a href='".site_url('CMSController/CMS/Product/Dewasa')."'>Adult Product</a></li>";
					echo "</ul>";
					echo "</li>";
					echo "<li><a href='".site_url('CMSController/addProductView')."'><i class='fa fa-edit'></i>Add Product</a></li>";
					echo "<li><a href='".site_url('CMSController/CMS/Transaction')."'><i class='fa fa-bar-chart'></i>Transaction's Logs</a></li>";
					echo "<li><a href='".site_url('CMSController/CMS/Customer')."'><i class='fa fa-users'></i>Customer Data</a></li>";
					echo "<li><a href='".site_url('CMSController/CMS/FlashSale')."'><i class='fa fa-bolt'></i>Flash Sale Data</a></li>";
				?>
			</ul>
		</div>
	</div>
	<!-- /sidebar menu -->
	</div>
</div>
