<?php namespace Essence\Matchers;

class BelowMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new BelowMatcher(5, [4], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new BelowMatcher(8, [10], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new BelowMatcher(null, [], true))->run();
    }
}
