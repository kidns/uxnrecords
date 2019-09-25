<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../UXN/apps/autoLoad.php";
$ss = new apps_libs_UserIdentity();
if ($ss->isLogin() == false) {

} else {


    /**
     * Created by PhpStorm.
     * User: Windy
     * Date: 9/17/2019
     * Time: 6:52 AM
     */
    $handing = new apps_libs_Handling();
    $route = new apps_libs_Route();
    $db = new apps_libs_Dbconnection();
    $resultInfo = $handing->getInfo("artist", "id_artist");
    echo $resultInfo;




    if ($route->getPOST("bnt_update")) {
        $id_up = $route->getPOST("id_up");
        $name = $route->getPOST("up_name");
        $booking = $route->getPOST("up_booking");
        $sc = $route->getPOST("up_sc_art");
        $fb = $route->getPOST("up_fb_art");
        $inst = $route->getPOST("up_inst_art");
        $spot = $route->getPOST("up_spot_art");
        $old_file = $route->getPOST("old_file_cover");
        $result = [
            'true' => '',
            'false' => ''
        ];
        if (empty($_FILES['file'])) {
            $query_update = $db->buildQueryParams([
                'column' => 'name_artist=:name, booking=:booking, sc_art=:sc, fb_art=:fb, inst_art=:inst, spot_art=:spot',
                'where' => 'id_artist=:id',
                'params' => [
                    ':id' => $id_up,
                    ':name' => $name,
                    ':booking' => $booking,
                    ':sc' => $sc,
                    ':fb' => $fb,
                    ':inst' => $inst,
                    ':spot' => $spot


                ]
            ])->update("artist");

            echo $query_update;
            $db->closeConnect();


        } else {

            $target_dir = '../../media/file/img/';
            $target_file = $target_dir . basename($_FILES['file']['name']);
            $type = $_FILES['file']['type'];
            if (file_exists($target_file)) {
                $result['false'] .= 'The file ' . substr($target_file, 21) . ' exists';
                echo json_encode($result);
                $db->closeConnect();


            } else {
                if ($type === 'image/jpeg' || $type === 'image/jpg' || $type === 'image/png' || $type === 'image/git') {
                    if (unlink(realpath($old_file))) {
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                            $query_update = $db->buildQueryParams([
                                'column' => 'name_artist=:name,cover=:cover, booking=:booking, sc_art=:sc, fb_art=:fb, inst_art=:inst, spot_art=:spot',
                                'where' => 'id_artist=:id',
                                'params' => [
                                    ':id' => $id_up,
                                    ':name' => $name,
                                    ':booking' => $booking,
                                    ':sc' => $sc,
                                    ':fb' => $fb,
                                    ':inst' => $inst,
                                    ':spot' => $spot,
                                    ':cover' => $target_file


                                ]
                            ])->update("artist");

                            echo $query_update;
                            $db->closeConnect();


                        } else {
                            die();

                        }


                    }


                }


            }


        }


    }


}