<?php

session_start();

if (isset($_SESSION["a"])) {
    ?>
    <script src="script.js"></script>
    <script>window.location = "adminpanel.php"</script>
    <?php
} else {
   ?>
  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CraftyBags.lk | Admins</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="adminsigninbg">

    <div class="container-fluid justify-content-center" style="margin-top: 200px;">
        <div class="row align-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-4 offset-8 ">
                        <div class="logoimg "></div>
                    </div>
                    <div class="col-6 offset-6">
                        <p class="text-center title1">Hi, Welcome To Admins</p>
                    </div>
                </div>

                <div class="col-12 p-3">
                    <div class="row">
                        <!-- <div class="col-6 d-none d-lg-block background"></div> -->
                        <div class="col-12 offset-lg-6 col-lg-6 d-block  p-5">
                            <div class="row g-3">
                                <div class="col-12 ">
                                    <p class="title2">Sign In To Your Account.</p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" id="e">
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-outline-success" onclick="adminVerification();">Send Verification code to Log In</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-outline-danger">Back To user's Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy;2021, CraftyBags.lk All Right Reserved</p>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="verificationmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Enter The Verification code you gotby an email</label>
                    <input type="text" class="form-control" id="v">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="verify();">Verify</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php
}


?>