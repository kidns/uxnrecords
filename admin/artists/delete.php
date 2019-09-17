<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 9/14/2019
 * Time: 5:12 PM
 */
$handling  = new apps_libs_Handling();
$db = new apps_libs_Dbconnection();
$route = new apps_libs_Route();

    $result_name = $handling->getInfo("artist","id_artist");
   echo $result_name;


if ($route->getPOST("customDelete")) {
    $sqlFile = $db->query("SELECT * FROM artist WHERE id_artist = '".$route->getPOST('customDelete')."'")->fetchAll();
    if ($sqlFile>0){
        foreach ($sqlFile as $row){
            if (file_exists($row['cover'])){
                unlink($row['cover']);


            }

        }
        $result_del = $handling->deleteRecord("artist", "id_artist");
        die($result_del);
    }

}



