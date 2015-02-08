<?php namespace Essence\Matchers;

class EqualMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\EqualMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new EqualMatcher(true, [1]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new EqualMatcher(1, [1]))->run());
    }

    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
    }
}
