<?php
include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";
class apps_admin_test extends apps_libs_Handling{





}

$test = new apps_libs_Handling();
$query_update = $test->updateVer("members","username");
echo $query_update;
