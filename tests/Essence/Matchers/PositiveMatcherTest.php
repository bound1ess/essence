<?php namespace Essence\Matchers;

class PositiveMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new PositiveMatcher(0, [], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new PositiveMatcher(1, [], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new PositiveMatcher(null, [], true))->run();
    }
}
