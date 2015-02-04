<?php namespace Essence;

class AssertionBuilderTest extends \TestCase
{

    protected $subject = "Essence\AssertionBuilder";

    /**
     * @test
     */
    public function it_uses_FluentTrait()
    {
        $this->assertContains("PhpPackages\Fluent\FluentTrait", class_uses($this->subject));
    }
}
