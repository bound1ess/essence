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

if ( ! function_exists("it")) {
    function it($value)
    {
        return essence_get_container()->make("Essence\Essence", [$value]);
    }
}

if ( ! function_exists("this")) {
    function this($value)
    {
        return it($value);
    }
}

if ( ! function_exists("these")) {
    function these($value)
    {
        return it($value);
    }
}

if ( ! function_exists("those")) {
    function those($value)
    {
        return it($value);
    }
}

if ( ! function_exists("expect")) {
    function expect($value)
    {
        return $value;
    }
}