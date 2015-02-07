<?php namespace Essence\Matchers;

class FalseMatcherTest extends \TestCase
{

    protected $subject = "Essence\Matchers\FalseMatcher";

    protected $arguments = [false, [], false];

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $this->assertTrue($this->subject->run());
        $this->assertNull($this->subject->getMessage());

        $this->assertFalse((new FalseMatcher(true, [], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new FalseMatcher("foo", [], true))->run();
    }
}
