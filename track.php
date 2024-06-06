<?php

session_start();
require "connection.php";
if ($_SESSION["u"]) {
    $mail = $_SESSION["u"]["email"];
?>

    <!DOCTYPE html>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

        <title>Crafty Bags | Tracking</title>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php

                $orderrs = Database::search("SELECT * FROM neworder INNER JOIN invoice ON neworder.invoice_id = invoice.id  WHERE `orderstatus_id` ='2' ");
                $orderrow = $orderrs->num_rows;

                ?>

                <!-- header -->

                <div class="col-12 text-center mb-3">
                    <span class="fs-1 fw-bold text-success">Track My Order</span>
                </div>

                <?php

                if ($orderrow == 0) {
                ?>
                    <!-- No Transaction History -->
                    <div class="col-12 text-center p-5 bg-light">
                        <span class="fs-3 fw-bold text-black-50">You have not buy anything yet...</span>
                    </div>
                    <!-- No Transaction History -->
                <?php
                } else {
                ?>
                    <div class="col-12 d-none d-lg-block">
                        <div class="row">

                            <div class="col-2 bg-light">
                                <label class="form-label fw-bold">#</label>
                            </div>
                            <div class="col-4 bg-light">
                                <label class="form-label fw-bold">Order Details</label>
                            </div>
                            <div class="col-2 bg-light text-start">
                                <label class="form-label fw-bold">Purchased Date & Time</label>
                            </div>
                            <div class="col-4 bg-light text-start">
                                <label class="form-label fw-bold">Estimated Date</label>
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <hr>
                    </div>

                    <?php
                    for ($i = 0; $i < $orderrow; $i++) {
                        $ir = $orderrs->fetch_assoc();

                    ?>
                        <div class="co-12">
                            <div class="row">

                                <div class="col-12 col-lg-2 adminnav text-white p-4 text-center">
                                    <label class="form-label fw-bold text-center"><?php echo $ir["order_id"]; ?></label>
                                </div>
                                <div class="col-12 col-lg-4 bg-light">
                                    <div class="row">
                                        <div class="card mb-3 col-10 offset-1 mt-2">
                                            <div class="row g-0">
                                                <div class="col-md-4 mt-4">

                                                    <?php
                                                    $pid = $ir["product_id"];
                                                    $array;
                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "' ");
                                                    $n = $imagers->num_rows;
                                                    for ($x = 0; $x < $n; $x++) {
                                                        $f = $imagers->fetch_assoc();
                                                        $array[$x] = $f["code"];
                                                    }
                                                    ?>

                                                    <img src="<?php echo $array[0]; ?>" class="img-fluid rounded-start">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">

                                                        <?php

                                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "' ");
                                                        $pd = $productrs->fetch_assoc();

                                                        $sellerrs =  Database::search("SELECT * FROM `users` WHERE `email` = '" . $pd["user_email"] . "' ");
                                                        $sellerd = $sellerrs->fetch_assoc();

                                                        ?>

                                                        <h5 class="card-title"><?php echo $pd["title"]; ?></h5>
                                                        <span class="card-text"><b>Quontity :</b> <?php echo $ir["qty"]; ?></span><br>
                                                        <span class="card-text"><b>Total :</b> Rs.<?php echo $ir["total"]; ?>.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-2 adminnav text-white pt-4 text-center">
                                    <label class="form-label fw-bold"><?php echo $ir["date"]; ?></label>
                                </div>
                                <div class="col-12 col-lg-4 bg-light pt-4">
                                    <div class="row">
                                        <div class="col-4  text-center">
                                            <label class="form-label fw-bold"><?php echo $ir["date"]; ?></label>
                                        </div>
                                        <div class="col-8 bg-light">
                                            <div class="row">
                                                <div class="col-12 d-grid">
                                                    <button class="btn btn-danger" id="cbtn" onclick="confirmoder1(<?php echo $ir['id']; ?>);"><i class="bi bi-info-circle-fill"></i> Confirm the order received. </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- modal -->
                                    <div class="modal fade" id="confirmoder<?php echo $ir['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="exampleModalLabel">Warning.....!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="fs-5 fw-bold">We do not accept liability if confirmed before receiving the order. </p>
                                                    <br>
                                                    <p class="fs-5 ">Also be sure to confirm as soon as you receive the order. Thank you.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary" onclick="confirmOder(<?php echo $ir['invoice_id']; ?>);">confirm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal -->

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                    <div class="col-12">
                        <hr>
                    </div>


                <?php
                }


                ?>





                <!-- footer -->
                <?php require "footer.php";

                ?>
                <!-- footer -->
            </div>
        </div>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.min.js"></script>

        </div>
        </div>

    </body>

<?php
} else {
?>
    <script>
        alert("Please Signin or Signup First");
        window.location = "index.php";
    </script>
<?php
}

?>