<?php

class TestCase extends PHPUnit_Framework_TestCase
{

    protected $subject;

    protected $arguments = [];

    public function setUp()
    {
        if (is_string($this->subject)) {
            $this->subject = (new ReflectionClass($this->subject))
                ->newInstanceArgs($this->arguments);
        }
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
