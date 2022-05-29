<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php
        echo $js;
        echo $css;
    ?>
    <title>Fashc</title>
</head>
<body>
	<?php echo $header; ?>

	<div class="row justify-content-center mt-5">
		<div class="container py-md-5 py-3">
			<div class="row justify-content-around">
				<div class="col-md-4 bg-success">
					<img src="https://us.123rf.com/450wm/eugenepartyzan/eugenepartyzan1511/eugenepartyzan151100116/49030402-fashionable-little-boy-stylish-child-in-suit-fashion-children-business-kids.jpg?ver=6" class="img-fluid" alt="12">
				</div>
				<div class="col-md-8 bg-warning">
					<h2>Product Title</h2>
					<hr>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="container py-md-5 py-3">
			Comments
			<hr>
			<div class="row justify-content-around">
				<div class="col-md-6">
					<p><span class="glyphicon glyphicon-user"></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maiores facere officiis eaque? Consectetur voluptates officia eum magnam sint itaque voluptas praesentium, pariatur repellat aliquam ullam quibusdam non, hic esse.</p>
					<p><span class="glyphicon glyphicon-user"></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maiores facere officiis eaque? Consectetur voluptates officia eum magnam sint itaque voluptas praesentium, pariatur repellat aliquam ullam quibusdam non, hic esse.</p>
				</div>
				<div class="col-md-6">
					<p><span class="glyphicon glyphicon-user"></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maiores facere officiis eaque? Consectetur voluptates officia eum magnam sint itaque voluptas praesentium, pariatur repellat aliquam ullam quibusdam non, hic esse.</p>
					<p><span class="glyphicon glyphicon-user"></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maiores facere officiis eaque? Consectetur voluptates officia eum magnam sint itaque voluptas praesentium, pariatur repellat aliquam ullam quibusdam non, hic esse.</p>
				
				</div>
			</div>
		</div>
	</div>

	<div style="text-align: center;">
    <ul class="pagination">
        <!-- LINK FIRST AND PREV -->
        <!-- <li><a href="view_artikel_user.php?page=1">«</a></li>         -->
        <!-- LINK NUMBER -->
		<li><a href="#">1</a></li>
			<!-- <li><a href="view_artikel_user.php?page=1">1</a></li>
			<li><a href="view_artikel_user.php?page=2">2</a></li>       -->
        <!-- LINK NEXT AND LAST -->
        <li class="disabled"><a href="#">»</a></li>    </ul>
    </div>

	<hr class="container col-lg-11">

	<?php echo $footer; ?>
</body>
</html>
