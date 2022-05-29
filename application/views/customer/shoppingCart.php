<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>

    <title>Shopping Cart</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Shopping Cart</h1>
                <table class="table" id="shoppingCart">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">COLOR</th>
                            <th scope="col">SIZE</th>
                            <th scope="col">UNIT PRICE</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">PRICE</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="detail_cart">
                        <?= $this->session->flashdata('stockhabis'); ?>
                        <?php
                        $total = 0;
                        $counter = 1;
                        foreach ($shoppingcart as $row) : ?>
                            <tr>
                                <td><img src="<?= $row->itemImage; ?>" class="img-fluid" width="200" height="200"></td>
                                <td class='align-middle'> <?= $row->itemName ?> </td>
                                <td class='align-middle'> <?= $row->itemColorName ?> </td>
                                <td class='align-middle'> <?= $row->itemSizeName ?> </td>
                                <td class='align-middle'> Rp <?= $row->itemPrice ?> </td>

                                <td class='align-middle'>
                                    <span id='quantity" name="qty". <?= $counter++; ?> . "'><?= $row->itemQuantity ?></span>
                                    <div class='btn-group' style='float: right;'>
                                        <a href="<?= base_url('shoppingCart/plus/' . $row->shoppingcartID); ?>" class='btn btn-primary' style='border-radius: 15px 0px 0px 15px; width: 50px; height: 30px; padding: 0px;'> + </a>
                                        <a href="<?= base_url('shoppingCart/minus/' . $row->shoppingcartID); ?>" class='btn btn-primary' style=' border-radius: 0px 15px 15px 0px; width: 50px; height: 30px; padding: 0px;'>-</a>
                                    </div>
                                </td>
                                <td class='align-middle'> Rp <?= ($row->itemPrice * $row->itemQuantity) ?></td>
                                <td class='align-middle'><a href="<?= base_url('shoppingCart/hapus/' . $row->shoppingcartID); ?>" class='btn btn-danger' style='width: 50px; height: 30px; padding: 0px;'>x</a></td>
                            </tr>
                        <?php
                            $total += ($row->itemPrice * $row->itemQuantity);
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" style="text-align: center;">SUBTOTAL</th>
                            <?php
                            echo "<th scope='col'>Rp  $total </th>";
                            ?>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>

                </table>
                <a href="<?= base_url('customer/checkout') ?>" class="btn btn-primary" style="font-weight: bold; font-size: 14px; width: 100px; float: right;">CHECKOUT</a>
            </div>
        </div>
    </div>
</body>
<!-- <script>
    //Hapus Item Cart
    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
            url: "<?php echo base_url('shoppingCart/hapus_cart'); ?>",
            method: "POST",
            data: {
                row_id: row_id
            },
            success: function(data) {
                $('#detail_cart').html(data);
            }
        });
    });


    function increaseQuantity(id) {
        idx = id;
        document.getElementById("quantity1").innerHTML++;
    }

    function decreaseQuantity(row) {
        var i = document.getElementById("quantity").innerHTML;

        if (i > 1) {
            document.getElementById("quantity").innerHTML--;
        } else {
            deleteProduct(row.parentNode);
        }
    }

    // function deleteProduct(row) {
    // var i = row.parentNode.parentNode.rowIndex;
    // document.getElementById("shoppingCart" + id).deleteRow(i);
    // }
    // document.getElementById("shoppingCart" + id);
</script> -->

</html>