<?php
 session_start();
require "connection.php";





if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`= '" . $pid . "'");
    $pn = $productrs->num_rows;

    if ($pn == 1) {

        $pd = $productrs->fetch_assoc();

?>

        <!DOCTYPE html>

        <html>

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link rel="icon" href="resources/logo.svg">

            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

            <link rel="stylesheet" href="style.css">

            <title>eShop| <?php echo $pd["title"] ?> View</title>

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <!-- header -->
                    <?php
                    require "header.php";
                    ?>
                    <!-- header -->

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>

                                            <?php

                                            $imagesrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "' ");
                                            $in = $imagesrs->num_rows;

                                            $img1;

                                            if (!empty($in)) {

                                                for ($x = 0; $x < $in; $x++) {

                                                    $d = $imagesrs->fetch_assoc();

                                                    $img1 = $d["code"];

                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                        <img src="<?php echo $d["code"]; ?>" style="cursor: pointer;" height="185px" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                        <img src="<?php echo $d["code2"]; ?>" style="cursor: pointer;" height="185px" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                        <img src="<?php echo $d["code3"]; ?>" style="cursor: pointer;" height="185px" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                    </li>
                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px">
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-2 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondary p-3">
                                            <div class="" style="background-image: url('<?php echo $img1; ?>'); background-repeat: no-repeat; background-size: contain; height: 522px;"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <nav>
                                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                                <li class="breadcrumb-item"><a class="" href="home.php">Home</a></li>
                                                                <li class="breadcrumb-item active">
                                                                    <a class="text-decoration-none text-black-50" href="#">Single View</a>
                                                                </li>
                                                            </ol>
                                                        </nav>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>

                                                    <div class="col-12 mt-1">
                                                        <span class="text-black-50 fs-6 ps-5">
                                                            <i class="fa fa-star mt-1 text-warning"></i> 4.5 Star & 45 Ratings
                                                        </span>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-3">Rs.<?php echo $pd["price"]; ?>.00</label>
                                                        <label class="form-label fs-6 fw-bold text-danger ps-2"><del>Rs.<?php
                                                                                                                        $a = $pd["price"];
                                                                                                                        $newval = ($a / 100) * 5;
                                                                                                                        $val = $a + $newval;
                                                                                                                        echo $val;
                                                                                                                        ?>.00</del></label>
                                                    </div>

                                                    <hr class="hrbreak1">

                                                    <?php 
                                                    $crs = Database::search("SELECT * FROM color WHERE id = '".$pd["color_id"]."' ");
                                                    $c = $crs->fetch_assoc();
                                                    ?>

                                                    <div class="col-12 mb-3">
                                                        <label class="text-dark fs-6"><b>colour : </b><?php echo $c["name"]; ?></label><br>
                                                        <label class="text-dark fs-6"><b>Return Policy : </b>01 month return policy</label><br>
                                                        <label class="text-primary fs-6"><b>In Stock : </b><?php echo $pd["qty"]; ?> Items Left</label>
                                                    </div>

                                                    <hr class="hrbreak1">

                                                    <?php

                                                    $userrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $pd["user_email"] . "' ");
                                                    $userd = $userrs->fetch_assoc();

                                                    ?>

                                                    <div class="col-12 mb-3">
                                                        
                                                        <a href="messages.php?email=<?php echo $pd["user_email"]; ?>" class="btn btn-secondary">Contact Seller</a>
                                                    </div>

                                                    <hr class="hrbreak1">

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="border border-success border-1 col-11 m-2 col-md-6 rounded ms-md-2">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <img src="resources/singleview/pricetag.png">
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <label class="text-start text-black-50">Stand a chance to get instant 5% discount by using VISA</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="hrbreak1">

                                                    <div class="col-12">
                                                        <div class="row mt-2 mb-3">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start position-relative product_qty ms-3">
                                                                        <span class="mt-2">QTY :</span>
                                                                        <input id="qtyinput" class="d-block border-0 fs-6 fw-bold text-start pe-2" type="text" min="1" pattern="[0-9]*" value="1" readonly>
                                                                        <div class="position-absolute qty-buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fa fa-chevron-up" onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fa fa-chevron-down" onclick="qty_dec(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-10">
                                                                        <div class="row">
                                                                            <div class="col-6 d-grid">
                                                                                <button class="btn btn-outline-dark" onclick="addToCart2(<?php echo $pid; ?>);">Add to cart</button>
                                                                            </div>
                                                                            <div class="col-6 d-grid">
                                                                                <button class="btn btn-outline-dark" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Buy now</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 mt-2">
                                                                        <i class="fa fa-heart fs-5 bg-light text-black-50 rounded"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row p-2">

                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $pd["brand_id"] . "' ");
                                            $brand_d = $brand_rs->fetch_assoc();

                                            
                                            $brandsid = Database::search("SELECT * FROM `product` LEFT JOIN   `images` ON images.product_id = product.id WHERE `brand_id` LIKE '" . $brand_d["id"] . "' LIMIT 4");

                                            $bds = $brandsid->num_rows;
                                            for ($g = 0; $g < $bds; $g++) {
                                                $bdf = $brandsid->fetch_assoc();

                                            ?>

                                                <div class="card col-10 offset-1 col-md-3 offset-md-0 ms-5" style="width: 18rem;">

                                                    <img src="<?php echo $bdf["code"]; ?>" class="card-img-top" height="250px">
                                                    <div class="card-body " >
                                                        <h5 class="card-title"><?php echo $bdf["title"]; ?></h5>
                                                        <p class="card-text">Rs.<?php echo $bdf["price"]; ?>.00</p>
                                                        <a href="#" class="btn btn-outline-primary">Add to cart</a>
                                                        <a href="singleproductview.php?id=<?php echo $bdf["id"]; ?>" class="btn btn-outline-success">Buy now</a>
                                                        <a href="#"><i class="fa fa-heart text-black-50"></i></a>
                                                    </div>
                                                </div>

                                            <?php

                                            }


                                            ?>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-6 fw-bold">Brand</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $brand_d["name"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-6 fw-bold">Title</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $pd["title"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-6 fw-bold">Description</label>
                                            </div>
                                            <div class="col-10">
                                                <textarea class="form-control shadow-none" id="" rows="10" readonly><?php echo $pd["description"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Feedbacks...</span>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pid . "' ");
                            $fn = $feedbackrs->num_rows;

                            if ($fn == 0) {
                            ?>

                                <div class="col-12">
                                    <label class="form-label">There are no feedbacks to view</label>
                                </div>

                                <?php
                            } else {
                                for ($i = 0; $i < $fn; $i++) {
                                    $fd = $feedbackrs->fetch_assoc();
                                ?>

                                    <div class="col-12 bg-white">
                                        <div class="row g-1">
                                            <div class="col-12  border border-1 border-danger rounded">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="fs-6 fw-bold text-primary"><?php echo $fd["user_email"]; ?></span>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="fs-6 text-dark"><?php echo $fd["feed"]; ?></span>
                                                    </div>
                                                    <div class="col-12 text-end">
                                                        <span class="text-black-50"><?php echo $fd["date"]; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                }
                            }



                            ?>

                        </div>
                    </div>

                    <!-- footer -->
                    <?php
                    require "footer.php";
                    ?>
                    <!-- footer -->


                </div>
            </div>





            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>
<?php
    }
}

?>