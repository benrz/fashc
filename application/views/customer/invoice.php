<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Invoice</title>
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
        <h1 style="margin-left: 10%; margin-bottom: 5%;">Invoice</h1>
        <a class="row justify-content-center">
            <div class="col-10">
                <div class="col-5" style="float: left; line-height: 10px;">
                    <p style="font-weight: bold">RECIPIENT</p>
                    <br>
                    <p><?php
                        echo $receiver->ReceiverName; ?></p>
                    <br>
                    <br>
                    <p style="font-weight: bold">BILL TO</p>
                    <br>
                    <p></p>
                    <p>
                        <?= $user['name']; ?>
                    </p>
                    <p>
                        <?= $user['email']; ?>
                    </p>
                    <!-- <p>+628-XXX-XXXX</p> -->
                    <br>
                    <br>
                    <br>
                    <br>

                    <p style="font-weight: bold">ORDER DESCRIPTION</p>
                </div>
                <div class="col-5" style="float: right">

                    <table class="table table-bordered">
                        <tr>

                            <th class="table-active">INVOICE NUMBER</th>
                            <td><?= $invoice['invoiceID'] ?></td>
                        </tr>
                        <tr>
                            <th class="table-active">INVOICE DATE</th>
                            <td><?= $invoice['invoiceDate'] ?></td>
                        </tr>
                        <tr>
                            <th class="table-active">PAYMENT METHOD</th>
                            <td><?= $invoice['paymentMethod'] ?></td>
                        </tr>
                        <tr>
                            <th class="table-active">DELIVERY SERVICE</th>
                            <td><?= $invoice['deliveryService'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <table class="table table-bordered" style="margin: 5px; width: 80%;">
                <thead>
                    <tr>
                        <th scope="col" class="table-active">#</th>
                        <th scope="col" class="table-active">PRODUCT</th>
                        <th scope="col" class="table-active">UNIT PRICE</th>
                        <th scope="col" class="table-active">QUANTITY</th>
                        <th scope="col" class="table-active">PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $counter = 1;
                    foreach ($orders->result() as $row) :

                        $deliveryfee = $row->deliveryFee;
                        ?>
                        <tr>
                            <?php $total += ($row->itemQuantity * $row->itemPrice); ?>
                            <td> <?= $counter++ ?></td>
                            <td class='align-middle'> <?= $row->itemName; ?> </td>
                            <td class='align-middle'> Rp <?= $row->itemPrice; ?> </td>
                            <td class='align-middle'> <?= $row->itemQuantity; ?> </td>
                            <td class='align-middle'> Rp <?= $row->itemQuantity * $row->itemPrice; ?> </td>
                        </tr>
                    <?php

                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden; text-align: center;">SUBTOTAL</th>
                        <th scope="col" style="border-right-style: hidden;">Rp <?= $total ?></th>
                    </tr>
                    <tr style="border-bottom-style: hidden;">
                        <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden; text-align: center;">DISC</th>
                        <th scope="col" style="border-right-style: hidden;">Rp <?php
                                                                                if ($order['promoDisc'] == null) {
                                                                                    echo "0";
                                                                                } else {
                                                                                    echo $order['promoDisc'];
                                                                                }; ?></th>
                    </tr>
                    <tr style="border-bottom-style: hidden;">
                        <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden; text-align: center;">DELIVERY FEE</th>
                        <th scope="col" style="border-right-style: hidden;">Rp <?= $deliveryfee ?></th>
                    </tr>
                    <!-- <tr>
                        <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden; text-align: center;">INSURANCE FEE</th>
                        <th scope="col" style="border-right-style: hidden;">0</th>
                    </!-->
                    <tr>
                        <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th scope="col" style="border-right-style: hidden;"></th>
                        <th class="align-middle" scope="col" style="border-right-style: hidden; text-align: center;">TOTAL</th>
                        <th class="align-middle" scope="col" style="border-right-style: hidden;">Rp <?= $row->totalTransaksi ?></th>
                    </tr>
                </tfoot>
            </table>
    </div>
    </div>

    </div>
    </div>

    <?php echo $FooterView; ?>
    <?php
    echo $js;
    ?>

</body>

</html>
