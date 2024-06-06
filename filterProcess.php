<?php

session_start();

$user = $_SESSION["u"];

require "connection.php";

$aray;

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

// echo $search;
// echo $age;
// echo $qty;
// echo $condition;

if (!empty($search) && $age != 0) {

    if ($age == 1) {

        $prs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' AND `title` 
        LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC; ");

        $ans = $prs->num_rows;

        for ($i = 0; $i < $ans; $i++) {

            $aray[$i] = $prs->fetch_assoc();
        }

        echo json_encode($aray);
    } elseif ($age == 2) {

        $prs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' AND `title` 
        LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC; ");

        $ans = $prs->num_rows;

        for ($i = 0; $i < $ans; $i++) {

            $aray[$i] = $prs->fetch_assoc();
        }

        echo json_encode($aray);
    }
} elseif (!empty($search)) {

    $products = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' AND `title` 
    LIKE '%" . $search . "%' ");
    $pn = $products->num_rows;

    for ($x = 0; $x < $pn; $x++) {

        $aray[$x] = $products->fetch_assoc();

        $productimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_id . "' ");

        if ($productimg->num_rows == 1) {

            $img = $productimg->fetch_assoc();

            $array["img"] = $img["code"];
        }
    }

    echo json_encode($aray);
} elseif ($age != 0) {

    if ($age == 1) {

        $page = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ORDER BY `datetime_added` DESC ");
        $an = $page->num_rows;

        for ($i = 0; $i < $an; $i++) {

            $aray[$i] = $page->fetch_assoc();
        }

        echo json_encode($aray);
    } elseif ($age == 2) {

        $page = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ORDER BY `datetime_added` ASC ");
        $an = $page->num_rows;

        for ($i = 0; $i < $an; $i++) {

            $aray[$i] = $page->fetch_assoc();
        }

        echo json_encode($aray);
    }
} elseif ($qty != 0) {

    if ($qty == 1) {

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ORDER BY `qty` ASC ");
        $qn = $qtyrs->num_rows;

        for ($i = 0; $i < $qn; $i++) {

            $aray[$i] = $qtyrs->fetch_assoc();
        }

        echo json_encode($aray);
    } elseif ($qty == 2) {

        $pqtyrsaqtyrsge = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ORDER BY `qty` DESC ");
        $qn = $qtyrs->num_rows;

        for ($i = 0; $i < $qn; $i++) {

            $aray[$i] = $qtyrs->fetch_assoc();
        }

        echo json_encode($aray);
    }
}
