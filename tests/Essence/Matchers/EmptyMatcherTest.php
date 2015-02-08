<?php namespace Essence\Matchers;

class EmptyMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\EmptyMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new EmptyMatcher("foobar");

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new EmptyMatcher(""))->run());
    }
}
