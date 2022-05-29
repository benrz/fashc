<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Checkout</title>
    <?php
    echo $css;
    ?>
</head>

<body>
    <header>
        <?php echo $HeaderView; ?>
    </header>

    <div class="container">
        <h1>Checkout</h1>
        <div class="row justify-content-center">
            <div class="col-7">
                <table class="table table-bordered" style="margin: 5px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        $price = 0;
                        foreach ($shoppingcart as $row) {
                            $qty = $row->itemQuantity;
                            $price += ($qty * $row->itemPrice);
                            echo "<tr>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . $row->itemName . "</td>";
                            echo "<td>" . $qty . "</td>";
                            echo "<td>Rp " . $row->itemPrice  . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden; text-align: center;">SUBTOTAL</th>
                            <th scope="col" style="border-right-style: hidden;" id="subtotal">
                                <?php
                                $subtotal = $price;
                                echo "Rp " . $subtotal;
                                ?>
                            </th>
                        </tr>
                        <tr style="border-bottom-style: hidden;">
                            <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden; text-align: center;">DISC</th>
                            <th scope="col" style="border-right-style: hidden;" id="discount">
                                <?php if ($this->session->flashdata('promo')) {
                                    echo "Rp " . $this->session->flashdata('promo');
                                    $disc = $this->session->flashdata('promo');
                                    $subtotal -= $disc;
                                } else {
                                    echo "0";
                                }

                                ?>
                            </th>
                        </tr>
                        <tr style="border-bottom-style: hidden;">
                            <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden; text-align: center;">DELIVERY FEE</th>
                            <th scope="col" style="border-right-style: hidden;" id="deliveryFee"> 0 </th>
                        </tr>
                        <!-- <tr>
                            <th scope="col" style="border-left-style: hidden; border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden;"></th>
                            <th scope="col" style="border-right-style: hidden; text-align: center;">INSURANCE FEE</th>
                            <th scope="col" style="border-right-style: hidden;" id="insuranceFee">-</th>
                        </tr> -->
                        <tr>
                            <?= $this->session->flashdata('message'); ?>

                            <th class="align-middle" scope="col" colspan="2" style="border-left-style: hidden; border-right-style: hidden;">
                                <div class="input-group mb-3 mx-auto my-auto">
                                    <form action="<?= base_url('index.php/customer/promo/' . $row->shoppingcartID); ?>" method="POST">
                                        <div class="input-group-append">
                                            <input type="text" class="form-control" name="promo" placeholder="Promotion Code" aria-label="Promotion Code" aria-describedby="basic-addon2">
                                            <!-- <input type="hidden" class="form-control" name="kodepromo" id="kodepromo" value="kosong"> -->
                                            <button type="submit" class="btn btn-outline-secondary">APPLY</button>
                                        </div>
                                    </form>
                                </div>
                            </th>
                            <th class="align-middle" scope="col" style="border-right-style: hidden; text-align: center;">TOTAL</th>
                            <th class="align-middle" scope="col" style="border-right-style: hidden;" id="total">
                                <?php
                                echo "Rp " . $subtotal;
                                ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-5">
                <?php
                echo form_open_multipart('customer/AddTransaction');
                $hiddenvalue = array(
                    'id' => 'promodisc',
                    'name' => 'promodisc',
                    'value' => $this->input->post('promo')
                );
                echo form_hidden($hiddenvalue);
                ?>

                <div class="form-group">
                    <label for="recipientName" style="font-weight: bold;">RECIPIENT'S NAME</label>
                    <?php
                    $style = array(
                        'class' => 'form-control',
                        'placeholder' => 'Receiver Name',
                        'value' => set_value('name')
                    );
                    echo form_input('name', '', $style);
                    echo "<span class='text-danger'>" . form_error('name') . "</span>";
                    ?>
                </div>
                <div class="form-group">
                    <label for="shippingAddress" style="font-weight: bold;">SHIPPING ADDRESS</label>
                    <?php
                    $dataarea = array(
                        'name' => 'address',
                        'class' => 'form-control',
                        'placeholder' => 'Shipment Address',
                        'rows' => 3,
                        'cols' => 1
                    );
                    echo form_textarea($dataarea);
                    echo "<span class='text-danger'>" . form_error('address') . "</span>";
                    ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="city" style="font-weight: bold;">PROVINSI</label>
                        <?php
                        echo "<select class='form-control' name='provinsi' id='provinsi'>";
                        echo "<option selected disabled> Choose a City </option>";

                        foreach ($provinsi as $row) {
                            $id = $row->provinsiID;
                            $provinsi = $row->provinsi;
                            echo '<option value="' . $id . '">' . $provinsi . '</option>';
                        }

                        echo "</select>";
                        echo "<span class='text-danger'>" . form_error('provinsi') . "</span><br>";
                        ?>
                    </div>
                    <div class="form-group col-4">
                        <label for="kota" style="font-weight: bold;">KOTA</label>
                        <?php
                        echo "<select class='form-control' name='kota' id='kota'>";
                        echo "<option selected disabled> Choose a City </option>";

                        echo "</select>";
                        echo "<span class='text-danger'>" . form_error('kota') . "</span><br>";
                        ?>

                    </div>
                    <div class="form-group col-4">
                        <label for="zipCode" style="font-weight: bold;">ZIP</label>
                        <?php
                        echo "<input type='number' class='form-control' id='zipCode' name='zipcode' placeholder='Enter a Zipcode'>";
                        echo "<span class='text-danger'>" . form_error('zipcode') . "</span>";
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliveryService" style="font-weight: bold;">DELIVERY SERVICE</label>
                    <select class='form-control' name='deliveryservice' id='deliveryservice' onchange='changeValue(this.value)'>

                        <?php
                        echo "<option selected disabled> Choose a Delivery Service </option>";
                        foreach ($deliveryService as $row) {
                            $id = $row['DeliveryServiceID'];
                            $deliveryname = $row['DeliveryService'];
                            echo '<option value="' . $id . '">' . $deliveryname . '</option>';
                            $jsArray .= "hrg_brg['" . $id . "'] = '" . addslashes($row['DeliveryFee']) . "';";
                        }
                        echo "</select>";
                        echo "<span class='text-danger'>" . form_error('deliveryservice') . "</span>";
                        ?>
                </div>
                <div class="form-group">
                    <label for="paymentMethod" style="font-weight: bold;">TRANSFER PAYMENT METHOD</label>
                    <?php
                    echo "<select class='form-control' name='paymentmethod' id='paymentmethod'>";
                    echo "<option selected disabled> Choose a State </option>";

                    foreach ($paymentMethod as $row) {
                        $id = $row['paymentMethodID'];
                        $paymentname = $row['paymentMethod'];
                        echo '<option value="' . $id . '">' . $paymentname . '</option>';
                    }

                    echo "</select>";
                    echo "<span class='text-danger'>" . form_error('paymentmethod') . "</span><br>";
                    ?>
                </div>
                <input type="hidden" name="totalhidden" id="totalhidden" value="<?= $subtotal ?>">
                <button type="submit" class="btn btn-primary" style="font-weight: bold; font-size: 14px; width: 100px;">ORDER</button>
                <!-- <div class="custom-control custom-checkbox my-1">
                    <input type="checkbox" class="custom-control-input" id="shippingInsurance">
                    <label class="custom-control-label" for="shippingInsurance">Include shipping insurance</label>
                </div> -->
                <?php
                echo form_close();
                ?>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php echo $FooterView; ?>
    <?php
    echo $js;
    ?>

</body>
<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script>

<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(deliveryserviceID) {
        total = (<?= $subtotal * 1 ?> + hrg_brg[deliveryserviceID] * 1);

        document.getElementById("deliveryFee").innerHTML = "Rp " + hrg_brg[deliveryserviceID];
        document.getElementById("total").innerHTML = "Rp " + total;
        document.getElementById("totalhidden").value = total;
    };


    $(document).ready(function() {
        $("#provinsi").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#kota").hide(); // Sembunyikan dulu combobox kota nya

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("index.php/customer/listKota"); ?>", // url/path file php yang dituju
                data: {
                    provinsiID: $("#provinsi").val()
                }, // data yang akan dikirim ke file yang dituju
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) { // Ketika proses pengiriman berhasil
                    // set isi dari combobox kota
                    // lalu munculkan kembali combobox kotanya
                    $("#kota").html(response.list_kota).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>

</html>