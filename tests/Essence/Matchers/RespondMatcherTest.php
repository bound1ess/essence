<?php namespace Essence\Matchers;

class RespondMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $object = new \KeysMatcherStub;
        $matcher = new RespondMatcher($object, ["run"], false);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertFalse((new RespondMatcher($object, ["foo"], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new RespondMatcher(null, [null], true))->run();
    }
}
