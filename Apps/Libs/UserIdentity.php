<?php
session_start();
class Apps_Libs_UserIdentity{
    public $username;
    public $password;

    private $type;
    
    public function __construct($username = "" , $password = "") {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function encodePass() {
        return md5($this->password);
    }
    
    public function login() {
        $db = new Apps_Model_Account();
        $query = $db->buildparam([
            "where"=>"username =? And password =?",
            "values"=>[
                trim($this->username) , $this->encodePass()
            ]
        ])->selectone();
        
        if($query){
            $_SESSION["type"] = $query["type"];
            $_SESSION["username"] = $query["username"];
            return true;
        }
        return false;
    }
    
    public function logout() {
        unset($_SESSION["username"]);
        unset($_SESSION["type"]);
    }
    
    public function getSESSION($name) {
        if($name !== null){
                return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
            }
            return $_SESSION;
    }
    
    public function isLogin() {
        if($this->getSESSION("username") && $this->getSESSION("type")){
            return true;
        }
        return false;
    }
    
    public function isUser() {
        if($this->getSESSION("type") == 1){
            return 1;
        }
        if($this->getSESSION("type") == 2){
            return 2;
        }
        if($this->getSESSION("type") == 3){
            return 3;
        }
    }
        public function getGet($name = NULL) {
            if($name !== null){
                return isset($_GET[$name]) ? $_GET[$name] : null;
            }
            return $_GET;
        }
        
        public function getPOST($name = NULL) {
            if($name !== null){
                return isset($_POST[$name]) ? $_POST[$name] : null;
            }
            return $_POST;
        }
}
