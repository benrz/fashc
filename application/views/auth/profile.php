<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	
	<?php
		echo $css;
	?>
	<script type="text/javascript" src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js'); ?>"></script>

    <title>Profile</title>
</head>

<body>
	<header>
		<?php echo $HeaderView;?>
	</header>
		
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 2%;">
                <div class="row">
                    <div class="col-md-4 col-sm-12" style="text-align: center; padding: 5% 0;">
                        <div style="inline-block;">
                            <img src="<?= base_url($user['image']) ?>" class="img-fluid" width="100px" height="100px" style="border-radius: 50%;">
                            <p>
                                <h4><?= $user['name']; ?></h4>
                            </p>
                            <?php
                             echo '<br>' . '<form class="form-group" method="POST" action="' . base_url("index.php/auth/updatePhoto") . '" enctype="multipart/form-data">';
                            echo '<input type="file" name="photo" id="photo">';
                            echo '<input type="hidden" name="old-photo" value="' . $user['image'] .'">';
                            echo '<input type="hidden" name="name" id="name" value="' . $user['name']. '">';
                            echo '<input type="hidden" name="email" id="email" value="' . $user['email']. '">';
                            echo "<span class='text-danger'>" . $error . "</span>";
                            echo '<button type="submit" class="btn-primary" style="font-weight: bold;">CHANGE PHOTO </button>';
                            echo '</form>';
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <?= $this->session->flashdata('update'); ?>
                        <form action="<?= base_url('auth/updateProfile'); ?>" method="POST">
                            <div class="form-group">
                                <label for="username" style="font-weight: bold;">NAME</label>
                                <input type="text" class="form-control" name="name" id="username" value="<?= $user['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" style="font-weight: bold;">EMAIL ADDRESS</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="<?= $user['email'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password" style="font-weight: bold;">NEW PASSWORD</label>
                                <input type="hidden" class="form-control" name="pass_lama" value="<?= $user['password'] ?>">
                                <input type="password" class="form-control" name="password1" id="password" name="password1" placeholder="New Password">
                                <?= form_error('password1', '<small class="text-danger"><b>', '</b></small>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="retype" style="font-weight: bold;">RE-TYPE PASSWORD</label>
                                <input type="password" class="form-control" name="password2" id="retype" name="password2" placeholder="Re-Type Password">
                                <?= form_error('password2', '<small class="text-danger"><b>', '</b></small>'); ?>

                            </div>
                            <button type="submit" class="btn btn-primary" style="font-weight: bold; font-size: 14px;">SAVE CHANGES PASSWORD</button>
                        </form>
                    </div>
                </div>
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
