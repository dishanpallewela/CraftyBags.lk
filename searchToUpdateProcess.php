<?php

require "connection.php";

$array;

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    if (empty($id)) {

        echo "Please enter the prodcut id";
        
    } else {

        $prs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "' ");
        $n = $prs->num_rows;

        if ($n == 1) {

            $r = $prs->fetch_assoc();

            $array["id"] = $r["id"];
            $array["title"] = $r["title"];

            $crs = Database::search("SELECT * FROM `category` WHERE `id`= '" . $r["category"] . "' ");
            if($crs->num_rows == 1){
                $cr = $crs->fetch_assoc();
                $array["category"] = $cr["name"];
            }

            // $brs = Database::search("SELECT * FROM `brand` WHERE `id`= '" . $r["brand"] . "' ");

            // if($brs->num_rows == 1){
            //     $br = $brs->fetch_assoc();
            //     $array["brand"] = $br["name"];
            // }

            // $mrs = Database::search("SELECT * FROM `model` WHERE `id`= '" . $r["model"] . "' ");

            // if($mrs->num_rows == 1){
            //     $mr = $mrs->fetch_assoc();
            //     $array["model"] = $mr["name"];
            // }

            echo json_encode($array);

        } else {
            echo "Invalid Product ID";
        }
    }
}
