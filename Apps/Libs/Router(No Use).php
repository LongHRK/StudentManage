<?php
    class Apps_Libs_Router_NOUSE{
        const PARAM_NAME = "r";
        const HOME_PAGE = "Home";
        const INDEX_PAGE = "index";
        const LOGIN_PAGE = "Login";

        public static $sourtpatch;
        
        public function __construct($sourtpatch = "") {
            if($sourtpatch){
                self::$sourtpatch = $sourtpatch;
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
        
        public function router() {
            $url = $this->getGet(self::PARAM_NAME);
            
            if(!$url || $url == self::INDEX_PAGE || !is_string($url)){
                $url = self::LOGIN_PAGE;
            }
            $patch = self::$sourtpatch."/".$url.".php";
            if(file_exists($patch)){
                return require_once $patch;
            } else {
                return $this->pageNotFount();
            }
        }
        
        public function pageNotFount() {
            echo '404 Page Not Fount';
            die();
        }
        
        public function createURL($url,$param = []) {
        if($url)
            $param[self::PARAM_NAME] = $url;
        return $_SERVER["PHP_SELF"].'?'. http_build_query($param);
        }
        
        public function redirect($url) {
            $ur = $this->createURL($url);
            header("location:$ur");
        }
        
        public function homepage() {
            $this->redirect(self::HOME_PAGE);
        }
        
        public function loginpage() {
            $this->redirect(self::LOGIN_PAGE);
        }
        
    }
?>

