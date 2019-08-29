
<?php
class loadajax {
    public function __construct()
    {
        header('Content-type: application/json; charset=UTF-8');
        include '../../autoLoad.php';
        $db = new apps_libs_Handling();
        $result =  $db->loading("?tab=users","members","limit",9);


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            die (json_encode(array('result'=>$result,)));


        }
        disconnect();

    }



}
$test = new loadajax();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
