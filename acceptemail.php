<?php

require "connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["email"])) {
    $e = $_GET["email"];
    $id = $_GET["id"];
    $code = $_GET["code"];

    $prs = Database::search("SELECT * FROM `product` WHERE id = '".$id."' ");
    $p = $prs->fetch_assoc();

    $irs = Database::search("SELECT * FROM `invoice` WHERE product_id = '".$id."' ");
    $i = $irs->fetch_assoc();

    $imgrs =  Database::search("SELECT * FROM `images` WHERE product_id = '".$id."' ");
    $img = $imgrs->fetch_assoc();

    if (empty($e)) {
        echo "Please enter your email address";
    } else {

        $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $e . "' ");

        if ($rs->num_rows == 1) {

            //email code

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; // gmail acc ekkin dnwnm oya thiyen ek nttn methanata gnn host ek hri domain ek hri denn
            $mail->SMTPAuth = true;
            $mail->Username = 'dpallewela2@gmail.com'; // ywn gmail acc eke username ek server eken dena username ek
            $mail->Password = 'dishan.2000.'; // ywn gmail acc eke password server eke password ek
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dpallewela2@gmail.com', 'CraftyBags.lk');
            $mail->addReplyTo('dpallewela2@gmail.com', 'CraftyBags.lk');
            $mail->addAddress($e); // yawana ona kenage address ek
            $mail->isHTML(true);
            $mail->Subject = 'order Accepted';
            $bodyContent = ' your has been accepted ... it is being prepared. <br/> <b>order details</b>
            ';
            $bodyContent .= ' 
            <p style="color:black"; font-weight: bold; >Product title - <b>'.  $p["title"] . ' bag </b> <br/> Quantity - <b>'.  $i["qty"] . '</b> <br/> Price - <b>'.  $i["total"] . '</b> <br/>Thank you.</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail';
            } else {
                echo 'Success';
            }

            //email code

        } else {
            echo "Email address not found";
        }
    }
} else {
    echo "Please enter your email address";
}
