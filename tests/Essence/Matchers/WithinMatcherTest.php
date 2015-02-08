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

        $this->assertFalse((new WithinMatcher(10, [10, 9]))->run());
    }
}
