<?php namespace Essence\Matchers;

class MatchMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\MatchMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new MatchMatcher("foo", ["/bar/"]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new MatchMatcher("bazfoobar", ["/foo/"]))->run());
    }
}
