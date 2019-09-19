<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/13/2019
 * Time: 5:26 PM
 */
session_start();

class apps_libs_UserIdentity{

    public $username;
    public $password;
    protected $id;


    public function __construct($user_name ="",$password="")
    {

        $this->username = $user_name;
        $this->password = $password;

    }

    public function encryptPassword(){
        return md5($this->password);


    }

    public function login(){
        $db = new apps_admin_users_members();
        $quenry_check = $db->buildQueryParams([
           "where" => " username =:username AND password =:password",
           "params" => [
               ":username" =>trim($this->username),
               ":password" =>$this->encryptPassword($this->password)
           ]])->selectOne();





        if ($quenry_check){
            $_SESSION["username"] = $quenry_check["username"];
            return true;
        }
        return false;


    }

    public function logOut(){
        unset($_SESSION["username"]);
    }



    public function getSESSION($name){
        if ($name != null){
            return isset($_SESSION[$name]) ? $_SESSION [$name] : NULL;

        }
        return $_SESSION;
    }

    public  function isLogin(){
        if($this->getSESSION("username")){
            return true;
        }
        return false;
    }

    public function checkLogin(){
        if($this->isLogin()){
            header("location:users/index.php");

        }
    }

    public function getId(){
        return $this->getSESSION("username");
    }

    public function status($id,$text){
        $script = '<script>
        document.getElementById("'.$id.'").innerHTML = "'.$text.'";
        </script>';
        return $script;

    }

}