<?php
 session_start();

require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];

?>

<!DOCTYPE html>

<html>

<head>

    <title>eShop | Manage Product Selling History</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body >

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-success">Products Selling History</label>
            </div>

            <div class="col-12 mt-2 mb-1">
                <div class="row">
                    <div class="col-lg-2 col-2 bg-success text-white fw-bold p-2">
                        <span>Order ID</span>
                    </div>
                    <div class="col-lg-3 col-10  bg-light fw-bold p-2">
                        <span>Product</span>
                    </div>
                    <div class="col-lg-3 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Buyyer</span>
                    </div>
                    <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                        <span>Price</span>
                    </div>
                    <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Qunatity</span>
                    </div>
                </div>
            </div>

            <?php

            if (!empty($from) && empty($to)) {

                $fromrs = Database::search("SELECT * FROM  `invoice` ");
                $fn = $fromrs->num_rows;

                for ($x = 0; $x < $fn; $x++) {
                    $fr = $fromrs->fetch_assoc();

                    $fromdate = $fr["date"];

                    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $fr["product_id"] . "' ");
                    $pd = $productrs->fetch_assoc();

                    $splitdate = explode(" ", $fromdate);
                    $date = $splitdate[0];

                    if ($from == $date) {
                        //    echo $fr["order_id"];
            ?>

                        <div class="col-12 mt-1">
                            <div class="row">

                                <div class="col-lg-2 col-2 adminnav text-white fw-bold p-2">
                                    <span><?php echo $fr["order_id"]; ?></span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span><?php echo $pd["title"]; ?></span>
                                </div>
                                <div class="col-lg-3 adminnav text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Dishan Pallewela</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.<?php echo $fr["total"]; ?>.00</span>
                                </div>
                                <div class="col-lg-2 adminnav text-white fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $fr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                }
            } elseif (!empty($from) && !empty($to)) {
                $betweenrs = Database::search("SELECT * FROM  `invoice` ");
                $bn = $betweenrs->num_rows;

                for ($y = 0; $y < $bn; $y++) {
                    $br = $betweenrs->fetch_assoc();

                    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $br["product_id"] . "' ");
                    $pd = $productrs->fetch_assoc();

                    $betweendate = $br["date"];

                    $splitdate = explode(" ", $betweendate);
                    $date = $splitdate[0];

                    if ($from <= $date && $to >= $date) {
                     
                    ?>

                        <div class="col-12 mt-1">
                            <div class="row">

                                <div class="col-lg-2 col-2 bg-primary text-white fw-bold p-2">
                                    <span><?php echo $br["order_id"]; ?></span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span><?php echo $pd["title"]; ?></span>
                                </div>
                                <div class="col-lg-3 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Dishan Pallewela</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.<?php echo $br["total"]; ?>.00</span>
                                </div>
                                <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $br["qty"]; ?></span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                }
            } else {

                $todayrs = Database::search("SELECT * FROM  `invoice` ");
                $tn = $todayrs->num_rows;

                for ($z = 0; $z < $tn; $z++) {

                    $tr = $todayrs->fetch_assoc();
                    $nodate = $tr["date"];

                    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $tr["product_id"] . "' ");
                    $pd = $productrs->fetch_assoc();

                    $splitdate = explode(" ", $nodate);
                    $date = $splitdate[0];

                    $today = date("Y-m-d");

                    if ($today == $date) {
                    ?>
                        <div class="col-12 mt-1">
                            <div class="row">

                                <div class="col-lg-2 col-2 bg-primary text-white fw-bold p-2">
                                    <span><?php echo $tr["order_id"]; ?></span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span><?php echo $pd["title"]; ?></span>
                                </div>
                                <div class="col-lg-3 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Dishan Pallewela</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.<?php echo $tr["total"]; ?>.00</span>
                                </div>
                                <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $tr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
            <?php
                    }else{
                        ?>
                      <h2>You haven't sell anything today</h2>
                        <?php
                    }
                }
            }

            ?>


            <!-- <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="text-center fw-bold">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a class="active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                </div>
            </div> -->
<br><br><br><br>
            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->

        </div>
    </div>

</body>

</html>