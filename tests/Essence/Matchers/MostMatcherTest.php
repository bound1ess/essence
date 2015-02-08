<?php namespace Essence\Matchers;

class MostMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\MostMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new MostMatcher(20, [18]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new MostMatcher(15, [15]))->run());
    }
}
