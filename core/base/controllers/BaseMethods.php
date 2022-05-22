<?php 

namespace core\base\controllers;

trait BaseMethods {
    protected $style;
    protected $script;

    protected function init($admin = false){

        if(!$admin){
            if(USER_CSS_JS['styles']){
                foreach(USER_CSS_JS['styles'] as $item) $this->style[] = PATH . TEMPLATE . trim( $item, '/');
            }
            if(USER_CSS_JS['scripts']){
                foreach(USER_CSS_JS['scripts'] as $item) $this->script[] = PATH . TEMPLATE . trim( $item, '/');
            }
        }else{
            if(ADMIN_CSS_JS['styles']){
                foreach(ADMIN_CSS_JS['styles'] as $item) $this->style[] = PATH . TEMPLATE . trim( $item, '/');
            }
            if(ADMIN_CSS_JS['scripts']){
                foreach(ADMIN_CSS_JS['scripts'] as $item) $this->script[] = PATH . TEMPLATE . trim( $item, '/');
            }

        }


    }
    protected function clearStr($str){

        if(is_array($str)){ 
            foreach ($str as $key => $item) {
              $str[$key] = trim(strip_tags($item));
              return $str;  
            }
        }else{
            return trim(strip_tags($str));
        }
    }

    protected function cleanNum($num) {
        return $num * 1;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function inAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    protected function redirect($http = false, $code = false) {
        if($code){
            $codes = ['301' => 'HTTP/1.1 301 Move Permanently'];

            if($codes[$code]) header($codes[$code]);
        }
        if($http) $redirect = $http;
            else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
            header("Location: $redirect");

            exit;
        
    }
    protected function writeLog($message, $file = 'log.txt', $event = 'Fault'){

        $dataTime = new \DateTime();
        $str = $event . ': ' . $dataTime->format('d-m-Y G:i:s') . ' - ' . $message . "\r\n";
        file_put_contents('log/'. $file, $str, FILE_APPEND);
    }

}



?>