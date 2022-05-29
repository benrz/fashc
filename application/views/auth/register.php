<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Register</title>
</head>

<body>
    <div class="container">
        <h3 style="text-align: center;">Register</h3>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 2%;">
                <form class="user" method="post" action="<?= base_url('index.php/auth/register'); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger"><b>', '</b></small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger"><b>', '</b></small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" id="password1" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger"><b>', '</b></small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" id="password2" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Register Account
                    </button>
                    <hr>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="<?= base_url('index.php/auth/forgotPassword'); ?>">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="<?= base_url(); ?>index.php/auth">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>