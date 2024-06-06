<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $u = $_SESSION["a"];
    // echo $_SESSION["a"]["email"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <title>Completed Orders | CraftyBags.lk</title>

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="col-12" style=" background-color: #50bc9c;">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">

                                <div class="col-12 col-md-3 mt-2 mb-1">

                                    <img class="rounded-circle" height="60px" width="60px" src="resources/logo.svg">
                                </div>

                                <div class="col-12 col-md-9">
                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <span class="fw-bold">Crafty Bags</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $u["email"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 offset-0 offset-md-2 col-md-10 mt-5 mt-md-0">
                                    
                                        <h2 class="fw-bold text-white mt-md-3 mp">Completed Orders</h2>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <div class="col-12">
                    <div class="row">

                        <!-- orders -->

                        <?php
                        $completedorder = Database::search("SELECT * FROM `completed_orders`; ");
                        $orderrow = $completedorder->num_rows;

                        if ($orderrow == 0) {

                        ?>
                            <div class="row">
                                <div class="col-12 col-lg-8 offset-lg-2 mt-5 border shadow" style="height: 500px">
                                    <div class="row ">
                                        <div class="d-none d-lg-block col-lg-4 text-center">
                                            <img src="resources/clock.svg" height="250px" style="margin-top: 125px; ">
                                        </div>
                                        <div class="col-12 col-lg-8 text-start">
                                            <p class="fs-1 fw-bold" style="margin-top: 180px;">No Completed Orders Yet.....!</p>
                                            <a href="neworder.php" class="btn btn-outline-dark">See All Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                        } else {

                        ?>

                            <div class="col-lg-12  col-12  mt-3 mb-3 bg-white">
                                <div class="row">

                                    <div class="col-10 offset-1 text-center mt-4">
                                        <div class="row">

                                            <?php

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            $order = Database::search("SELECT * FROM completed_orders INNER JOIN invoice ON completed_orders.invoice_id = invoice.id  ");
                                            $d = $order->num_rows;

                                            $row = $order->fetch_assoc();

                                            $results_per_page = 6;

                                            $number_of_pages = ceil($d / $results_per_page);

                                            // echo $d;
                                            // echo "<br/>";
                                            // echo $number_of_pages;



                                            $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                            $selectedrs = Database::search("SELECT * FROM completed_orders INNER JOIN invoice ON completed_orders.invoice_id = invoice.id LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                                            $srn = $selectedrs->num_rows;

                                            while ($srow = $selectedrs->fetch_assoc()) {
                                                // for ($i = 0; $i < $srn; $i++) {

                                            ?>
                                                <!-- <div class="card my-2 col-md-6"> -->
                                                <div class="card mb-3 col-12 mt-3 ms-lg-5" style="max-width: 540px;">
                                                    <div class="row g-0">

                                                        <?php

                                                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $srow["product_id"] . "' ");
                                                        $pir = $pimgrs->fetch_assoc();

                                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $srow["product_id"] . "' ");
                                                        $product = $productrs->fetch_assoc();

                                                        $userrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $srow["users_email"] . "' ");
                                                        $user = $userrs->fetch_assoc();

                                                        ?>

                                                        <div class="col-md-4 mt-4">
                                                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid d-grid">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body text-start">
                                                                <h5 class="card-title fw-bold"><?php echo $product["title"] ?></h5>
                                                                <span>price - </span>
                                                                <span class="fw-bold">Rs. <?php echo $product["price"] ?> .00</span><br>
                                                                <span>Quantity - </span>
                                                                <span class="text-success fs-4 fw-bold"><b><?php echo $srow["qty"] ?></b> item</span><br>

                                                                <hr>
                                                                <span class="text-dark fs-4 fw-bold"><b><?php echo $user["email"] ?></b></span><br>
                                                                <span class="text-danger fw-bold ms-3"><b><?php echo $user["mobile"] ?></b></span><br>

                                                                <hr>
                                                                <span class=" fs-5 fw-bold">Received date</span><br>
                                                                <span class=" fs-5 fw-bold text-black-50"><?php echo $srow["date"] ?></span>
                                                                <br>
                                                                <span class=" fs-5 fw-bold">completed date</span><br>
                                                                <span class=" fs-5 fw-bold text-black-50"><?php echo $srow["completed_date"] ?></span>


                                                                <!-- <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-6 d-grid g-1">
                                                                                <a href="#" class="btn btn-outline-success shadow-none">Accept</a>
                                                                            </div>
                                                                            <div class="col-md-6 d-grid g-1">
                                                                                <a href="#" class="btn btn-outline-dark shadow-none">Delivered</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <!-- pagination -->
                                    <div class="col-12 mt-3 mb-3">
                                        <div class="row">

                                            <div class="text-center">
                                                <div class="pagination">
                                                    <a href="<?php

                                                                if ($pageno <= 1) {
                                                                    echo "#";
                                                                } else {
                                                                    echo "?page=" . ($pageno - 1);
                                                                }

                                                                ?>">&laquo;</a>

                                                    <?php

                                                    for ($page = 1; $page <= $number_of_pages; $page++) {
                                                        if ($page == $pageno) {
                                                    ?>
                                                            <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                    <a href="<?php

                                                                // if ($pageno <= 1) {
                                                                //     echo "?page=" . ($pageno + 1);
                                                                // } else {
                                                                //   echo "#";
                                                                // }

                                                                // or

                                                                if ($pageno >= $number_of_pages) {
                                                                    echo "#";
                                                                } else {
                                                                    echo "?page=" . ($pageno + 1);
                                                                }


                                                                ?>">&raquo;</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- pagination -->

                                </div>
                            </div>
                            <!-- product -->

                    </div>
                </div>


                <?php
                            require "footer.php";
                ?>

            </div>
        </div>

        <script src="bootstrap.js"></script>
        <script src="script.js"></script>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>

    </html>



<?php
                        }
                    } else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>not found</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="resources/notfound.jpg" class="notfound vh-100">
            </div>
        </div>
    </div>
</body>

</html>

<?php
                    }
?>