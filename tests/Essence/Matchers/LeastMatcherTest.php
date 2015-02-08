<?php namespace Essence\Matchers;

class LeastMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new LeastMatcher(18, [20], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new LeastMatcher(15, [13], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new LeastMatcher(null, [], true))->run();
    }
}
