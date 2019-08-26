
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
        <tr>
            <th scope="col">NAME</th>
            <th scope="col">PASSWORD</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($query as $row) {

         ?>
        <tr>
            <td><?php echo $row["username"]?></td>
            <td><?php echo $row["password"]?></td>
        </tr>

        <?php
        }?>
        </tbody>
    </table>
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
