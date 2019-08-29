<?php
/**
 * Created by PhpStorm.
 * User: Windy
 * Date: 8/27/2019
 * Time: 1:03 PM
 */


class apps_libs_Handling extends apps_libs_Dbconnection
{



    public function loading($table, $other, $limit,$tab)
    {    $route = new apps_libs_Route();
        $ss = new apps_libs_UserIdentity();
        if($ss->isLogin()==false){


        }else {
            global $paging;
            global $start;

            $count_all_rows = $this->query("SELECT * FROM " . $table)->rowCount();

            $config = array(
                'current_page' => $route->getGET("page"),
                'total_record' => $count_all_rows,
                'limit' => $limit,
                'link_full' => $tab."?page={page}",
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


    }



    public function add($table)
    {
        $route = new apps_libs_Route();
        $account = $route->getPOST("username");
        $password = $route->getPOST("password");
        $email = $route->getPOST("email");
        if (isset($_POST['submit'])) {

            $this->buildQueryParams(

                ["table" => $table,
                    "field" => "(username, password,email) value (?,?,?)",
                    "value" => [$account, md5($password), $email]

                ]

            )->insert();

        }

    }


    public function update()
    {

    }
}




?>
