<?php namespace Essence\Matchers;

class TypeMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\TypeMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new TypeMatcher("foobar", ["array"]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertFalse((new TypeMatcher(12.45, ["NULL"]))->run());

        $this->assertFalse((new TypeMatcher(123, ["stdClass"]))->run());

        $this->assertTrue((new TypeMatcher(new \stdClass, ["stdClass"]))->run());
    }
}
