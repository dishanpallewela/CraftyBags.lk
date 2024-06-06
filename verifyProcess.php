<?php

session_start();
require "connection.php";

$v = $_GET["v"];

if (isset($_GET["v"])) {

    if (empty($v)) {
        echo "Please enter your varification code";
    } else {

        $vrs = Database::search("SELECT * FROM `admin` WHERE `verification` = '" . $v . "' ");
        $vn = $vrs->num_rows;

        if ($vn == 1) {

            $ar = $vrs->fetch_assoc();
            $_SESSION["a"] = $ar;

            echo "Success";
        } else {
            echo "Invalid Verification Code";
        }
    }
} else {
    echo "Please enter your varification code";
}
