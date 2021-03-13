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