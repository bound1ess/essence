<?php namespace Essence\Matchers;

class EqualMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new EqualMatcher(true, [1], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new EqualMatcher(1, [1], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new EqualMatcher(null, [], true))->run();
    }
}
