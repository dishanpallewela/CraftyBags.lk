<?php

session_start();
require "connection.php";

$text = $_GET["s"];

if ($text == "") {
    $productrs = Database::search("SELECT * FROM `product` ");
} else {
    $productrs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $text . "%' ");
}

$row = $productrs->num_rows;
$c = "0";
for ($i = 0; $i < $row; $i++) {
    $u = $productrs->fetch_assoc();

    $product_img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $u["id"] . "' ");
    $pin = $product_img->num_rows;
    // $pid = $product_img->fetch_assoc();

    $c = $c + 1;

?>

    <div class="row mt-1">
        <div class="col-lg-1 col-2 adminnav text-white fw-bold pt-2">
            <span><?php echo $c; ?></span>
        </div>
        <div class="col-lg-2 bg-light fw-bold d-none d-lg-block">
            <div class="row">
                <div class="col-6" onclick="singleviewmodal(<?php echo $u['id']; ?>);">
                    <?php
                    if ($pin > 0) {
                        $pid = $product_img->fetch_assoc();
                    ?>
                        <img src="<?php echo $pid["code"] ?>" class="img-fluid">
                    <?php
                    } else {
                    ?>
                        <img src="resources/no-image.jpg" class="img-fluid">
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-2 text-white fw-bold pt-2 d-none d-lg-block adminnav">
            <span><?php echo $u["title"]; ?></span>
        </div>
        <div class="col-lg-2 col-10 bg-light fw-bold pt-2">
            <span>Rs.<?php echo $u["price"]; ?>.00</span>
        </div>
        <div class="col-lg-2 adminnav text-white fw-bold pt-2 d-none d-lg-block">
            <span><?php echo $u["qty"]; ?></span>
        </div>
        <div class="col-lg-3 bg-light fw-bold pt-2 d-none d-lg-block">
            <div class="row">
                <div class="col-8">
                    <span><?php echo $u["datetime_added"]; ?></span>
                </div>
                <div class="col-4 d-grid text-end">
                    <button id="blockbtn<?php echo $u['id']; ?>" class="btn btn-danger" onclick="blockProduct(<?php echo $u['id']; ?>);">Block</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal singleproductview-->
    <div class="modal fade" id="singleproductview<?php echo $u["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $u["title"]; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <?php

                        $p_img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $u["id"] . "' ");
                        $pin = $p_img->num_rows;

                        if ($pin > 0) {
                            $imgd = $p_img->fetch_assoc();
                        ?>
                            <img src="<?php echo $imgd["code"]; ?>" class="img-fluid" style="height: 200px;">
                        <?php
                        } else {
                        ?>
                            <img src="resources/no-image.jpg" class="img-fluid" style="height: 200px;">
                        <?php
                        }
                        ?>
                    </div>
                    <div>
                        <span class="fs-6 fw-bold">Price : </span>&nbsp;
                        <span class="fs-6">Rs. <?php echo $u["price"]; ?> .00</span><br>
                        <span class="fs-6 fw-bold">Quantity : </span>&nbsp;
                        <span class="fs-6"><?php echo $u['qty']; ?> Items Left </span><br>
                        
                        <span class="fs-6 fw-bold">Description : </span>&nbsp;
                        <p class="fs-6"><?php echo $u['description']; ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php

}
