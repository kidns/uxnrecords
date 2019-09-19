<?php

include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";

/***
 * @author thanhdepzai
 * delete records class
 *
 *
 */
$delete = new apps_libs_Handling();
$delete->deleteRecord("members","username");