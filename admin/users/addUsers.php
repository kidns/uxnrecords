<?php

include_once $_SERVER["DOCUMENT_ROOT"]."../UXN/apps/autoLoad.php";


/***
 * @author thanhdepzai
 * delete records class
 *
 *
 */
$route = new apps_libs_Route();
$db = new apps_libs_Dbconnection();
$user =  $route->getPOST("username");
$password = $route->getPOST("password");
$email =  $route->getPOST("email");
$table = "members";
//            $postion =  $route->getPOST("lv");
$error = array(
    "success" =>"",
    "username" =>'',
    "email" => ''
);
$query_check_username = $db->query("SELECT * FROM ".$table." WHERE username ='" .$user ."'")->rowCount();

$query_check_email = $db->query("SELECT * FROM " .$table . " WHERE email = '" . $email ."'") ->rowCount();
if ($query_check_username>0){

    $error['username'] = "The username is not available";

}else if ($query_check_email>0){
    $error['email'] = "The email is not available";
}else {

    $query_add =  $db->buildQueryParams(

        [
            "column" => "(username,password,email)",
            "row" => "(:name, :pws, :email)",
            "params" =>[
                ':name' => $user,
                ':pws' =>md5($password),
                ':email' => $email,
            ]

        ]

    )->insert($table);
    if ($query_add){
        $error['success'] = "Successfully!";
    }


}


die(json_encode($error));