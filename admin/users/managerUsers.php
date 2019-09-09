<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";

$ss = new apps_libs_UserIdentity();
if ($ss->isLogin() == false) {


} else {


    class apps_admin_users_managerUsers extends apps_libs_Handling
    {


    }

    $test = new apps_libs_Handling();
    $query = $test->loading("members", "limit", 10, "managerUsers.php");
    include_once "../header.php";


    ?>
    <div class="container-fluid mx-auto">
        <!--SUCCESS TOAST SHOW-->
        <div class="row">
            <div class="col-md-12">
                <div aria-live="assertive" id="alert" aria-atomic="true" style="padding-left:10px;">
                    <div class="toast bg-success" style="position: absolute; top: 0; right: auto;"
                         data-autohide="false">
                        <div class="toast-header">
                            <svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                 preserveAspectRatio="xMidYMid slice"
                                 focusable="false" role="img">
                                <rect fill="#007aff" width="100%" height="100%"/>
                            </svg>
                            <strong class="mr-auto">Bootstrap</strong>
                            <small>11 mins ago</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"
                                    id="closeAlert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body text-white">

                        </div>
                    </div>
                </div>
                <!--    SHOW TABLE DATA-->
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" cellpadding="0"
                           id="pagingnation-test">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%" scope="col">ID</th>
                            <th style="width: 30%" scope="col">NAME</th>
                            <th style="width: 30%" scope="col">PASSWORD</th>
                            <th style="width: 20%" scope="col">EMAIL</th>
                            <th style="width: 5%" class="text-center" scope="col">POSITION</th>
                            <th style="width: 10%" class="text-center" scope="col"><i class="fas fa-user-plus"
                                                                                      data-toggle="modal"
                                                                                      data-target="#addUsers"> </i></th>
                        </tr>
                        </thead>
                        <tbody id="list">
                        <!--            SHOW DATA IN HERE-->
                        </tbody>
                    </table>

                    <div class="container justify-content-center mt-5" id="content">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="div-page" id="div-page">

                                    <?php echo $paging->html(); ?>

                                </div>
                            </div>
                            <div class="col-md-3"></div>

                        </div>


                    </div>

                </div>
            </div>

        </div>


        <!-- DIALOG ADD USER-->
        <div class="modal fade" id="addUsers" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="exampleModalLabel">ADD USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeReg">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">User name:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       required="required"/>

                                <label for="recipient-name" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       required="required"/>

                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" class="form-control mb-3" id="email" name="email"
                                       required="required"/>

                                <span id="notifi"></span>

                                <div class="custom-control custom-switch mt-3">
                                    <input type="checkbox" class="custom-control-input" id="switch1" name="example">
                                    <label class="custom-control-label" for="switch1">Administration</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" type="button" onclick="addRegister();" value="REGISTER"/>
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

    </div>


    <?php


    include_once "../footer.php";
}
?>






















