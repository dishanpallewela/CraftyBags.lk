<?php

session_start();
require "connection.php";

$text = $_GET["s"];

if ($text == "") {
    $userrs = Database::search("SELECT * FROM `users` ");
} else {
    $userrs = Database::search("SELECT * FROM `users` WHERE `email` LIKE '%" . $text . "%' ");
}

$row = $userrs->num_rows;
$c = "0";
for ($i = 0; $i < $row; $i++) {
    $u = $userrs->fetch_assoc();
    $c = $c + 1;

    $user_image = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $u["email"] . "' ");
    $uin = $user_image->num_rows;

?>

    <div class="row mt-1">
        <div class="col-lg-1 col-2 adminnav text-white fw-bold pt-2" onclick="viewmsgmodal();">
            <span><?php echo $c; ?></span>
        </div>
        <div class="col-lg-2 bg-light fw-bold d-none d-lg-block">
            <div class="row">
                <div class="col-4">

                    <?php
                    if ($uin > 0) {
                        $uid = $user_image->fetch_assoc();
                    ?>
                        <img src="<?php echo $uid["code"] ?>" class="img-fluid">
                    <?php
                    } else {
                    ?>
                        <img src="resources/emptyPofileImage.png" class="img-fluid">
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-lg-2 adminnav text-white fw-bold pt-2 d-none d-lg-block">
            <span><?php echo $u["email"]; ?></span>
        </div>
        <div class="col-lg-2 col-10 bg-light fw-bold pt-2">
            <span><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
        </div>
        <div class="col-lg-2 adminnav text-white fw-bold pt-2 d-none d-lg-block">
            <span><?php echo $u["mobile"]; ?></span>
        </div>
        <div class="col-lg-3 bg-light fw-bold pt-2 d-none d-lg-block">
            <div class="row">
                <div class="col-8">
                    <span>
                        <?php
                        $rd = $u["register_date"];
                        $splitrd = explode(" ", $rd);
                        echo $splitrd[0];
                        ?>
                    </span>
                </div>
                <div class="col-4 d-grid text-end">
                    <?php

                    $s = $u["status"];

                    if ($s == "1") {
                    ?>
                        <button id="blockbtn<?php echo $u['email']; ?>" class="btn btn-danger" onclick="blockuser('<?php echo $u['email']; ?>');">Block</button>
                    <?php
                    } else {
                    ?>
                        <button class="btn btn-success" onclick="blockuser('<?php echo $u['email']; ?>');">Unblock</button>
                    <?php
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="msgmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- message -->
                    <div class="col-12 py-5 px-4">
                        <div class="row rounded-lg overflow-hidden shadow">
                            <div class="col-5 px-0">
                                <div class="bg-white">

                                    <div class="bg-gray px-4 py-2 bg-light">
                                        <p class="h5 mb-0 py-1">Recent</p>
                                    </div>

                                    <div class="messages-box">
                                        <div class="list-group rounded-0" id="rcv"></div>
                                    </div>

                                </div>

                            </div>

                            <!-- massage box -->
                            <div class="col-7 px-0">
                                <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                    <!-- massage load venne methana -->


                                </div>
                            </div>

                            <div class="offset-5 col-7">
                                <div class="row bg-white">

                                    <!-- text -->
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                <div class="input-group-append">
                                                    <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessage(<?php echo $u['email']; ?>);"> <i class="bi bi-cursor-fill"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- text -->

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- message-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

<?php

}
