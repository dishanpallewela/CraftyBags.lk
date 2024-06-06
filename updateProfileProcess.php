<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $city = $_POST["c"];
    if (isset($_FILES["i"])) {
        $image = $_FILES["i"];
    }
    
    if (empty($fname)) {
        echo "Please enter your first name";
    } elseif (strlen($fname) > 50) {
        echo "First name must be less than 50 characters";
    } elseif (empty($lname)) {
        echo "Please enter your last name";
    } elseif (strlen($lname) > 50) {
        echo "Last name must be less than 50 characters";
    } elseif (empty($mobile)) {
        echo "Please enter your mobile";
    } elseif (strlen($mobile) != 10) {
        echo "Please enter 10 digit mobile number";
    } elseif (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Invalid mobile number";
    } elseif (empty($line1)) {
        echo "Please enter your address line 01";
    } elseif (empty($city)) {
        echo "Please select your city";
    } else {
        Database::iud("UPDATE `users` SET `fname` = '" . $fname . "', `lname` = '" . $lname . "',`mobile` = '" . $mobile . "' WHERE `email` = '" . $_SESSION["u"]["email"] . "' ");
        echo  "updated";

        

        $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
        $nr = $address->num_rows;

        if ($nr == 1) {
            // update

            $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
            $unr = $ucity->fetch_assoc();

            Database::iud("UPDATE `user_has_address` SET 
            `line1` = '" . $line1 . "'
            , `line2` = '" . $line2 . "'
            , `city_id` = '" . $unr["id"] . "' ");



            $upimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
            $upin = $upimg->num_rows;

            if ($upin == 1) {

                $last_id = Database::$connection->insert_id;

                if (isset($_FILES["i"])) {
                    $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                    $fileex = $image["type"];

                    if (!in_array($fileex, $allowed_image_extention)) {
                        echo "Please Select a valid image";
                    } else {

                        $newimgextension;

                        if ($fileex = "image/jpeg") {
                            $newimgextension = ".jpeg";
                        } elseif ($fileex = "image/jpg") {
                            $newimgextension = ".jpg";
                        } elseif ($fileex = "image/png") {
                            $newimgextension = ".png";
                        } elseif ($fileex = "image/svg") {
                            $newimgextension = ".svg";
                        }

                        $file_name = "resources//profile_imgs//" . uniqid() . $newimgextension;

                        // echo $file_name;

                        move_uploaded_file($image["tmp_name"], $file_name);
                        Database::iud("UPDATE `profile_img` SET `code` = '" . $file_name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                    }
                }
            } else {

                $last_id = Database::$connection->insert_id;

                if (isset($_FILES["i"])) {
                    $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                    $fileex = $image["type"];

                    if (!in_array($fileex, $allowed_image_extention)) {
                        echo "Please Select a valid image";
                    } else {

                        $newimgextension;

                        if ($fileex = "image/jpeg") {
                            $newimgextension = ".jpeg";
                        } elseif ($fileex = "image/jpg") {
                            $newimgextension = ".jpg";
                        } elseif ($fileex = "image/png") {
                            $newimgextension = ".png";
                        } elseif ($fileex = "image/svg") {
                            $newimgextension = ".svg";
                        }

                        $file_name = "resources//profile_imgs//" . uniqid() . $newimgextension;

                        // echo $file_name;

                        move_uploaded_file($image["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) 
                    VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "')");
                    }
                } else {
                    echo "Please Select an Image";
                }
            }
            echo "Success";
        } else {
            // add new

            $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
            $unr = $ucity->fetch_assoc();

            Database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`city_id`) VALUES 
            ('" . $_SESSION["u"]["email"] . "','" . $line1 . "','" . $line2 . "','" . $unr["id"] . "') ");

            echo "Success";
        }
    }
}
