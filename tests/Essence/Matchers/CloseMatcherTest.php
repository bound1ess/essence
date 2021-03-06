<?php namespace Essence\Matchers;

class CloseMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\CloseMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new CloseMatcher(1.234, [1.123405, 0.001]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new CloseMatcher(5.251, [5.25105, 0.001]))->run());
    }
}
