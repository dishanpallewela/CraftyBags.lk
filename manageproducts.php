<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <title>CraftyBags.lk | Manage Products</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body onload="searchProduct();" >

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-success">Manage All Products</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-outline-success" onclick="searchProduct();">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-lg-1 col-2 bg-success text-white fw-bold p-2">
                        <span>#</span>
                    </div>
                    <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                        <span>Products Image</span>
                    </div>
                    <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Title</span>
                    </div>
                    <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                        <span>Price</span>
                    </div>
                    <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Qunatity</span>
                    </div>
                    <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                        <span>Registered Date</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2 mb-3" id="viewProduct"></div>

            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $prs = Database::search("SELECT * FROM `product` ");
            $d = $prs->num_rows;

            $row = $prs->fetch_assoc();

            $results_per_page = 20;

            $number_of_pages = ceil( $d / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;

            $selectedrs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

            $srn = $selectedrs->num_rows;

            // $c = "0";

            while ($srow = $selectedrs->fetch_assoc()) {

                // $c = $c + 1;
            ?>

                <div class="col-12 mt-2 mb-3" id="userView"></div>

            <?php
            }
            ?>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="text-center">
                        <div class="pagination">
                            <a href="<?php

                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }

                                        ?>">&laquo;</a>

                            <?php

                            for ($page = 1; $page <= $number_of_pages; $page++) {
                                if ($page == $pageno) {
                            ?>
                                    <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                <?php
                                } else {
                                ?>
                                    <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                            <?php
                                }
                            }

                            ?>

                            <a href="<?php

                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }


                                        ?>">&raquo;</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

            <div class="col-12">
                <h3 class="text-primary">Manage Categories</h3>
            </div>



            <hr>

            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php

                    $categoryrs = Database::search("SELECT * FROM `category`");
                    $num = $categoryrs->num_rows;

                    for ($i = 0; $i < $num; $i++) {

                        $row = $categoryrs->fetch_assoc();
                    ?>
                        <div class="col-12 col-lg-3">
                            <div class="row g-1 px-1">
                                <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                    <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"]; ?></label>
                                </div>
                            </div>
                        </div>
                    <?php
                    }


                    ?>



                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                <div class="row">
                                    <div class="col-3 mt-3 addnewimg"></div>
                                    <div class="col-9" onclick="addnewmodal();">
                                        <label class="form-label fs-4 fw-bold py-3 text-black-50">Add New Category</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    
            <!-- Modal add category-->
            <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <label class="form-label">Category</label>
                           <input type="text" class="form-control" id="categorytxt">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCategory()">Save Category</button>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>