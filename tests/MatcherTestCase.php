<?php

abstract class MatcherTestCase extends TestCase
{

    abstract public function it_works_as_expected();

    /**
     * @test
     * @expectedException Essence\Exceptions\IncorrectUsageException
     */
    public function it_throws_an_exception_if_you_run_a_matcher_in_unsupported_mode()
    {
        $matcher = $this->subject;

        (new $matcher(null, [], true))->run();
    }

    /**
     * @test
     * @expectedException Essence\Exceptions\IncorrectUsageException
     */
    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
        $matcher = $this->subject;

        (new $matcher(null))->run();
    }
}
