<?php namespace Essence\Matchers;

class ValuesMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\ValuesMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ValuesMatcher([], 5);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new ValuesMatcher([1, 2, 3], [3]))->run());

        $this->assertFalse((new ValuesMatcher(["foo"], [["foo", "bar"]]))->run());
    }
}
