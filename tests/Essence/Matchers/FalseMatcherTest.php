<?php namespace Essence\Matchers;

class FalseMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\FalseMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new FalseMatcher(true);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new FalseMatcher(false))->run());
    }
}
