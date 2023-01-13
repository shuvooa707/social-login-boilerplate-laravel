<?php

if ( !function_exists("routec") ) 
{
    function routec($name): string 
    {
        if ($name == "home") 
        {
            return env("APP_URL");
        }
        $url = explode("localhost/", route($name));
        $url = end($url);
        return env("APP_URL") . $url;
    }
}