<?php

if ( ! function_exists("essence_get_container")) {
    function essence_get_container()
    {
        static $instance;

        if ( ! is_object($instance)) {
            $instance = new PhpPackages\Container\Container;
        }

        return $instance;
    }
}
