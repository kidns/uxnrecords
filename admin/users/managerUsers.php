

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";





class apps_admin_users_managerUsers extends  apps_libs_Handling {






}

$test = new apps_libs_Handling();
$query = $test->loading("members","limit",9,"managerUsers.php");
$result = json_decode($query,true);

include_once "../header.php";





?>
<div class="container-fluid ml-0 mr-0 pl-0 pr-0">
    <div class="table-responsive">


        <table class="table table-hover table-striped table-bordered" cellpadding="0" width="100%" id="pagingnation-test">
            <thead class="thead-dark">
            <tr>
                <th style="width: 30%" scope="col">NAME</th>
                <th style="width: 30%" scope="col">PASSWORD</th>
                <th style="width: 20%" scope="col">EMAIL</th>
                <th style="width: 10%" scope="col">POSITION</th>
                <th style="width: 10%" class="text-center" scope="col"><i class="fas fa-user-plus" data-toggle="modal" data-target="#addUsers"> </i></th>
            </tr>
            </thead>
            <tbody id="list">
            <?php foreach ($result as $key => $row) {

                ?>
                <tr>
                    <td><?php echo $row["username"]?></td>
                    <td><?php echo $row["password"]?></td>
                    <td><?php echo $row["email"]?></td>
                    <td><?php echo $row["level"]?></td>
                    <td class="text-center"><i id="<?php echo $row['username']?>" class="fas fa-edit mr-3" data-toggle="modal" data-target="#update" onclick="showUpdate(this)"></i><i class="fas fa-backspace ml-3"></i></td>
                </tr>

                <?php
            }?>
            </tbody>
        </table>


    </div>

    <!-- DIALOG ADD USER-->
    <div class="modal fade" id="addUsers" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">User name:</label>
                            <input type="text" class="form-control" id="username" name="username">

                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">

                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="password" name="email">

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Administration
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">ADD</button>
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
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">User name:</label>
                            <input  type="text" class="form-control" id="userUpdate" placeholder="username" name="username" disabled>

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




   <div class="container" id="content">
       <div class="div-page" id="div-page">

        <?php echo   $paging->html(); ?>

       </div>

   </div>

    </div>
    <script>

    </script>



<?php


include_once "../footer.php";
?>






















