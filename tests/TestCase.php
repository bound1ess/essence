<?php

abstract class TestCase extends PHPUnit_Framework_TestCase
{

    protected $subject;

    public function setUp()
    {
        if (is_string($this->subject) and strpos($this->subject, "Matcher") === false) {
            $this->subject = new $this->subject;
        }
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
