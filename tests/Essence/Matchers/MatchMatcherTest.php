<?php namespace Essence\Matchers;

class MatchMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()  
    {
        $matcher = new MatchMatcher("foobarbaz", ["/bar/"], false);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertFalse((new MatchMatcher("foo", ["/bar/"], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new MatchMatcher(null, [], true))->run();
    }
}
