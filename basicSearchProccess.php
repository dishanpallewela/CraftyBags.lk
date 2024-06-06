<?php

require "connection.php";

$seachText = $_GET["t"];
$seachSelect = $_GET["s"];

$results_per_page = 4;

$pageno = $_GET["p"];
// $pageno = 1;

if (!empty($seachText) && $seachSelect == 0) {
    $product = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $seachText . "%' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $seachText . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;
} else if ($seachSelect != 0 && empty($seachText)) {
    $product = Database::search("SELECT * FROM `product` WHERE `category` = '" . $seachSelect . "' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::search("SELECT * FROM `product` WHERE `category` = '" . $seachSelect . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;
} else if (!empty($seachText) && $seachSelect != 0) {
    $product = Database::search("SELECT * FROM `product` WHERE `category` = '" . $seachSelect . "' AND `title` LIKE '%" . $seachText . "%' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::search("SELECT * FROM `product` WHERE `category` = '" . $seachSelect . "' AND `title` LIKE '%" . $seachText . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;
}

?>

<div class="col-md-12 text-center">
                        <br /><br /><br />
                        <hr />
                        <p class="fs-1 " style="font-family: 'Honey Script';">l a t e s t &nbsp;&nbsp; i t e m s</p>
                    </div>

<div class="col-12 mt-2">
    <div class="row border shadow mb-5">
        <div class="col-12 col-xl-10 offset-xl-1 col-xxl-8 offset-xxl-2" id="pdiv">
            <div class="row" id="pdeatails">
                <?php
                for ($i = 0; $i < $n; $i++) {
                    $pdeatail = $textSearch->fetch_assoc();
                ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mt-1 mb-2 ms-2" style="width: 15rem;">
                            <?php
                            $pimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdeatail["id"] . "' ");
                            $imgd = $pimg->fetch_assoc();
                            ?>
                            <img src="<?php echo $imgd["code"] ?>" class="cardTopImg" height="200px">
                            <div class="card-body">
                            <span class="badge bg-info ms-2">New</span><br><h5 class="card-title"><?php echo $pdeatail["title"]; ?></h5>
                                <span class="card-text text-primary">Rs. <?php echo $pdeatail["price"]; ?></span>
                                <br />
                                <?php
                                $pstatus = Database::search("SELECT * FROM `status` WHERE `id`='" . $pdeatail["status_id"] . "'");
                                $statusrow = $pstatus->fetch_assoc();

                                if ((int)$pdeatail["qty"] > 0) {
                                ?>

                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-1" value="<?php echo $pdeatail["qty"] ?>" />
                                    <a href="<?php echo "singleproductview.php?id=" . ($pdeatail['id']); ?>" class="btn btn-outline-success">Buy Now</a>
                                    <a href="#" class="btn btn-outline-dark">Add  Cart</a>
                                    <a href="#" class="btn btn-outline-secondary w-100 mt-2"><i class="bi bi-heart-fill" onclick='addToWatchList(<?php echo $prod["id"] ?>)'></i></a>

                                <?php
                                } else {
                                ?>
                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                    <br />
                                    <input type="number" class="form-control mb-1 d disabled" value="0" disabled />
                                    <a href="#" class="btn btn-outline-success disabled">Buy Now</a>
                                    <a href="#" class="btn btn-outline-dark">Add  Cart</a>
                                    <a href="#" class="btn btn btn-outline-secondary w-100 mt-2"><i class="bi bi-heart-fill" onclick='addToWatchList(<?php echo $prod["id"] ?>)'></i></a>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                <?php

                }

                ?>
                <!-- pagination -->
                <div class="col-12 mb-3 mt-3">
                    <div class="pagination d-flex justify-content-center">
                        <?php
                        if ($pageno != 1) {
                        ?>
                            <button class=" btn btn-secondary" onclick="basicSearch(<?php echo $pageno - 1; ?>);">&laquo;</button>
                            <?php
                        }

                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            if ($page == $pageno) {
                            ?>
                                <button class="ms-1 btn btn-dark active" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                            <?php
                            } else {
                            ?>
                                <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if ($pageno < $number_of_pages) {
                        ?>
                            <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $pageno + 1; ?>);">&raquo;</button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- pagination -->
            </div>
        </div>
    </div>
</div>