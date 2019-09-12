<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";

$ss = new apps_libs_UserIdentity();
if ($ss->isLogin() == false) {


} else {


    class apps_admin_users_managerUsers extends apps_libs_Handling
    {


    }

    $test = new apps_libs_Handling();
    $query = $test->loading("artist", "limit", 18, "index.php");
    include_once "../header.php";


    ?>
    <div class="container-fluid p-md-5">
<!--        SHOW DATABASE IN HERE-->
        <div class="row justify-content-between">
            <div class="col-6 text-left"><p class="h3">ARTIST</p></div>
           <div class="col-6 text-right" style="font-size: x-large;">
                <span class="fas fa-plus" data-toggle="modal" data-target="#addUsers"></span>
           </div>
        </div>
        <div class="row justify-content-center mx-auto justify-content-sm-center" id="list">

            <div class="text-center" id="loading">
                <div class="spinner-border" role="status" style="width: 3rem;height: 3rem;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>


        </div>

<!--SHOW PAGINATION-->

        <div class="row mt-md-5 justify-content-end" id="content">
            <div class="col-md-3 text-md-left" id="div-page">
                <?php echo $paging->html(); ?>
            </div>

        </div>





    </div>




    <!-- DIALOG ADD USER-->
    <div class="modal fade" id="addUsers" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ARTIST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeReg">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Artist name</label>
                            <input type="text" class="form-control" id="name_art" name="username"
                                   required="required"/>

                            <label for="recipient-name" class="col-form-label">Cover:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_cover" name="images" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
                                <label class="custom-file-label bg-dark text-light" for="customFile">choose cover</label>
                            </div>
                            <div class="status alert alert-success mt-2"></div>

                            <label for="recipient-name" class="col-form-label">Booking & manager</label>
                            <textarea class="form-control" id="booking" rows="3"></textarea>

                            <label for="recipient-name" class="col-form-label">Soundcloud link:</label>
                            <input id="sc_art" type="text" class="form-control" name="cover_art"/>

                            <label for="recipient-name" class="col-form-label">Facebook link:</label>
                            <input id="fb_art" type="text" class="form-control" name="cover_art"/>

                            <label for="recipient-name" class="col-form-label">Instagram link:</label>
                            <input id="insta_art" type="text" class="form-control" name="cover_art"/>

                            <label for="recipient-name" class="col-form-label">Twitter link:</label>
                            <input id="twi_art" type="text" class="form-control" name="cover_art"/>

                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-success" id="add_artist" type="button" onclick="" value="ADD"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--  DIALOG UPDATE-->
    <div class="modal fade" id="update" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPDATE USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">User name:</label>
                            <input type="text" class="form-control" id="userUpdate" placeholder="username"
                                   name="username" disabled/>

                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="pwdUpdate" name="password"/>

                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="emailUpdate" name="email"/>

                            <div class="custom-control custom-switch mt-3">
                                <input type="checkbox" class="custom-control-input" id="switch2" name="example"/>
                                <label class="custom-control-label" for="switch2">Administration</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input class="btn btn-danger" type="button" id="bntUpdate" value="UPDATE"/>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--    //DIALOG DELETE-->

    <div class="modal fade" id="deleteUsers" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteDialog">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-secondary btn-sm" id="delBnt">Delete</button>
                </div>
            </div>
        </div>
    </div>



    <script src="/UXN/apps/media/boostrap/js/artist.js"></script>

    <?php


    include_once "../footer.php";
}
?>






















