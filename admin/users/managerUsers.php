
<?php
include $_SERVER['DOCUMENT_ROOT']."/UXN/apps/autoLoad.php";
$ss = new apps_libs_UserIdentity();
$route = new apps_libs_Route();


if($ss->isLogin()==false){


}else{


$a = new apps_admin_users_members();
$query = $a ->buildQueryParams(['select' => '*'])->select();

?>
<div class="container-fluid">

    <table class="table">
        <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">NAME</th>
            <th scope="col">PASSWORD</th>
            <th scope="col"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">ADD</button></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($query as $row) {

         ?>
        <tr class="text-center">
            <td><?php echo $row["username"]?></td>
            <td><?php echo $row["password"]?></td>
        </tr>

        <?php
        }?>
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Administration
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary" name="submit">ADD</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php

}
?>



















<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
