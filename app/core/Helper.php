<?php

function setFlash($name, $value, $type = 'success')
{
    $type = $type=='danger'?'error':'success';
    $_SESSION[$name] = ['message'=>$value, 'type'=>$type];
}

function getFlash($name, $closure)
{
    if(isset($_SESSION[$name])){
        $closure($_SESSION[$name]);
        unset($_SESSION[$name]);
    }
}

function redirect($url){
    header('location: '.BASE_URL.$url);
    exit;
}

function abort($code = '404'){
    require_once __DIR__.'/../views/error/'.$code.'.php';
    exit;
}

function url($url = '')
{
    return BASE_URL.$url;
}

function transaksi($tr = null)
{
    $transaksi = [
        'setor' => 'Setor',
        'tarik' => 'Tarik',
        'tf'    => 'Transfer',
    ];
    return is_null($tr) ? $transaksi : $transaksi[$tr];
}

function user($index = ''){
    if(isset($_SESSION['user'][$index])){
        return $_SESSION['user'][$index];
    }else if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }else{
        return [];
    }
}