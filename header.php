<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="row">
        <div class="offset-lg-1 col-12 col-md-3 col-lg-4 align-self-start mt-2 mb-1">
            <span class="text-start label1"><b>Welcome
                    <?php

                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"]["fname"];
                        echo $user;
                    } else {
                    ?>
                        <a href="index.php">Hi! Sign in or Register</a>

                    <?php
                    }

                    ?></b>
            </span> |
            <span class="text-start label2">Help & Contact</span> |
            <?php

            if (isset($_SESSION["u"])) {
            ?>
                <span class="text-start" onclick="signout(); " style="cursor: pointer;">Sign Out</span>
            <?php
            } else {
            ?>
                <span class="text-start d-none" onclick="signout();" style="cursor: pointer;">Sign Out</span>

            <?php
            }

            ?>


        </div>
        <div class="col-12 col-lg-3 offset-lg-4 align-self-end" style="text-align: center;">

            <div class="row mt-2 mb-1">
                <!-- <div class="col-1 col-md-3 col-lg-3 mt-2">
                    <span class="text-start label2" onclick="goToAddProduct();">sell</span>
                </div> -->
                <div class="col-2 col-md-6 col-lg-6 dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="myeshop" data-bs-toggle="dropdown" aria-expanded="false">
                        My Deals
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                        <li><a class="dropdown-item" href="watchlist.php">My Watchlist</a></li>
                        <li><a class="dropdown-item" href="purchaseHistory.php">Purchase History</a></li>
                        <?php
                        if (isset($_SESSION["u"])) {
                        ?>
                            <li><a class="dropdown-item" href="messages.php?email=<?php echo $_SESSION["u"]["email"] ?>">Message</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" href="#">Saved</a></li>
                        <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="track.php">Track My Order</a></li>
                        <li><a class="dropdown-item" href="#">My Settings</a></li>
                    </ul>
                </div>

                <div class="col-1 col-md-3 col-lg-3 mt-1 ms-5 ms-lg-0 carticon" onclick="goToCart();"></div>
            </div>
        </div>
    </div>
    </div>
    <script src="script.js"></script>

</body>

</html>