<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/18/2019
 * Time: 4:16 PM
 */

 class apps_libs_Route{

     const PARAM_NAME = "r";
     const HOME_PAGE = "index";
     const INDEX_PAGE ="index";


     public  static $sourcePath;

     public function __construct($sourcePath="")
     {
         if($sourcePath){

             self::$sourcePath = $sourcePath;
         }

     }

     public  function getGET($name= null){
         if ($name!= null){
             return isset($_GET[$name]) ? $_GET[$name] : NULL;

         }

         return $_GET;


     }

     public  function getPOST($name= null){
         if ($name!= null){
             return isset($_POST[$name]) ? $_POST[$name] : NULL;

         }

         return $_POST;


     }

     public function route(){
         $url = $this->getGET(self::PARAM_NAME);
         if(!is_string($url)||!$url || $url == self::INDEX_PAGE){
             $url = self::HOME_PAGE;
         }
         $path = self::$sourcePath."/".$url.".php";


//         if (file_exists($path)){
//             return require_once "'".$path."'";
//
//         }else{
//             return $this->pageNotFound();
//
//
//         }
     }

     public function Redirect($url){
          echo '<script>location.href="'.$url.'";</script>';

     }


//     public function redirectIndex(){
//         $url =  $_SERVER['DOCUMENT_ROOT'].'/admin/login.php';
//         echo $url;
//
//     }




     public function pageNotFound(){
         echo "page not found 404";
         die();
     }





 }