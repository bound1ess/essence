<?php namespace Essence\Matchers;

class RespondMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\RespondMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $object = new \KeysMatcherStub;
        $matcher = new RespondMatcher($object, ["foo"]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertFalse((new RespondMatcher($object, ["foo"]))->run());
    }
}
