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

        $this->assertFalse((new FalseMatcher(true))->run());
    }

    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
    }
}
