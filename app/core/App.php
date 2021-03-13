<?php

class App{
    public $controller = 'Home';
    public $method = 'index';
    public $params = [];

    public function __construct(){
        $this->route('/', 'Admin@index');
        $this->route('/nasabah/create', 'Nasabah@create');
        $this->route('/nasabah/edit/{id}', 'Nasabah@edit');
    }

    private function route($url, $contoller){ //AdminController@create
        $params = [];
        $result = false;

        if(isset($_GET['url'])){
            //For url from website
            $getUrl = '/'.rtrim($_GET['url'], '/');
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
            $getUrl = explode('/', $getUrl);

            //For url from route defined
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if(count($url) === count($getUrl)){
                foreach($url as $k => $v){
                    if ($v == $getUrl[$k]){
                        $result = true;
                    } else if ( preg_match('/{[a-z]+}/', $v )){
                        $result = true;
                        $params[] = $getUrl[$k];
                    } else {
                        $result = false;
                        break;
                    }
                }
            }
        }else if ($url == '/'){
            $result = true;
        }

        if ( $result ) {
            if(is_string($contoller)){
                $contoller = explode('@', $contoller);
                require_once '../app/controllers/'.$contoller[0].'.php';
                $this->controller = new $contoller[0];
                $this->method = $contoller[1];
                call_user_func_array([$this->controller, $this->method], $params);
            }else if(is_callable($contoller)){
                $contoller($params);
            }
        }
    }

}
?>