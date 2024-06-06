<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $u = $_SESSION["u"];
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">

        <title>CraftyBags.lk | User Profile</title>
    </head>

    <body class="adminnav">

        <div class="container-fluid bg-white rounded mt-5">
            <div class="row">

                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php

                        $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $u["email"] . "';");
                        $pn = $profileimg->num_rows;

                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                        ?>
                            <img class="rounded-circle mt-5" width="150px" src="<?php echo $p["code"]; ?>">
                        <?php
                        } else {
                        ?>
                            <img class="rounded-circle mt-5" width="150px" src="resources/demoProfileImg.jpg">
                        <?php
                        }

                        $userrs = Database::search("SELECT * FROM `users` WHERE email = '" . $u["email"] . "'; ");
                        $user = $userrs->fetch_assoc();
                        ?>

                        <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>
                        <span class="text-black-50"><?php echo $u["email"]; ?></span>
                        <input type="file" id="profileimg" accept="img/*" class="d-none">
                        <label for="profileimg" class="btn btn-primary mt-3">Update Profile Image</label>
                    </div>
                </div>
                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 g-2">
                                <label class="form-label">Name</label>
                                <input id="fname" type="text" class="form-control shadow-none" placeholder="First name" value="<?php echo $user["fname"]; ?>">
                            </div>
                            <div class="col-md-6 g-2">
                                <label class="form-label">Surname</label>
                                <input id="lname" type="text" class="form-control shadow-none" placeholder="Last name" value="<?php echo $user["lname"]; ?>">
                            </div>
                            <div class="col-md-12 g-2">
                                <label class="form-label">Mobile Number</label>
                                <input id="mobile" type="text" class="form-control shadow-none" placeholder="Enter phone number" value="<?php echo $user["mobile"]; ?>">
                            </div>
                            <div class="col-md-12 g-2">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control shadow-none" placeholder="Enter password" readonly value="<?php echo $u["password"]; ?>">
                            </div>
                            <div class="col-md-12 g-2">
                                <label class="form-label">Email Address</label>
                                <input id="email" type="email" class="form-control shadow-none" placeholder="Enter email id" value="<?php echo $u["email"]; ?>" readonly>
                            </div>
                            <div class="col-md-12 g-2">
                                <label class="form-label">Registered Date & Time</label>
                                <input type="text" class="form-control shadow-none" placeholder="Registered date" value="<?php echo $u["register_date"]; ?>" readonly>
                            </div>

                            <?php

                            $useremail = $u["email"];
                            $address = Database::search("SELECT * FROM user_has_address WHERE user_email = '" . $useremail . "';");
                            $n = $address->num_rows;

                            if ($n == 1) {

                                $d = $address->fetch_assoc();

                            ?>

                                <div class="col-md-12 g-2">
                                    <label class="form-label">Address line 01</label>
                                    <input id="line1" type="text" class="form-control shadow-none" placeholder="Enter address line 01" value="<?php echo $d["line1"]; ?>">
                                </div>

                                <div class="col-md-12 g-2">
                                    <label class="form-label">Address line 02</label>
                                    <input id="line2" type="text" class="form-control shadow-none" placeholder="Enter address line 02" value="<?php echo $d["line2"]; ?>">
                                </div>


                                <?php

                                $cityid = $d["city_id"];
                                $ucity = Database::search("SELECT * FROM `city` WHERE `id` = '" . $cityid . "';");
                                $c = $ucity->fetch_assoc();

                                $districtid = $c["district_id"];
                                $udist = Database::search("SELECT * FROM `district` WHERE `id`='" . $districtid . "' ");
                                $k = $udist->fetch_assoc();

                                $provinceid = $k["province_id"];
                                $uprovince = Database::search("SELECT * FROM `province` WHERE `id`='" . $provinceid . "' ");
                                $l = $uprovince->fetch_assoc();

                                ?>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">Province</label>
                                    <select id="province" class="form-control shadow-none">
                                        <option value="<?php echo $l["id"]; ?>"><?php echo $l["name"]; ?></option>

                                        <?php

                                        $provincers = Database::search("SELECT * FROM `province` WHERE `id`!='" . $l["id"] . "' ");
                                        $pn = $provincers->num_rows;

                                        for ($i = 0; $i < $pn; $i++) {
                                            $pr = $provincers->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">District</label>
                                    <select id="district" class="form-control shadow-none">
                                        <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>

                                        <?php

                                        $districts = Database::search("SELECT * FROM `district`WHERE `id`!='" . $k["id"] . "' ");
                                        $dn = $districts->num_rows;

                                        for ($i = 0; $i < $dn; $i++) {
                                            $dr = $districts->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">City</label>
                                    <input id="city" type="text" class="form-control shadow-none" placeholder="City" value="<?php echo $c["name"]; ?>">
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">Postal Code</label>
                                    <input id="city" type="text" class="form-control shadow-none" placeholder="Enter yor Postal Code" value="<?php echo $c["postal_code"]; ?>">
                                </div>

                            <?php
                            } else {
                            ?>

                                <div class="col-md-12 g-2">
                                    <label class="form-label">Address line 01</label>
                                    <input id="line1" type="text" class="form-control shadow-none" placeholder="Enter address line 01" value="">
                                </div>

                                <div class="col-md-12 g-2">
                                    <label class="form-label">Address line 02</label>
                                    <input id="line2" type="text" class="form-control shadow-none" placeholder="Enter address line 02" value="">
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">Province</label>
                                    <select id="province" class="form-control shadow-none">

                                        <?php
                                        $provincers = Database::search("SELECT * FROM `province`");
                                        $pr = $provincers->num_rows;

                                        for ($i = 1; $i < $pr+1; $i++) {
                                            $province = $provincers->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $i ?>"><?php echo $province["name"] ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">District</label>
                                    <select id="district" class="form-control shadow-none">
                                        <option value="">Kaluthara</option>
                                        <option value="">Colombo</option>
                                        <option value="">Galle</option>
                                        <option value="">Kandy</option>
                                        <option value="">Gampaha</option>
                                    </select>
                                </div>

                                <div class="col-md-6 g-2">
                                    <label class="form-label">City</label>
                                    <input id="city" type="text" class="form-control shadow-none" placeholder="City" value="">
                                </div>


                                <div class="col-md-6 g-2">
                                    <label class="form-label">Postal Code</label>
                                    <input id="city" type="text" class="form-control shadow-none" placeholder="Enter yor Postal Code" value="">
                                </div>

                            <?php
                            }

                            ?>



                            <div class="col-md-6 g-2">
                                <label class="form-label">Gender</label>
                                <?php

                                $genderid = $u["gender"];
                                $ugender = Database::search("SELECT * FROM `gender` WHERE `id` = '" . $genderid . "';");
                                $g = $ugender->fetch_assoc();

                                ?>
                                <input type="text" class="form-control shadow-none" placeholder="Gender" value="<?php echo $g["name"]; ?>" readonly>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">User Rating</span>
                                <span class="fa fa-star checked text-warning"></span>
                                <span class="fa fa-star checked text-warning"></span>
                                <span class="fa fa-star checked text-warning"></span>
                                <span class="fa fa-star checked text-warning"></span>
                                <span class="fa fa-star checked text-black-50"></span>
                                <p class="">4.1 average bassed on 254 reviews</p>
                                <hr class="text-secondary">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <span>5 star</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-end fw-normal">150</h6>
                                    </div>
                                    <div class="col-12">
                                        <span>4 star</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-end fw-normal">63</h6>
                                    </div>
                                    <div class="col-12">
                                        <span>3 star</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-end fw-normal">15</h6>
                                    </div>
                                    <div class="col-12">
                                        <span>2 star</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-end fw-normal">06</h6>
                                    </div>
                                    <div class="col-12">
                                        <span>1 star</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-end fw-normal">20</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                require "footer.php";
                ?>

            </div>
        </div>




        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>

<?php
} else {
?>
    <script src="script.js"></script>
    <script>
        goToIndex();
    </script>
<?php
}


?>