<?php

function setFlash($name, $value, $type = 'success')
{
    $_SESSION[$name] = "<div class='alert alert-$type'>$value</div>";
}

function getFlash($name)
{
    if(isset($_SESSION[$name])){
        echo $_SESSION[$name];
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