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
        $fluent = \Mockery::mock("PhpPackages\Fluent\Fluent");

        $fluent->shouldReceive("getCalls")
               ->times(3)
               ->andReturn(
                   ["should", "not", "of"],
                   ["keys"],
                   [["length", 6]]
               );

        $this->subject->setFluent($fluent);
        $this->subject->setLinks(["of", "have"]);
        $this->subject->setMatchers([
            "KeysMatcherStub"   => ["keys"],
            "LengthMatcherStub" => ["length"],
        ]);

        $this->assertNull($this->subject->getMessage());

        $this->assertTrue($this->subject->validate());
        $this->assertTrue($this->subject->validate());
        $this->assertFalse($this->subject->validate());

        $this->assertEquals($this->subject->getMessage(), "foobar");
    }

    /**
     * @test
     */
    public function it_throws_UnknownAlias_exception()
    {
        $this->setExpectedException("Essence\Exceptions\UnknownAliasException");

        $fluent = \Mockery::mock("PhpPackages\Fluent\Fluent");
        $fluent->shouldReceive("getCalls")->once()->andReturn(["of"]);
        $this->subject->setFluent($fluent);

        $this->subject->validate();
    }

    /**
     * @test
     */
    public function it_throws_NoMatcherFound_exception()
    {
        $this->setExpectedException("Essence\Exceptions\NoMatcherFoundException");

        $fluent = \Mockery::mock("PhpPackages\Fluent\Fluent");
        $fluent->shouldReceive("getCalls")->once()->andReturn(["length"]);
        $this->subject->setFluent($fluent);
        $this->subject->setMatchers([uniqid() => ["length"]]);

        $this->subject->validate();
    }
}
