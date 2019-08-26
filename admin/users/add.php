<?php
$account = $route->getPOST("username");
$password = $route->getPOST("password");
$a = new apps_admin_users_members();

if (isset($_POST['submit'])) {

    $a->buildQueryParams(

        [
            "field" => "(username, password) value (?,?)",
            "value" =>[$account,md5($password)]

        ]


    )->insert();
    var_dump($a); die();



}
?>