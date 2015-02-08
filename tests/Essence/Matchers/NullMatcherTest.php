<?php namespace Essence\Matchers;

class NullMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\NullMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new NullMatcher(true);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new NullMatcher(null))->run());
    }
}
