<?php namespace Essence\Matchers;

class ValuesMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ValuesMatcher([], [], true);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertTrue((new ValuesMatcher([1, 2, 3], [3], false))->run());
        $this->assertFalse((new ValuesMatcher(["foo"], [["foo", "bar"]], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new ValuesMatcher(null, [], true))->run();
    }
}
