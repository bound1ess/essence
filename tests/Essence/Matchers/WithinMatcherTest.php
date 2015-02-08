<?php namespace Essence\Matchers;

class WithinMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\WithinMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new WithinMatcher(7, [9, 11]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new WithinMatcher(10, [9, 11]))->run());
    }
}
