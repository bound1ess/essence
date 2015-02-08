<?php namespace Essence\Matchers;

class BelowMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\BelowMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new BelowMatcher(5, [4]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new BelowMatcher(8, [10]))->run());
    }
}
