<?php

/***
 * Class apps_libs_Dbconnection
 * @author Thanh depzai
 * @date now
 */
class apps_libs_Dbconnection
{

    protected $usename = "root";
    protected $password = "";
    protected $host = "localhost";
    protected $database = "uxntv";
    protected $queryParams = [];
    protected $tablename;
    protected static $connectionInstance = null;


    public function __construct()
    {
        $this->connect();

    }


    /***
     * @return null|PDO
     */
    public function connect()
    {

        if (self::$connectionInstance === null) {
            try {
                self::$connectionInstance = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->usename, $this->password);
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $ex) {
                echo "ERROR" . $ex->getMessage();
                die();


            }
        }

        return self::$connectionInstance;

    }


    public function query($sql, $param = [])
    {
        $q = $this->connect()->prepare($sql);
        if (is_array($param) && $param) {
            $q->execute($param);


        } else {
            $q->execute();
        }
        return $q;
    }

    public function buildQueryParams($params)
    {
        $default = [
            "where"=>"",
            "select" => "*",
            "table" => "",
            "row" => "",
            "other" => "",
            "params" => "",
            "field" => "",
            "value" => [],
            "limit"=>"",
            "space"=>""

        ];
        $this->queryParams = array_merge($default, $params);
        return $this;


    }

    public function buildCondition($condition)
    {
        if (trim($condition)) {
            return "where " . $condition;
        }
        return "";
    }

    public function select($start,$limit)
    {

        $sql = "select " . $this->queryParams["select"] . " from " .$this->tablename.$this->queryParams["table"] ." ".$this->buildCondition($this->queryParams["where"])." ". $this->queryParams["other"] ." ".
            $this->queryParams["limit"].$start.$this->queryParams["space"].$limit;
        $query = $this->query($sql, $this->queryParams["params"]);
        $show = $query->fetchAll(PDO::FETCH_ASSOC);

        return $show;


    }

    public function selectOne()
    {   $start ="";
        $limit ="";
        $this->queryParams["limit"] = "limit 1";
        $data = $this->select($start,$limit);
        if ($data) {
            return $data[0];
        }
        return [];

    }


    public function insert()
    {
        $sql = "insert  into " . $this->queryParams["table"] . " " . $this->queryParams["field"];

        $result = $this->query($sql, $this->queryParams["value"]);

        if ($result) {
            $id = $this->connect()->lastInsertId();
            return $id;
        } else {
            return false;
        }

    }

    /**
     * @return bool|PDOStatement
     * UPDATE FUNCTION
     */

    public function update()
    {
        $sql = "update " . $this->tableName . " set " . $this->queryParams["value"] . " " .
            $this->buildCondition($this->queryParams["where"]) . " " . $this->queryParams["other"];
        return $this->query($sql);
    }


    /**
     * DELETE FUNCTION
     */
    public function delete($tableDelete)
    {
        $sql = "DELETE FROM " . $tableDelete . " " . $this->buildCondition($this->queryParams["where"]) . " = '" . $this->queryParams["other"]."'";

        return $this->query($sql);


    }


}