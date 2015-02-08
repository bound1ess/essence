<?php namespace Essence\Matchers;

class PositiveMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\PositiveMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new PositiveMatcher(0);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new PositiveMatcher(1))->run());
    }

    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
    }
}
