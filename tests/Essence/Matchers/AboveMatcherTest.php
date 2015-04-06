<?php namespace Essence\Matchers;

class AboveMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\AboveMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new AboveMatcher(18, [20]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertEquals($matcher->getValue(), 18);
        $this->assertEquals($matcher->getArguments(), [20]);

        essence()->setMatcherConfiguration("Essence\Matchers\LengthMatcher", [
            "length" => 15,
        ]);

        $this->assertTrue((new AboveMatcher(10, [13]))->run());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_arguments_were_provided()
    {
        $this->setExpectedException("Essence\Exceptions\IncorrectUsageException");

        (new AboveMatcher(6, []))->run();
    }
}
