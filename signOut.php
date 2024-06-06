<?php

session_start();

if (isset($_SESSION["u"])) {
    $_SESSION["u"] = null;
    session_destroy();

    setcookie("e", "", -1);
    setcookie("p", "", -1);

    echo "Success";
}
