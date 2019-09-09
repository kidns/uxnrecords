<?php
include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";
class apps_admin_test extends apps_libs_Handling{





}
header('Content-type: application/json');
$handling = new apps_libs_Handling();
$query_update = $handling->getInfo("members","username");
echo strval($query_update);

$route = new apps_libs_Route();
if ($route->getPOST("bntUpdate")){
$db = new apps_libs_Dbconnection();
$id = $route->getPOST("id");
$pws = $route->getPOST("pws");
$email= $route->getPOST("email");


    $query_update = $db->buildQueryParams([
        "column"=>"password=:pws , email=:email",
        "where" => "id=:id",
        "params" => [
            ":pws" =>md5($pws),
            ":email"=>$email,
            ":id"=>$id
        ]

    ])->update("members");

   echo $query_update;




}
