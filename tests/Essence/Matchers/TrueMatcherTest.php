<?php namespace Essence\Matchers;

class TrueMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\TrueMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new TrueMatcher(false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new TrueMatcher(true))->run());
    }
}
