<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 9/11/2019
 * Time: 8:58 AM
 */

include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";
$route = new apps_libs_Route();
$name = $route->getPOST("name");
$booking = $route->getPOST("booking");
$fb = $route->getPOST("booking");
$sc = $route->getPOST("booking");

if (empty($_FILES['file'])){
    echo "nulll";
}else{
    var_dump($_FILES['file']);
}

?>