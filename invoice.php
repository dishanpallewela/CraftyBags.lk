<?php
 session_start();
?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <title>CraftyBags.lk | Invoice</title>

</head>

<body class="mt-2" style="background-color: 3f7f7ff;">

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <?php require "header.php";


            require "connection.php";

            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"];
                $oid = $_GET["id"];

            ?>


                <!-- header -->

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2 shadow-none" onclick="printDiv()"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2 shadow-none"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div id="GFG">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-2 col-md-1">
                                <img src="resources/logo.svg" class="img-fluid mx-auto d-block">
                            </div>
                            <div class="col-6 col-md-4 offset-md-7 offset-4 text-end">
                                <h3 class="text-success text-decoration-underline">CraftyBags.lk</h3>
                                <span>Maradhana, Colombo 10, Sri Lanka</span><br>
                                <span>+94112546978</span><br>
                                <span>eshop@gmail.com</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="bg-primary">
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-7 col-md-4">
                                <h6>INVOICE TO:</h6>

                                <?php
                                $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $user["email"] . "' ");
                                $ar = $addressrs->fetch_assoc();

                                // $cityrs = Database::search("SELECT * FROM `city` WHERE  ")

                                ?>

                                <h4><?php echo $user["fname"] . " " . $user["lname"]; ?></h4>
                                <span><?php echo $ar["line1"] . " " . $ar["line2"]; ?></span><br>
                                <span class="text-primary text-decoration-underline"><?php echo $user["email"]; ?></span>
                            </div>

                            <?php

                            $invoicers = Database::search("SELECT * FROM `invoice` WHERE `order_id` ='" . $oid . "' ");
                            $in = $invoicers->num_rows;

                            $ir = $invoicers->fetch_assoc();

                            ?>

                            <div class="col-5 col-md-4 offset-md-4 offset-0 text-end">
                                <h3 class="text-success">INVOICE 0<?php echo $ir["id"]; ?></h3>
                                <span>Date and Time of Invoice:</span>&nbsp;<span><?php echo $ir["date"]; ?></span>
                            </div>



                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <table class="table">
                            <tr class="table table-light">
                                <td>#</td>
                                <td>Order id & Product</td>
                                <td>Unit Price</td>
                                <td>Quantity</td>
                                <td>Total</td>
                            </tr>

                            <?php

                            $invoicers2 = Database::search("SELECT * FROM `invoice` WHERE `order_id` ='" . $oid . "' ");
                            $ind = $invoicers2->num_rows;

                            $subtotal = "0";

                            for ($i = 0; $i < $ind; $i++) {

                                $irs = $invoicers2->fetch_assoc();
                                $pid = $irs["product_id"];

                                $subtotal = $subtotal + $irs["total"];

                                $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "' ");
                                $pr = $productrs->fetch_assoc();

                            ?>
                                <tr class="table table-light">
                                    <td class="bg-primary text-white"><?php echo $irs["id"]; ?></td>
                                    <td class="text-primary text-decoration-underline"><?php echo $irs["order_id"]; ?> <br> <?php echo $pr["title"]; ?></td>
                                    <td class="bg-secondary text-white text-start">Rs.<?php echo $pr["price"]; ?>.00</td>
                                    <td class="text-start"><?php echo $irs["qty"]; ?></td>
                                    <td class="bg-primary text-white text-start">Rs.<?php echo $irs["total"]; ?>.00</td>
                                </tr>
                            <?php
                            }
                            ?>

                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td></td>
                                <td class="">SUBTOTAL</td>
                                <td class="table-light">Rs.<?php echo $subtotal ?>.00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td class="border-primary"></td>
                                <td class="border-primary">Discount</td>
                                <td class="table-light border-primary">Rs.00.00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0 fs-5 fw-bolder">Thank You!</td>
                                <td colspan="2" class="border-0 text-primary text-end fs-6">GRAND TOTAL</td>
                                <td class="border-0 text-primary fs-6">Rs.<?php echo $subtotal ?>.00</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="rounded pt-1 pb-1 bgn">
                            <span class="fw-bold">&nbsp; NOTICE:</span><br>
                            <span>&nbsp; Purchased items can be return before 7 days delivery</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 mb-3 text-center">
                        <label class="form-label fs-6 text-black-50">
                            Invoice was careted on a computer and is valid without Signatre and Seal
                        </label>
                    </div>

                </div>

                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            <?php
            }


            ?>


        </div>
    </div>



    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>