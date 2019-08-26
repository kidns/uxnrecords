<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/14/2019
 * Time: 12:59 PM
 */
include '../autoLoad.php';
$user = new apps_libs_UserIdentity();
$route = new apps_libs_Route();
$user->logOut();
if ($user){
    $route->Redirect("login.php");
}