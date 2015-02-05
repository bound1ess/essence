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

    /**
     * @test
     */
    public function it_stores_a_list_of_links()
    {
        $this->subject->setLinks([1, 2, 3]);

        $this->assertInternalType("array", $this->subject->getLinks());
        $this->assertCount(3, $this->subject->getLinks());
    }

    /**
     * @test
     */
    public function it_stores_a_list_of_matchers()
    {
        $this->subject->setMatchers([1, 2, 3]);

        $this->assertInternalType("array", $this->subject->getMatchers());
        $this->assertCount(3, $this->subject->getMatchers());
    }

    /**
     * @test
     */
    public function it_performs_the_validation_process()
    {
        // @todo
        $this->assertFalse($this->subject->validate());
    }

    /**
     * @test
     */
    public function it_returns_a_validation_message()
    {
        // @todo
        $this->assertNull($this->subject->getMessage());
    }
}
