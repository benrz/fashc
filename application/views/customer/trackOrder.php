<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TrackOrder</title>
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
        <?php echo $HeaderView; ?>
    </header>

    <div class="container my-5">
        <h1>Track Order</h1>
        <?php
        foreach ($order->result() as $row) :
            $id = $row->transactionID;
            ?>
            <div class="row border border-secondary rounded" style="padding: 10px;">
                <div class="col-8" style="padding: 10px;">
                    <h4>ORDER ID : <?= $row->transactionID; ?></h4>
                    <div class="row">
                        <div class="col-4 my-auto">
                            <h5><?= "Rp " . $row->TotalTransaksi; ?></h5>
                        </div>
                        <div class="col-3">
                            <h6>DATE :</h6>
                            <p><?= $row->transactionDate; ?></p>
                        </div>
                        <div class="col-5">
                            <h6>SHIP TO :</h6>
                            <p><?= $row->Address . ", " . $row->kota . ", " . $row->provinsi; ?></p>
                        </div>
                    </div>
                    <div>
                        <h6>SHIPMENT STATUS</h6>
                        <b>
                            <p class="alert" style="color:red;"><?= $row->Status; ?></p>
                        </b>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?= $row->Progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row->Progress . '%'; ?>;">
                                <?= "<b>" . $row->Progress . "%</b>" ?>
                            </div>
                        </div>
                        <?php
                            $photo = array(
                                'name' => 'pay',
                                'type' => 'file',
                                'id' => 'pay'
                            );
                            if ($row->status_id == 1 && $row->BuktiPayment == NULL) {
                                echo '<br>' . '<form class="form-group" method="POST" action="' . base_url("index.php/customer/BuktiPayment/$id") . '" enctype="multipart/form-data">
                                <h6> UPLOAD PAYMENT </h6>';
                                echo '<input type="file" name="pay" id="pay">';
                                echo "<span class='text-danger'>" . $error . "</span>" .
                                    '<button type="submit" class="btn btn-primary" style="font-weight: bold; font-size: 14px; width: 100px;">Upload</button>';
                                echo '</form>';
                            } else if ($row->status_id == 1) {
                                echo '<br>';
                                echo '<div class="alert alert-success" role="alert"><b>Upload Success. Wait for the next confirmation</b></div>';
                            } else {
                                echo '<a href="' . base_url("index.php/customer/invoice?id=$id") . '" class="btn btn-primary my-3" style="font-weight: bold; font-size: 14px; width: 100px;">INVOICE</a>';
                            }
						?>
                    </div>
                </div>
                <div class="col-4 my-auto">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="float: right;">
                        <ol class="carousel-indicators">
                            <?php
                                $counter = 0;
                                foreach ($images->result() as $row) {
                                    if ($counter == 0) {
                                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $counter . '" class="active"></li>';
                                    } else {
                                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $counter . '"></li>';
                                    }
                                    $counter++;
                                }
                                ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                                $counter = 0;
                                foreach ($images->result() as $row) {
                                    if ($counter == 0) {
                                        echo '<div class="carousel-item active">
                                                        <img class="d-block w-100" src="'. base_url().  $row->itemImage . '">
                                                    </div>';
                                    } else {
                                        echo '<div class="carousel-item">
                                                        <img class="d-block w-100" src="'.  base_url(). $row->itemImage . '">
                                                    </div>';
                                    }
                                    $counter++;
                                }
                                ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
			</div>
			<br>
        <?php endforeach; ?>
    </div>

    <?php echo $FooterView; ?>
    <?php
    echo $js;
    ?>

</body>

</html>
