<?php

/***
 * Class apps_libs_Dbconnection
 * @author Thanh depzai
 * @date now
 */
class apps_libs_Dbconnection{

    protected $usename="root";
    protected $password="";
    protected $host="localhost";
    protected $database="uxntv";
    protected $queryParams = [];

    protected $tableName;
    protected  static  $connectionInstance = null;



    public function __construct()
    {
        $this->connect();

    }


    /***
     * @return null|PDO
     */
    public function connect(){

        if(self::$connectionInstance === null){
          try{
              self::$connectionInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->usename,$this->password);
              self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          } catch (Exception $ex) {
              echo "ERROR".$ex->getMessage();
              die();


          }
        }

        return self::$connectionInstance;

    }


    public function query($sql,$param = [] ){
       $q = $this->connect()->prepare($sql);
        if (is_array($param) && $param){
            $q->execute($param);


        } else
        {
            $q->execute();
        }
        return $q;
    }
    public function buildQueryParams($params){
        $default = [
          "select"=>"*",
          "where"=>"",
          "other"=>"",
          "params"=>"",
          "field"=>"",
          "value"=>[]

        ];
        $this->queryParams = array_merge($default,$params);
        return $this;


    }
    public function buildCondition($condition){
        if(trim($condition)){
            return "where ".$condition;
        }
        return "";
    }

    public function select(){
        $sql = "select ".$this->queryParams["select"]." from ".$this->tableName." ".$this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        $query = $this->query($sql,$this->queryParams["params"]);
        $show =  $query->fetchAll(PDO::FETCH_ASSOC);
        return $show;




    }
    public function selectOne(){
        $this->queryParams["other"] = "limit 1";
        $data = $this->select();
        if($data){
            return $data[0];
        }
        return [];

    }


    public function insert(){
        $sql = "insert  into ".$this->tableName." ".$this->queryParams["field"];

        $result = $this->query($sql,$this->queryParams["value"]);
        if($result){
            return $this->connect()->lastInsertId();
        }else{
            return false;
        }

    }

    /**
     * @return bool|PDOStatement
     * UPDATE FUNCTION
     */

    public  function update(){
        $sql = "update ".$this->tableName." set ".$this->queryParams["value"]." ".
            $this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        return $this->query($sql);
    }


    /**
     * DELETE FUNCTION
     */
    public function delete(){
        $sql = "delete from ".$this->tableName." ".$this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        return $this->query($sql);


    }



}