<?php

session_start();
require "connection.php";

$ctxt = $_GET["c"];

if (isset($_SESSION["a"])) {

    if (empty($ctxt)) {

        echo "Please enter a Category";
    } else {

        $categoryrs  = Database::search("SELECT * FROM `category` WHERE `name` LIKE '" . $ctxt . "' ");
        $categorn = $categoryrs->num_rows;

        if ($categorn == 1) {
            echo "This Category already exsits";
        } else {
            Database::iud("INSERT INTO `category` (`name`)values ('" . $ctxt . "') ");
            echo "success";
        }
    }
}
