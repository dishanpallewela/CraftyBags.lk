<?php 
session_start();
if (isset($_SESSION["u"])) {
    ?>
    <script src="script.js"></script>
    <script>window.location = "home.php"</script>
    <?php
} else {
    ?>

<!DOCTYPE html>

<html>

<head>
    <title>CraftyBags.lk</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body >

    <div class="container-fluid vh-100 d-flex justify-content-center">

        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to CraftyBags.lk</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 px-5">
                <div class="row">

                    <!-- <div class="col-6  d-lg-block background">
                    </div> -->

                    <div class="col-12 offset-lg-3 col-lg-6 border shadow d-none" id="signUpBox" >
                        <div class="row g-2">

                            <div class="col-12 ">
                                <p class="title2 mt-2">Create New Account</p>
                                <p id="msg" class="text-danger"></p>
                            </div>

                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" id="fname">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="lname">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" id="mobile">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">

                                    <?php

                                    require "connection.php";

                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;
                                    for ($i = 0; $i < $n; $i++) {
                                        $d = $r->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid mb-3">
                                <button class="btn btn-success" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid mb-3">
                                <button class="btn btn-outline-dark" onclick="changeView();">Already have an account? Sign In</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 offset-lg-3 col-lg-6 border shadow" id="signInBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title2 mt-3">Sign In To Your Account</p>
                                <p id="msg2" class="text-danger"></p>
                            </div>

                            <div class="col-12">

                                <?php

                                $e = "";
                                $p = "";

                                if (isset($_COOKIE["e"])) {
                                    $e = $_COOKIE["e"];
                                }

                                if (isset($_COOKIE["p"])) {
                                    $p = $_COOKIE["p"];
                                }

                                ?>

                                <label class="form-label">Email</label>
                                <input class="form-control" value="<?php echo $e; ?>" type="email" id="email2">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" value="<?php echo $p; ?>" type="password" id="password2">
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remember">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-6 text-end">
                                <a href="#" class="link-primary " onclick="forgotPassword();">Forgot Pasword?</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-success mb-3" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-outline-danger mb-3" onclick="changeView();">New to Shop? Join Now</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- content -->

            <!-- footer -->
            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy; 2021 CraftyBags.lk All Right Reserved</p>
            </div>
            <!-- footer -->

            <!-- modal -->
            <div class="modal fade" tabindex="-1" id="forgetPasswordModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Password Reset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="password" id="np">
                                        <button class="btn btn-outline-primary" type="button" id="npb" onclick="showPassword1();">Show</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="password" id="rnp">
                                        <button class="btn btn-outline-primary" id="rnpb" onclick="showPassword2();" type="button">Show</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input class="form-control" type="text" id="vc">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>

<?php
}
?>