<?php namespace Essence\Matchers;

class TrueMatcherTest extends \TestCase
{

    protected $subject = "Essence\Matchers\TrueMatcher";

    protected $arguments = [false, [], false];

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $this->assertFalse($this->subject->run());
        $this->assertNotNull($this->subject->getMessage());

        $this->assertTrue((new TrueMatcher(true, [], false))->run());

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new TrueMatcher(null, [], true))->run();
    }
}
