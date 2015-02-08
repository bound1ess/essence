<?php namespace Essence\Matchers;

class AboveMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\AboveMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new AboveMatcher(18, [20], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new AboveMatcher(15, [13], false))->run());
    }
}
