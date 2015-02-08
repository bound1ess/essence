<?php namespace Essence\Matchers;

class TypeMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new TypeMatcher("foobar", ["string"], false);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertFalse((new TypeMatcher(12.45, ["NULL"], false))->run());

        $this->assertFalse((new TypeMatcher(123, ["stdClass"], false))->run());
        $this->assertTrue((new TypeMatcher(new \stdClass, ["stdClass"], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new TypeMatcher(null, [null], true))->run();
    }
}
