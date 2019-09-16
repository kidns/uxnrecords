<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/27/2019
 * Time: 1:03 PM
 */


    class apps_libs_Handling extends apps_libs_Dbconnection
    {

        /****
         * @param $table
         * @param $other
         * @param $limit
         * @param $tab
         * @return string
         *
         * LOAD THÔNG TIN TỪ DATA + PAGINATION
         * TRẢ VỀ KẾT QUẢ Ở DẠNG JSON.
         */

        public function loading($table, $other, $limit, $tab)
        {

            $route = new apps_libs_Route();

            global $paging;
            global $start;

            $count_all_rows = $this->query("SELECT * FROM " . $table)->rowCount();

            $config = array(
                'current_page' => ($route->getGET("page") == $tab) ? $route->getGET("page") == 1 : $route->getGET("page"),
                'total_record' => $count_all_rows,
                'limit' => $limit,
                'link_full' => $tab . "?page={page}",
                'link_first' => $tab,
                'rage' => 9
            );

            $paging = new apps_libs_pagination();
            $paging->init($config);


            $limit = $paging->get_config('limit');
            $start = $paging->get_config('start');


            $query = $this->buildQueryParams(
                ["select" => "*",
                    "table" => $table,
                    "other" => $other,
                    "space" => ","


                ]

            )->select($start, $limit);

            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                die (json_encode(array(
                    'query' => $query,
                    'paging' => $paging->html()
                )));


            }


            return json_encode($query);


        }


        /****
         * @param $table
         * @param $where
         * @return string
         *
         *GET INFO TỪ MỘT BẢNG CỤ THỂ
         */

        public function getInfo($table, $where)
        {
            $route = new apps_libs_Route();
            $row = $route->getPOST("getInfo");
            $query_update = $this->query("SELECT * FROM " . $table . " WHERE " . $where . " = '" . $row . "'")->fetchAll();
            $info = json_encode($query_update);
            if ($row!==null){
                return $info;
            }else{

                return '';
            }

        }


        /****
         * @param $table
         * @param $where
         *
         *
         * XÓA THÔNG TIN TỪ 1 BẢNG
         *
         */
        public function deleteRecord($table, $where)
        {
            $route = new apps_libs_Route();
            $row = $route->getPOST("customDelete");
            $query = $this->buildQueryParams(
                [
                    "where" => $where,
                    "other" => $row

                ]
            )->delete($table);
            $result = array(
                "true"=>"",
                "false"=> ""

            );
          if ($query==0){
              $result["true"]= " was deleted successfully";

          }else{

              $result["false"]= "Something went wrong!";
          }
            die(json_encode($result));


        }





}

?>
