<?php namespace Essence\Matchers;

class ThrowMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new ThrowMatcher(function() {}, ["RuntimeException"], false);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertFalse((new ThrowMatcher(function() {
            throw new \Exception;
        }, ["InvalidArgumentException"], false))->run());

        $this->assertTrue((new ThrowMatcher(function() {
            throw new \UnexpectedValueException;
        }, ["UnexpectedValueException"], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new ThrowMatcher(null, [], true))->run();
    }
}
