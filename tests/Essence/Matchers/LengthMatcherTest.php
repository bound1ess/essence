<?php namespace Essence\Matchers;

class LengthMatcherTest extends \TestCase
{

    protected $subject = "Essence\Matchers\LengthMatcher";

    protected $arguments = ["foobar", [50], false];

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        // Strings.
        $this->assertNull($this->subject->getMessage());
        $this->assertFalse($this->subject->run());
        $this->assertNotNull($this->subject->getMessage());

        // Arrays.
        $this->assertFalse((new LengthMatcher([1, 2, 3], [10], false))->run());

        // Objects (keys).
        $object = (object)["foo" => 123, "bar" => 321];
        $this->assertTrue((new LengthMatcher($object, [2], false))->run());

        // Anlything else.
        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new LengthMatcher(null, [1], false))->run();
    }

    /**
     * @test
     */
    public function it_throws_UnintendedUsage_exception()
    {
        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");

        (new LengthMatcher(null, [], true))->run();
    }
}
