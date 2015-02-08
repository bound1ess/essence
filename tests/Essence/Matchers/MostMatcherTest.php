<?php namespace Essence\Matchers;

class MostMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new MostMatcher(20, [18], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new MostMatcher(15, [15], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new MostMatcher(null, [], true))->run();
    }
}
