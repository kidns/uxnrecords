
<?php
include 'header.php';
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/13/2019
 * Time: 5:57 PM
 */
include '../autoLoad.php';


$identity = new apps_libs_UserIdentity();
$route = new apps_libs_Route();
$identity->checkLogin();


?>
<!-- Material form login -->
<div class="container mx-auto p-3">
    <div class="row justify-content-center ml-5">
        <div class="col-md-4">
            <div class="card">

                <h5 class="card-header bg-dark white-text text-center py-4">
                    <strong>SIGN IN</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" action="<?php echo $_SERVER["PHP_SELF"] ?>"
                          method="post">

                        <!-- Email -->
                        <div class="md-form">
                            <input type="text" id="username" name="username" class="form-control">
                            <label for="materialLoginFormEmail">User name</label>
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control">
                            <label for="materialLoginFormPassword">Password</label>
                        </div>

                        <div class="d-flex justify-content-around">
                            <p id="status"></p>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                type="submit">Sign in
                        </button>

                        <!-- Register -->
                        <p>Not a member?
                            <a href="">Register</a>
                        </p>


                    </form>
                    <!-- Form -->

                </div>

            </div>

        </div>
    </div>
</div>
<?php
$account = $route->getPOST("username");
$password = $route->getPOST("password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identity->username = $account;
    $identity->password = $password;

    if ($identity->login()) {
        echo'<script>
    document.getElementById("status").innerHTML = "Logged in successfully";
    setTimeout("location.reload(true);",1500);
</script>';

    } else {
        echo '<script>
    document.getElementById("status").innerHTML = "Something Wrong";
</script>';

    }


}

include 'footer.php';
?>

