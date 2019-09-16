<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 9/14/2019
 * Time: 5:12 PM
 */
$handling  = new apps_libs_Handling();
$route = new apps_libs_Route();

    $result_name = $handling->getInfo("artist","id_artist");
   echo $result_name;


if ($route->getPOST("customDelete")) {
    $result_del = $handling->deleteRecord("artist", "id_artist");
    die($result_del);
}



