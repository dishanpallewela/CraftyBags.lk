<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $total = 0;

    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $_SESSION["u"]["email"] . "';");
    $cnum = $cartrs->num_rows;

    $orderID = uniqid();

    for ($x = 0; $x < $cnum; $x++) {

        $totalpr = $cartrs->fetch_assoc();

        $catqty[$x] = (int)$totalpr["qty"];

        // echo $catqty[$x]."///////////";

        $product = Database::search("SELECT * FROM `product` WHERE `id` = '" . $totalpr["product_id"] . "' ");
        $pr = $product->fetch_assoc();

        $price=$pr["price"];

        $dc[$x] = $pr["delivery_fee_colombo"];

        $do[$x] = $pr["delivery_fee_other"];

        $arr[$x] = $catqty[$x] * $price;

      
    }

    $total =  array_sum($arr);

    $umail = $_SESSION["u"]["email"];

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umail . "' ");
    $cn = $address_rs->num_rows;

    if ($cn == 1) {

        $ar = $address_rs->fetch_assoc();

        // location , district , province
        $rs1 = Database::search("SELECT city.id AS `cid`, city.name AS `c_name`, city.district_id, city.postal_code, district.id AS `did`, district.name AS `d_name`, district.province_id, province.id AS `pid`, province.name AS `p_name` FROM city JOIN district ON city.district_id = district.id JOIN province ON district.province_id = province.id WHERE city.id = '".$ar["city_id"]."';");

        $locr = $rs1->fetch_assoc();

        $delivery = "0";

        if ($locr["district_id"] == "3") {
            $delivery = array_sum($dc);
        } else {
            $delivery = array_sum($do);
        }

        $item = "Checkout Payment";
        $amount = $total + (int)$delivery;

        // fname , lname , mobile , address
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $ar["line1"] . " , " . $ar["line2"];

        // city
        $cityID = $locr["cid"];
        $city_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $cityID . "' ");
        $cityd = $city_rs->fetch_assoc();
        $city = $cityd["name"];

        $array;

        // array
        $array["id"] = $orderID;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["email"] = $umail;
        $array["mobile"] = $mobile;
        $array["address"] = $address;
        $array["city"] = $city;

        echo json_encode($array);
    } else {
        echo "2";
    }



    // echo $total;
} else {
    echo "1";
}