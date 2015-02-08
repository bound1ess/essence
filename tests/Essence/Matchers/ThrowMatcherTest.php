<?php namespace Essence\Matchers;

class ThrowMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\ThrowMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ThrowMatcher(function() {}, ["RuntimeException"]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertFalse((new ThrowMatcher(function() {
            throw new \Exception;
        }, ["InvalidArgumentException"]))->run());

        $this->assertTrue((new ThrowMatcher(function() {
            throw new \UnexpectedValueException;
        }, ["UnexpectedValueException"]))->run());
    }
}
