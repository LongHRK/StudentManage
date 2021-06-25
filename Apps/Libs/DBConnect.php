<?php

/**
 * class connect database
 * PDO Class help connect
 */
class Apps_Libs_DBConnect {

    protected $host = 'localhost';
    protected $dbname = 'studentmanage';
    protected $user = 'root';
    protected $pass = '';
    protected $tablename;
    protected $queryparams = [];
    
    public static $connection = null;

    /**
     * Constructor
     */
    public function __construct() {
        $this->Connect();
    }

    /**
     * Function connect database
     */
    private function Connect() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO("mysql:host=$this->host;dbname=$this->dbname" 
                        , $this->user, $this->pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $exc) {
                echo 'Errorr ' . $exc->getMessage();
            }
        }
        return self::$connection;
    }

    public function query($sql ,$param = []) {
            $qr = self::$connection->prepare($sql);
            if(is_array($param) && $param){
                $qr->execute($param);
            } else {
                $qr->execute();
            }
            return $qr;
    }
    
    public function buildparam($param) {
        $default = [
            'select'=> '*',
            'where'=> '',
            'other'=> '',
            'param'=> [],
            'field'=>'',
            'values'=> []
        ];
        $this->queryparams = array_merge($default,$param);
        return $this;
    }
    
    public function handlewhere($where){
        if(trim($where)){
            return "where ".$where;
        }
        return "";
    }

    public function select() {
        $sql = "select ".$this->queryparams["select"]." from " 
                .$this->tablename." ".$this->handlewhere($this->queryparams["where"])." " 
                .$this->queryparams["other"];
        $query = $this->query($sql, $this->queryparams["values"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectone() {
        $this->queryparams["other"] = "limit 1";
        $data = $this->select();
        if($data){
            return $data[0];
        }
        return [];
    }
    
    public function insert() {
        $sql = "insert into ".$this->tablename." "
                .$this->queryparams["field"];
        $result = $this->query($sql, $this->queryparams["values"]);
        if($result){
            return true;
        } else {
            return false;
        }
    }
    
    public function update() {
        $sql = "update ".$this->tablename." set ".$this->queryparams["field"]." " 
                .$this->handlewhere($this->queryparams["where"])." ".
                $this->queryparams["other"];
        return $this->query($sql, $this->queryparams["values"]) ? true : false;
    }
    
    public function delete() {
        $sql = "delete from ".$this->tablename." "
                .$this->handlewhere($this->queryparams["where"])." ".
                $this->queryparams["other"];
        return $this->query($sql, $this->queryparams["values"]) ? true : false;
    }
}
?>