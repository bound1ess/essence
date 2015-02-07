<?php namespace Essence\Matchers;

class NullMatcherTest extends \TestCase
{

    protected $subject = "Essence\Matchers\NullMatcher";

    protected $arguments = ["foo", [], false];

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $this->assertFalse($this->subject->run());
        $this->assertNotNull($this->subject->getMessage());

        $this->assertTrue((new NullMatcher(null, [], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new NullMatcher(null, [], true))->run();
    }
}
