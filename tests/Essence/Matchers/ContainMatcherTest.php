<?php namespace Essence\Matchers;

class ContainMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\ContainMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ContainMatcher([1, 2, 3], [true]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new ContainMatcher("foobar", ["foo"]))->run());

        essence()->configure(function($configuration) {
            $configuration["matcher_settings"]["Essence\Matchers\ContainMatcher"] = [];

            return $configuration;
        });

        $this->assertFalse((new ContainMatcher([], ["foo"]))->run());
    }
}
