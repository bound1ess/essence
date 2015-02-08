<?php

use PhpPackages\Container\Container, PhpPackages\Container\Raw;

if ( ! function_exists("essence")) {
    /**
     * Returns the Essence instance itself (singleton or one-instance-per-runtime).
     */
    function essence()
    {
        static $instance;

        if ( ! is_object($instance)) {
            $instance = (new Container)->make("Essence\Essence");
        }

        if (count(func_get_args()) > 0) {
            $value = new Raw(func_get_args()[0]);

            $instance->setBuilder((new Container)->make("Essence\AssertionBuilder", [$value]));
        }

        return $instance;
    }
}

if ( ! function_exists("it")) {
    /**
     * An entry point.
     */
    function it($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("this")) {
    /**
     * An entry point.
     */
    function this($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("these")) {
    /**
     * An entry point.
     */
    function these($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("those")) {
    /**
     * An entry point.
     */
    function those($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("that")) {
    /**
     * An entry point.
     */
    function that($value)
    {
        return essence($value);
    }
}

if ( ! function_exists("expect")) {
    /**
     * Just a wrapper function for better readability.
     */
    function expect($value)
    {
        return $value;
    }
}
