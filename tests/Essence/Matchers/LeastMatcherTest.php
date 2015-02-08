<?php namespace Essence\Matchers;

class LeastMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\LeastMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new LeastMatcher(18, [20]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new LeastMatcher(15, [13]))->run());
    }
}
