<?php

class App{
    public $controller = 'Home';
    public $method = 'index';
    public $params = [];
    private static $route = [];

    public function __construct(){
        //Landing page
        $this->route('/', 'Admin@index');

        //Untuk tampilan nasabah
        $this->route('/nasabah', 'Nasabah@index');
        $this->route('/nasabah/create', 'Nasabah@create');
        $this->route('/nasabah/edit/{id}', 'Nasabah@edit');
        $this->route('/nasabah/delete/{id}', 'Nasabah@delete');

        //Untuk tampilan operator
        $this->route('/operator', 'Operator@index');
        $this->route('/operator/create',  'Operator@create');
        $this->route('/operator/edit/{id}', 'Operator@edit');
        $this->route('/operator/delete/{id}', 'Operator@delete');

        //Untuk tampilan admin
        $this->route('/admin', 'Admin@index');
        $this->route('/admin/create',  'Admin@create');
        $this->route('/admin/edit/{id}', 'Admin@edit');
        $this->route('/admin/delete/{id}', 'Admin@delete');
        

        $this->notFound();
    }

    private function route($url, $contoller){
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

        self::$route[] = $result;

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

    public function notFound()
    {
        if(!in_array(true, self::$route)){
            require '../app/views/error/404.php';
            die;
        }
    }

}
?>