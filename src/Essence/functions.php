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

if ( ! function_exists("essence")) {
    function essence($value)
    {
        static $instance;

        $value = raw($value);

        if ( ! is_object($instance)) {
            $instance = essence_get_container()->make("Essence\Essence", [$value]);
        } else {
            $instance->setBuilder(
                essence_get_container()->make("Essence\AssertionBuilder", [$value])
            );
        }

        return $instance;
    }
}

if ( ! function_exists("it")) {
    function it($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("this")) {
    function this($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("these")) {
    function these($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("those")) {
    function those($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("that")) {
    function that($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("expect")) {
    function expect($value)
    {
        return $value;
    }
}
