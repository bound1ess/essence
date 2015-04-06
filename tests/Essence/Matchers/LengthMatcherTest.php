<?php namespace Essence\Matchers;

class LengthMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\LengthMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        // Strings.
        $matcher = new LengthMatcher("foobar", [5]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        // Arrays.
        $this->assertFalse((new LengthMatcher([1, 2, 3], [10]))->run());

        // Objects (keys).
        $object = (object)["foo" => 123, "bar" => 321];
        $this->assertTrue((new LengthMatcher($object, [2]))->run());

        // Run in configuration mode.
        (new LengthMatcher([1, 2, 3], [], true))->run();

        $this->assertInternalType(
            "array",
            $config = essence()->getMatcherConfiguration("Essence\Matchers\LengthMatcher")
        );

        $this->assertEquals(3, $config["length"]);
    }
}
