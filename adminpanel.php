<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $admin = $_SESSION["a"];

?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo.svg">
        <title>CraftyBags.lk | Dashboard</title>

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows([
                    // ['Mushrooms', 3],
                    // ['Onions', 1],
                    // ['Olives', 1],
                    // ['Zucchini', 1],
                    // ['Pepperoni', 2]
                    ['Harry Potter', 3],
                    ['BOHO', 1],
                    ['GOT', 1],
                    ['class bag', 1],
                    ['plain bag', 2]
                ]);

                // Set chart options
                var options = {
                    'title': 'How many product we sells whole time',
                    'width': 400,
                    'height': 300
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2 ">
                    <div class="row">

                        <div class="d-flex align-items-start adminnav vh-100">
                            <div class="col-12 text-center text-lg-start">

                                <label class="form-label fs-3 text-white mt-5 fw-bold"><?php echo $admin["fname"] . " " . $admin["lname"]; ?></label>
                                <hr class="text-white">
                                <nav class="nav flex-column ">
                                    <a class="nav-link text-white fs-5 active btn btn-success " aria-current="page" href="#">Dashboard</a>
                                    <a class="nav-link text-white fs-5 anv" href="manageusers.php">Manage Users</a>
                                    <a class="nav-link text-white fs-5 anv" href="addproduct.php">Add Products</a>
                                    <a class="nav-link text-white fs-5 anv" href="sellerProductView.php">Manage Products</a>
                                    <a class="nav-link text-white fs-5 anv" href="neworder.php">New Orders</a>
                                    <a class="nav-link text-white fs-5 anv" href="compltedorders.php">Completed Orders</a>
                                </nav>
                                <hr class="text-white">
                                <a href="#" class="form-label text-white fw-bold text-decoration-none">Selling History</a>
                                <hr class="text-white">
                                <span class="text-white">From date</span>
                                <input class="form-control" type="date" placeholder="Search From..." id="fromdate">
                                <span class="text-white">To date</span>
                                <input class="form-control mt-1" type="date" placeholder="Search To..." id="todate">

                                <div class="row">
                                    <div class="col-12  d-grid">
                                        <a href="" id="historylink" class="btn btn-primary mt-1" onclick="dailySellings();">View Selling</a>
                                    </div>
                                </div>

                                <!-- <hr class="text-white">
                                <a href="#" class="form-label text-white fw-bold text-decoration-none" onclick="dailySellings();">Daily Selling</a> -->
                                <hr class="text-white">
                                <hr class="text-white">

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label text-success fw-bold fs-3 mt-2">Dashboard</label>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="row row-cols-1 row-cols-md-3 g-1">

                                <div class="col">
                                    <div class="card h-100 bg-white border shadow">
                                        <div class="card-body  text-center">
                                            <h5 class="card-title fw-bold">Daily Earnings</h5>

                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoicers = Database::search("SELECT * FROM `invoice` ");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {
                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];
                                                $splitdate = explode(" ", $d);
                                                $pdate = $splitdate[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $ir["total"];

                                                    $c = $c + $ir["qty"];
                                                }

                                                $spiltmonth = explode("-", $d);
                                                $pyear = $spiltmonth[0];
                                                $pmonth = $spiltmonth[1];

                                                // if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth && $pyear == $thisyear) {
                                                    $b = $b + $ir["total"];
                                                    $e = $e + $ir["qty"];
                                                }
                                                // }


                                            }

                                            ?>

                                            <p class="card-text">Rs.<?php echo $a; ?>.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-white">
                                        <div class="card-body text-dark text-center">
                                            <h5 class="card-title fw-bold">Mothly Earnings</h5>
                                            <p class="card-text">Rs.<?php echo $b; ?>.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-white border shadow">
                                        <div class="card-body text-dark text-center">
                                            <h5 class="card-title fw-bold">Today Selling</h5>
                                            <p class="card-text"><?php echo $c; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-white border shadow">
                                        <div class="card-body text-dark text-center">
                                            <h5 class="card-title fw-bold">Mothly Selling</h5>
                                            <p class="card-text"><?php echo $e; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-white border shadow">
                                        <div class="card-body text-dark text-center">
                                            <h5 class="card-title fw-bold">Total Selling</h5>
                                            <p class="card-text"><?php echo $f; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-success">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Total Engagements</h5>

                                            <?php

                                            $usersrs = Database::search("SELECT * FROM `users` ");
                                            $un = $usersrs->num_rows;

                                            ?>

                                            <p class="card-text"><?php echo $un; ?> Members</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="mt-3">

                        <div class="col-12 p-3 adminnav">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center">
                                    <span class="text-white fw-bold">Total Active Time</span>
                                </div>

                                <?php

                                $startdate = new DateTime("2021-10-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:I:s"));

                                $difference = $endDate->diff($startdate);

                                ?>

                                <div class="col-12 col-lg-10 text-end">
                                    <span class="text-white fw-bold">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%M') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%I') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-5">
                            <div class="row g-4">

                                <div class="offset-1 col-10 col-lg-4 mt-3 rounded bg-light border shadow">
                                    <div class="row g-1">

                                        <?php

                                        $freq = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                                        FROM `invoice` WHERE `date` LIKE '%" . $today . "%' ");

                                        $freqnum = $freq->num_rows;

                                        for ($z = 0; $z < $freqnum; $z++) {
                                            $freqrow = $freq->fetch_assoc();

                                            $msp = $freqrow["product_id"];


                                            $prs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $msp . "' ");
                                            $pd = $prs->fetch_assoc();

                                            $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $msp . "' ");
                                            $i = $imgrs->fetch_assoc();
                                        }

                                        ?>

                                        <div class="col-10 text-center">
                                            <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                        </div>
                                        <div class="col-2 text-start">
                                            <img src="resources/batch.svg" class="img-fluid" height="100px">
                                        </div>
                                        <div class="col-8">
                                            <div style="width: 200px; height: 250px; background-image: url('<?php echo $i["code"]; ?>'); " class="im"></div>
                                            <br>
                                        </div>
                                        <div class="col-4 text-start">
                                            <span class="fs-5 fw-bold"><?php echo $pd["title"]; ?></span><br>
                                            <span class="fs-6"><?php echo $e; ?> Items</span><br>
                                            <span class="fs-6">Rs.<?php echo $pd["price"]; ?>.00</span>
                                        </div>
                                        <!-- <div class="col-4 offset-4">
                                            <img src="resources/batch.svg" class="img-fluid">
                                        </div> -->
                                    </div>
                                </div>

                                <div class="offset-1 col-10 col-lg-4 mt-3 rounded bg-light border shadow">
                                    <div class="row">
                                        <!--Div that will hold the pie chart-->
                                        <div id="chart_div"></div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>not found</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <img src="resources/notfound.jpg" class="notfound vh-100">
                </div>
            </div>
        </div>
    </body>

    </html>

<?php

}

?>