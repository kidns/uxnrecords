<?php

include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";
class apps_admin_users_deleteUsers extends apps_libs_Handling{



}

/***
 * @author thanhdepzai
 * delete records class
 *
 *
 */
$delete = new apps_libs_Handling();
$delete->deleteRecord("members","username");