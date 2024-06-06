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

    <title>CraftyBags.lk | Watchlist</title>

</head>

<body>

    <div class="container-fluid">
        <div class="row gx-2 gy-2">

            <?php

            require "connection.php";

            if (isset($_SESSION["u"])) {

                $uemail = $_SESSION["u"]["email"];

            ?>

                <!-- header -->
                <?php require "header.php"; ?>
                <!-- header -->

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">

                        <div class="col-12">
                            <label class="fs-2 fw-bolder form-label">Watchlist &hearts;</label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1">
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control shadow-none" placeholder="Search in Watchlist...">
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-success shadow-none">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hrbreak1">
                        </div>

                        <div class="col-12 col-lg-2 border border-2 border-start-0 border-top-0 border-bottom-0 border-success">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb ps-3">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="#">Recently Viewed</a>
                            </nav>
                        </div>

                        <?php

                        $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `users_email` = '" . $uemail . "' ");
                        $wn = $watchlistrs->num_rows;

                        if ($wn == 0) {
                        ?>
                            <!-- without items -->
                            <div class="col-12 col-lg-9 mb-3">
                                <div class="row">
                                    <div class="col-8 offset-2 col-lg-4 offset-lg-4">
                                        <img src="resources/watchlist_empty.svg">
                                    </div>
                                    <div class="text-center">
                                        <label class="form-label fs-3 fw-bolder">You have no items in your Watchlist.</label>
                                    </div>
                                </div>
                            </div>
                            <!-- without items -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-9 mb-3">
                                <div class="row g-2">
                                    <?php
                                    for ($i = 0; $i < $wn; $i++) {
                                        $wr = $watchlistrs->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $wid . "' ");
                                        $pn = $productrs->num_rows;

                                        if ($pn == 1) {
                                            $pr = $productrs->fetch_assoc();
                                            $prodid = $pr["id"];


                                    ?>



                                            <div class="card mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">

                                                        <?php
                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $prodid . "' ");
                                                        $in = $imagers->num_rows;

                                                        $arr;

                                                        for ($x = 0; $x < $in; $x++) {
                                                            $ir = $imagers->fetch_assoc();
                                                            $arr[$x] = $ir["code"];
                                                        }

                                                        ?>

                                                        <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pr["title"]; ?></h5>

                                                            <?php

                                                            $color_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $pr["color_id"] . "' ");
                                                            $color_d = $color_rs->fetch_assoc();

                                                    

                                                            $seller_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $pr["user_email"] . "' ");
                                                            $seller_d = $seller_rs->fetch_assoc();

                                                            ?>

                                                            <span class="text-black-50">Colour : <?php echo $color_d["name"]; ?></span> <br>
                                                            <span class="text-black-50">Price : </span><span class="fw-bolder">Rs.<?php echo $pr["price"]; ?>.00</span><br>
                                                            <span class="text-black-50">Seller : </span><br>
                                                            <span class="fw-bolder"><?php echo $seller_d["fname"] . " " . $seller_d["lname"]; ?></span><br>
                                                            <span class="fw-bolder"><?php echo $seller_d["email"]; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mt-4 mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-10 offset-1 mt-4 d-grid">
                                                                <a href="#" class="btn btn-sm btn-outline-success">Buy Now</a>
                                                            </div>
                                                            <div class="col-10 offset-1 d-grid">
                                                                <a href="#" class="btn btn-sm btn-outline-warning">Add Cart</a>
                                                            </div>
                                                            <div class="col-10 offset-1 d-grid">
                                                                <a class="btn btn-sm btn-outline-danger" onclick="deletefromwarchlist(<?php echo $wr['id']; ?>);">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                <?php
                                        }
                                    }
                                }
                                ?>
                                </div>
                            </div>
                    </div>
                </div>

                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

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