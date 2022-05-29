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
    <div class="container">
        <div class="row justify-content-center" style="padding: 125px 0;">
            <div class="col-md-4 col-sm-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 2%;">
                <h3 style="text-align: center;">Welcome</h3>
                <hr>
                <form method="POST" action="<?= base_url('index.php/auth'); ?>">
                    <?= $this->session->flashdata('message'); ?>
                   
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger"><b>', '</b></small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger"><b>', '</b></small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                        <hr>
                        <!-- <a href="#" class="btn btn-block btn-outline-info"> <i class="fab fa-google"></i>   Google Accounts</a> -->
                        <div class="text-center">
                            <a class="small" href="<?= base_url('index.php/auth/forgotPassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url(); ?>index.php/auth/register">Create an Account!</a>
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php
        echo $js;
	?>
</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>