<?php namespace Essence\Matchers;

class EmptyMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new EmptyMatcher("foobar", [], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new EmptyMatcher("", [], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new EmptyMatcher(null, [], true))->run();
    }
}
