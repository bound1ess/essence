<?php namespace Essence\Matchers;

class ContainMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ContainMatcher([1, 2, 3], [true], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new ContainMatcher("foobar", ["foo"], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new ContainMatcher([], [], true))->run();
    }
}
