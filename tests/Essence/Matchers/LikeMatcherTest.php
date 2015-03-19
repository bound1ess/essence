<?php namespace Essence\Matchers;

class LikeMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\LikeMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new LikeMatcher(true, [null]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new LikeMatcher(1, [true]))->run());
    }

    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
    }
}
