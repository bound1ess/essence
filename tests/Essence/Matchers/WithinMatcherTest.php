<?php namespace Essence\Matchers;

class WithinMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new WithinMatcher(7, [5, 10], false);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertFalse((new WithinMatcher(10, [10, 9], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new WithinMatcher(null, [], true))->run();
    }
}
