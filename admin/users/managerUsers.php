

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";

$ss = new apps_libs_UserIdentity();
if($ss->isLogin()==false){


}else {


    class apps_admin_users_managerUsers extends apps_libs_Handling
    {


    }

    $test = new apps_libs_Handling();
    $query = $test->loading("members", "limit", 9, "managerUsers.php");
    include_once "../header.php";


    ?>
    <div class="container-fluid ml-0 mr-0 pl-0 pr-0">
        <!--SUCCESS ALERT SHOW-->
        <div aria-live="assertive" id="alert" aria-atomic="true" style="padding-left:10px;">
            <div class="toast bg-success" style="position: absolute; top: 0; right: auto;" data-autohide="false">
                <div class="toast-header">
                    <svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                         preserveAspectRatio="xMidYMid slice"
                         focusable="false" role="img">
                        <rect fill="#007aff" width="100%" height="100%"/>
                    </svg>
                    <strong class="mr-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body text-white">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>
        <!--    SHOW TABLE DATA-->
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" cellpadding="0" width="100%"
                   id="pagingnation-test">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 30%" scope="col">NAME</th>
                    <th style="width: 30%" scope="col">PASSWORD</th>
                    <th style="width: 20%" scope="col">EMAIL</th>
                    <th style="width: 10%" scope="col">POSITION</th>
                    <th style="width: 10%" class="text-center" scope="col"><i class="fas fa-user-plus"
                                                                              data-toggle="modal"
                                                                              data-target="#addUsers"> </i></th>
                </tr>
                </thead>
                <tbody id="list">
                <!--            SHOW DATA IN HERE-->
                </tbody>
            </table>


        </div>

        <!-- DIALOG ADD USER-->
        <div class="modal fade" id="addUsers" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeReg">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">User name:</label>
                                <input type="text" class="form-control" id="username" name="username" required="required"/>

                                <label for="recipient-name" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required="required"/>

                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required="required"/>
                                <br/>
                                <span id="notifi"></span>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Administration
                                    </label>
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
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">User name:</label>
                                <input type="text" class="form-control" id="userUpdate" placeholder="username"
                                       name="username" disabled>

                                <label for="recipient-name" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="pwdUpdate" name="password">

                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="emailUpdate" name="email">

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Administration
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="submit">UPDATE</button>
                            </div>
                        </form>
                    </div>

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


        <div class="container" id="content">
            <div class="div-page" id="div-page">

                <?php echo $paging->html(); ?>

            </div>

        </div>

    </div>
    <script>

    </script>


    <?php


    include_once "../footer.php";
}
?>






















