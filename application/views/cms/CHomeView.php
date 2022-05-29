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
			<?php
				echo $HeaderView;
				echo $SideBarView;
				echo $MainView;
				echo $FooterView;
			?>
		</div>
	</div>
	<?php echo $js; ?>
</body>
</html>
