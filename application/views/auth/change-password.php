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

    <title>Welcome</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center" style="padding: 100px 0px;">
            <div class="col-md-4 col-sm-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 20px;">
                <h3 style="text-align: center;">Change Password</h3>
                <hr>
                <?= $this->session->flashdata('message'); ?>
                <form class="user" method="post" action="<?= base_url('index.php/auth/changepassword'); ?>">
                    <div class="form-group">
                        <input type="password" name="password1" class="form-control form-control-user" id="password1" placeholder="Enter New Password...">
                        <?= form_error('password1', '<small class="text-danger"><b>', '</b></small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Repeat New Password...">
                        <?= form_error('password2', '<small class="text-danger"><b>', '</b></small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Change Password
                    </button>
                    <hr>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>