<?php
session_start();

$cid =  $_GET["id"];

?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CraftyBags.lk | Home</title>
    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header -->

            <?php

            require "header.php";
            require "connection.php";

            ?>

            <!-- header -->

            <!-- search bar -->
            <div class="col-12 justify-content-center">
                <div class="row">
                    <div class="offset-lg-1 col-lg-1 offset-5 col-2 logoimg"></div>
                    <div class="col-6">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_text">

                            <select class="btn btn-outline-success" id="basic_search_category">
                                <option value="0">Select Category</option>
                                <?php

                                $rs = Database::search("SELECT * FROM category;");

                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {

                                    $cat = $rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-success mt-3 searchbtn" onclick="basicSearch(1);">Search</button>
                    </div>
                    <div class="col-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link1">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- search bar -->

            <hr class="hrbreak1">

            <!-- category slde -->

            <div class="col-10 offset-1">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br /><br />
                        <hr />
                        <p class="fs-1" style="font-family: 'Honey Script'; font-size: 50px;">a l l &nbsp;&nbsp; c a t e g o r i e s</p>
                    </div>
                </div>
                <div class="row">
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel" data-interval="1000">
                        <div class="MultiCarousel-inner">

                            <?php

                            $categoryrs = Database::search("SELECT * FROM category");
                            $crow = $categoryrs->num_rows;

                            for ($i = 0; $i < $crow; $i++) {
                                $category = $categoryrs->fetch_assoc();
                            ?>
                                <div class="item border shadow">
                                    <div class="pad15" onclick="allcategory(<?php echo $category['id'] ?>)">
                                        <p class="lead"><?php echo $category["name"] ?></p>

                                        <?php

                                        $cimgrs = Database::search("SELECT * FROM images 
                                                                INNER JOIN product ON images.product_id = product.id 
                                                                INNER JOIN category ON product.category = category.id 
                                                                WHERE product.category = '" . $category["id"] . "' ORDER BY product.datetime_added ASC LIMIT 1 ;");

                                        $cimg = $cimgrs->fetch_assoc();
                                        ?>

                                        <img src="<?php echo $cimg["code"] ?>" class="cimg col-12" height="200px">




                                    </div>
                                </div>
                            <?php
                            }

                            ?>

                        </div>
                        <button class="btn btn-primary leftLst">
                            < </button>
                                <button class="btn btn-primary rightLst">></button>
                    </div>
                </div>
                
            </div>

            <!-- category slde -->

            <!-- product title view -->
                <div id="product_view_div">
                <div class="col-md-12 text-center">
                        <br /><br /><br />
                        <hr />
                        <?php 
                        
                        $crs = Database::search("SELECT * FROM `category` WHERE id = '".$cid."' ");
                        $c = $crs->fetch_assoc();
                        
                        ?>
                        <p class="fs-1 " style="font-family: 'Honey Script';">latest items</p>
                    </div>
                    

                    <?php

                    $resultset = Database::search("SELECT * FROM `product` WHERE `category`='" . $cid . "' AND `status_id` = '1' ORDER BY `datetime_added` DESC ");
                    ?>

                    <!-- product view -->

                    <div class="col-12">
                        <div class="row border shadow">
                            <div class="col-10 offset-1">
                                <div class="row" id="pdetails">

                                    <?php

                                    $nr = $resultset->num_rows;
                                    for ($y = 0; $y < $nr; $y++) {
                                        $prod = $resultset->fetch_assoc();

                                    ?>

                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="card mt-5 offset-md-3" style="width: 15rem;">

                                                <?php

                                                $pimage = Database::search("SELECT * FROM `images` WHERE product_id = '" . $prod["id"] . "'; ");
                                                $imgrow = $pimage->fetch_assoc();

                                                ?>
                                                <img src="<?php echo $imgrow["code"]; ?>" class="card-img-top" height="250px">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $prod["title"]; ?> <span class="badge bg-info">New</span></h5>
                                                    <span class="card-text text-primary">Rs.<?php echo $prod["price"]; ?></span>
                                                    <br>

                                                    <?php

                                                    if ((int)$prod["qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning"><b>In Stock</b></span>
                                                        <input value="1" min="0" type="number" class="form-control mb-1" id="qtytxt<?php echo $prod['id']; ?>">
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod["id"]) ?>" class="btn btn-outline-success">Buy Now</a>
                                                        <a href="#" class="btn btn-outline-dark" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                                        <a href="#" class="btn btn-outline-secondary w-100 mt-2" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                        <input value="1" type="number" class="form-control mb-1" disabled>
                                                        <a href="#" class="btn btn-outline-success disabled">Buy Now</a>
                                                        <a href="#" class="btn btn-outline-danger disabled">Add To Cart</a>
                                                        <a href="#" class="btn btn-outline-secondary w-100 mt-2" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        

                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- product view -->
                
                </div>
                <!-- product title view -->

                <!-- footer -->
                <?php

                require "footer.php";

                ?>
                <!-- footer -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>