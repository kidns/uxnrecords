<?php

spl_autoload_register(
    function ($className) {
        $exp = str_replace('_', '/', $className);
        $path = str_replace("apps", "", dirname(__FILE__));
        include_once $path . '/' . $exp . ".php";


    });