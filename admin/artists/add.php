<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 9/11/2019
 * Time: 8:58 AM
 */

include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";
$ss = new apps_libs_UserIdentity();
if($ss->isLogin()==false){

}else {
    $route = new apps_libs_Route();
    $name = $route->getPOST("name");
    $booking = $route->getPOST("booking");
    $fb = $route->getPOST("booking");
    $sc = $route->getPOST("sc_art");
    $fb = $route->getPOST("fb_art");
    $inst = $route->getPOST("inst_art");
    $spot = $route->getPOST("spot_art");
    $table = "artist";

    $target_dir = '../../media/file/img/';
    $target_file = $target_dir . basename($_FILES['file']['name']);

    $result = [
        "false" => '',
        "true" => ''


    ];
    if (empty($_FILES['file'])) {
        $result['false'] .= 'Something went wrong!';

    } else {
        $type = $_FILES['file']['type'];
        if ($type === 'image/jpeg' || $type === 'image/jpg' || $type === 'image/png' || $type === 'image/git') {

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                $db = new apps_libs_Dbconnection();
                $add_artist = $db->buildQueryParams([
                    "column" => "(name_artist, cover, booking, sc_art, fb_art, inst_art, spot_art)",
                    "row" => "(:name, :cover, :booking, :sc, :fb, :inst, :spot)",
                    "params" => [
                        ':name' => $name,
                        ':cover' => $target_file,
                        ':booking' => $booking,
                        ':sc' => $sc,
                        ':fb' => $fb,
                        ':inst' => $inst,
                        ':spot' => $spot,
                    ]
                ])->insert($table);
                if ($add_artist) {
                    $result['true'] .= 'successfully';
                } else {
                    $result['false'] .= 'Something went wrong!';
                }


            }


        } else {

            $result['false'] .= 'Something went wrong!';


        }
    }

    die(json_encode($result));
}
?>