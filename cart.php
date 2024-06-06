<?php session_start(); ?>
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

    <title>CraftyBags.lk | Cart</title>

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <?php require "header.php"; ?>
            <!-- header -->

            <div class="col-12" style="background-color: #E3E5E4;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 border border-1 border-secondary rounded mb-3">
                <div class="row">

                    <div class="col-12">
                        <label class="fs-2 fw-bolder form-label">Basket <i class="bi bi-cart3"></i></label>
                    </div>

                    <div class="col-12 col-lg-6">
                        <hr class="hrbreak1">
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control shadow-none" placeholder="Search in Basket...">
                            </div>
                            <div class="col-12 col-lg-2 d-grid mb-3">
                                <button class="btn btn-outline-success shadow-none">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="hrbreak1">
                    </div>

                    <?php

                    require "connection.php";

                    if (isset($_SESSION["u"])) {

                        $umail = $_SESSION["u"]["email"];

                        $total = "0";
                        $subtotal = "0";
                        $shipping = "0";

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $umail . "'  ");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {
                    ?>
                            <!-- empty cart -->
                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-8 offset-2 col-lg-4 offset-lg-4">
                                        <img src="resources/emptycart.svg" class="img-fluid">
                                    </div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-3 fw-bolder">You have no items in your Basket.</label>
                                    </div>

                                    <div class="col-10 offset-1 col-lg-4 offset-lg-4 d-grid mt-2">
                                        <a href="home.php" class="btn btn-primary fs-4">Start Shopping</a>
                                    </div>

                                </div>
                            </div>
                            <!-- empty cart -->
                        <?php
                        } else {

                        ?>

                            <div class="col-12">
                                <div class="row">
                                    <div class="card mb-3 col-12 col-lg-9">
                                        <div class="row g-0">
                                            <?php

                                            for ($i = 0; $i < $cn; $i++) {
                                                $cr = $cartrs->fetch_assoc();

                                                $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cr["product_id"] . "' ");
                                                $pr = $productrs->fetch_assoc();

                                                $total = $total + ($pr["price"] * $cr["qty"]);

                                                $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
                                                $ar = $addressrs->fetch_assoc();
                                                $cityid = $ar["city_id"];

                                                $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "' ");
                                                $xr = $districtrs->fetch_assoc();
                                                $districtid = $xr["district_id"];

                                                $ship = "0";

                                                if ($districtid == "2") {
                                                    $ship = $pr["delivery_fee_colombo"];
                                                    $shipping = $shipping + $pr["delivery_fee_colombo"];
                                                } else {
                                                    $ship = $pr["delivery_fee_other"];
                                                    $shipping = $shipping + $pr["delivery_fee_other"];
                                                }

                                                $sellerrs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $pr["user_email"] . "' ");
                                                $sn = $sellerrs->fetch_assoc();

                                            ?>

                                                <div class="col-12 mt-3 mb-1">


                                                    <span class="text-black-50">Seller : </span> <span class="fw-bolder"><?php echo $sn["fname"] . " " . $sn["lname"]; ?></span>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-md-3">

                                                    <?php
                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pr["id"] . "' ");
                                                    $in = $imagers->num_rows;

                                                    $arr;

                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr[$x] = $ir["code"];
                                                    }

                                                    ?>

                                                    <!-- <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                                        <button class="btn btn-primary" type="button" disabled>Disabled button</button>
                                                    </span> -->

                                                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"]; ?>" data-bs-content="<?php echo $pr["description"]; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card-body">

                                                        <?php

                                                        $color_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $pr["color_id"] . "' ");
                                                        $color_d = $color_rs->fetch_assoc();


                                                        ?>

                                                        <h5 class="card-title fw-bolder"><?php echo $pr["title"]; ?></h5>
                                                        <span class="text-black-50">Color : <?php echo $color_d["name"]; ?></span> &nbsp;<br>
                                                        <span class="text-black-50">Price :</span> <span class="fw-bolder">Rs.<?php echo $pr["price"]; ?>.00</span><br>
                                                        <span class="text-black-50">Quantity :</span>
                                                        <input readonly id="qtyinput" type="text" value="<?php echo $cr["qty"]; ?>" class="border border-1 border-secondary fw-bolder px-3 text-start" style="width: 50px; outline: none;"><br>
                                                        <span class="text-black-50">Delivery Fee :</span> <span class="fw-bolder">Rs.<?php echo $ship ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row mt-4">
                                                        <div class="col-md-10 offset-md-1 d-grid">
                                                            <button class="btn btn-sm btn-outline-success shadow-none" id="payhere-payment<?php echo $pr['id']; ?>" onclick="paynow1(<?php echo $pr['id']; ?>);">Buy Now</button>

                                                        </div>
                                                        <div class="col-md-10 offset-md-1 d-grid mt-2">
                                                            <button class="btn btn-sm btn-outline-danger shadow-none" onclick="deletefromCart(<?php echo $cr['id']; ?>);">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 text-start">
                                                            <span class="text-black-50">Requested Details <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <span class="text-black-50 fw-bolder">Rs. <?php echo ($pr["price"] * $cr["qty"]) + $ship ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="fw-bolder fs-3">Summary</label>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-6 text-stat">
                                                <span class="fw-bolder">Items( <?php echo $cn; ?> )</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fw-bolder">Rs. <?php echo $total; ?>.00</span>
                                            </div>
                                            <div class="col-6 text-stat">
                                                <span class="fw-bolder">Shipping</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fw-bolder">Rs. <?php echo $shipping; ?>.00</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <hr>
                                            </div>
                                            <div class="col-6 text-stat">
                                                <span class="fw-bolder fs-5">Total</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fw-bolder fs-5">Rs. <?php echo $total + $shipping ?>.00</span>
                                            </div>

                                            <div class="col-12 d-grid mt-3 mb-5">
                                                <button class="btn btn-sm btn-primary fs-6 fw-bold shadow-none" id="payhere-payment" onclick="checkout();">CHECKOUT</button>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                        }

                        ?>

                </div>
            </div>



            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->

        </div>
    </div>

    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

</body>

</html>

<?php
                    } else {

?>

    <div class="col-12">
        <div class="row">
            <div class="col-6 mt-5 mb-5 text-end">
                <img src="resources/lock.svg" height="250px">
            </div>
            <div class="col-6 mt-5">
                <label class="fs-1 fw-bold mt-5">Sign In First</label>
                <br>
                <a href="index.php" class="btn btn-outline-dark mt-3">Sign In</a>
            </div>
        </div>
    </div>

<?php

                    }

?>