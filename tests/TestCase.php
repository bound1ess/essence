<?php

class TestCase extends PHPUnit_Framework_TestCase
{

    protected $subject;

    public function setUp()
    {
        if (is_string($this->subject)) {
            $this->subject = new $this->subject;
        }
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
