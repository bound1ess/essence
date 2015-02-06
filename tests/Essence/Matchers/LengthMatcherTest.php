<?php namespace Essence\Matchers;

class LengthMatcherTest extends \TestCase
{

    protected $subject = "Essence\Matchers\LengthMatcher";

    protected $arguments = ["foobar", [6], false];

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        // Strings.
        // Arrays.
        // Objects (keys).
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
