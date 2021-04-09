<?php

class App{
    public $controller = 'Home';
    public $method = 'index';
    public $params = [];
    private $prefix = null;
    private static $route = [];
    private $url = [];

    public function __construct(){
        //Landing page
        $this->route('/', 'Admin@index');

        //Authentication
        $this->prefix('/auth', function(){
            $this->route('/login', 'Auth@login');
            $this->route('/logout', 'Auth@logout');
        });

        //Untuk tampilan nasabah
        $this->prefix('/nasabah', function(){
            $this->route('', 'Nasabah@index');
            $this->route('/create', 'Nasabah@create');
            $this->route('/edit/{id}', 'Nasabah@edit');
            $this->route('/delete/{id}', 'Nasabah@delete');
        });

        //Untuk tampilan operator
        $this->prefix('/operator', function(){
            $this->route('', 'Operator@index');
            $this->route('/create',  'Operator@create');
            $this->route('/edit/{id}', 'Operator@edit');
            $this->route('/delete/{id}', 'Operator@delete');
            $this->prefix('/nasabah', function(){
                $this->route('/', 'Nasabah@index');
                $this->route('/create', 'Nasabah@create');
                $this->route('/edit/{id}', 'Nasabah@update');
                $this->route('/delete/{id}', 'Nasabah@destroy');
            });
        });

        //Untuk tampilan admin
        $this->prefix('/admin', function(){
            $this->route('', 'Admin@index');
            $this->route('/create',  'Admin@create');
            $this->route('/edit/{id}', 'Admin@edit');
            $this->route('/delete/{id}', 'Admin@delete');
            $this->prefix('/user', function(){
                $this->route('/', 'User@index');
                $this->route('/create', 'User@create');
                $this->route('/edit/{id}', 'User@update');
                $this->route('/delete/{id}', 'User@destroy');
            });
            $this->prefix('/rekening', function(){
                $this->route('/', 'Rekening@index');
                $this->route('/create', 'Rekening@create');
                $this->route('/edit/{norek}', 'Rekening@edit');
                $this->route('/delete/{norek}', 'Rekening@destroy');
            });
            $this->prefix('/transaksi', function(){
                $this->route('', 'Transaksi@index');
                $this->route('/add', 'Transaksi@add');
                $this->route('/detail/{id}', 'Transaksi@detail');
            });
        });

        $this->route('/ajax_user', 'User@show');
        $this->route('/ajax_rekening', 'Rekening@show');
        $this->route('/ajax_transaksi', 'Transaksi@detail');
        
        $this->notFound();
    }

    private function route($url, $contoller){
        $params = [];
        $result = false;

        $url = is_null($this->prefix) ? $url : $this->prefix.$url;
        $this->url[] = $url;

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

    public function prefix(String $prefix, Closure $closure)
    {
        $this->prefix = is_null($this->prefix) ? $prefix : $this->prefix.$prefix;
        $closure();
        $this->prefix = explode('/', $this->prefix);
        if(count($this->prefix) > 2){
            array_pop($this->prefix);
            $this->prefix = implode('/', $this->prefix);
        }else{
            $this->prefix = null;
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