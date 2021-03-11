<?php

class App{
    public $controller = 'Home';
    public $method = 'index';
    public $params = [];

    public function __construct(){
        $url = $this->parseUrl();

        //untuk mengecek apakah controller tersedia
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require '../app/controllers/'.ucwords($this->controller).'.php';
        $this->controller = new $this->controller;

        //untuk mengecek apakah method tersedia di dalam controller tersebut
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //untuk mengecek apakah ada parameter yang dilampirkan?
        if(!empty($url)){
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}
?>