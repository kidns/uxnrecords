<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";

$ss = new apps_libs_UserIdentity();
if ($ss->isLogin() == false) {


} else {


    class apps_admin_users_managerUsers extends apps_libs_Handling
    {


    }

    $test = new apps_libs_Handling();
    $query = $test->loading("artist", "limit", 16, "index.php");
    include_once "../header.php";


    ?>
    <div class="container-fluid artist p-md-5 shadow-sm p-3 mb-5">
<!--        SHOW DATABASE IN HERE-->
        <div class="row justify-content-between">
            <div class="col-6 text-left"><p class="h3">ARTIST</p></div>
           <div class="col-6 text-right" style="font-size: x-large;">
                <span class="fas fa-plus" data-toggle="modal" data-target="#addUsers"></span>
           </div>
        </div>
        <div class="row justify-content-start mx-auto justify-content-sm-start" id="list">


        </div>
        <div class="container justify-content-center">
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
            <div class="modal-content rounded add-art">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ARTIST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_art">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="form_art">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Artist name</label>
                            <input type="text" class="form-control" id="name_art" name="username"/>

                            <label for="recipient-name" class="col-form-label">Cover:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_cover" name="images" data-toggle="tooltip" data-placement="right" title="(JPG, PNG, JPEG) MAX: 3M">
                                <label class="custom-file-label" for="customFile" id="label-file">choose cover</label>
                            </div>
                            <div class="status alert alert-danger mt-2" id="status"></div>

                            <label for="recipient-name" class="col-form-label">Booking & manager</label>
                            <textarea class="form-control" id="booking" rows="3"></textarea>
                            <label for="recipient-name" class="col-form-label">Link stream:</label>
                            <div class="row">
                                <div class="col">  <input id="sc_art" type="text" class="form-control" name="soundcloud" placeholder="/souncloud"/></div>
                                <div class="col"> <input id="fb_art" type="text" class="form-control" name="facebook" placeholder="/facebook"/></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col"><input id="inst_art" type="text" class="form-control" name="instagram" placeholder="/instagram"/></div>
                                <div class="col"> <input id="spot_art" type="text" class="form-control" name="spotify" placeholder="/spofity"/></div>
                            </div>




                        </div>
                        <div class="alert alert-success" id="success_add"></div>
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





    <script src="/UXN/apps/media/boostrap/js/artist.js"></script>

    <?php


    include_once "../footer.php";
}
?>






















