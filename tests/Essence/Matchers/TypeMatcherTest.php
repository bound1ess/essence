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

        $this->assertTrue((new TypeMatcher(12.45, ["double"]))->run());

        $this->assertFalse((new TypeMatcher(123, ["stdClass"]))->run());

        $this->assertTrue((new TypeMatcher(new \stdClass, ["stdClass"]))->run());
    }

    public function it_throws_an_exception_if_you_pass_wrong_value_to_the_matcher()
    {
    }
}
