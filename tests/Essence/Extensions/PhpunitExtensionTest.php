<?php namespace Essence\Extensions;

class PhpunitExtensionTest extends \TestCase
{

    protected $subject = "Essence\Extensions\PhpunitExtension";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $extension = \Mockery::mock(get_class($this->subject)."[assertTrue]");
        $extension->shouldReceive("assertTrue")
            ->twice()
            ->with(true)
            ->andReturn(null);

        essence()->setBuilder($this->mockAssertionBuilder());
        essence()->setBuilder($this->mockAssertionBuilder());

        $extension->tearDown();
    }

    protected function mockAssertionBuilder()
    {
        $builder = \Mockery::mock("Essence\AssertionBuilder");

        $builder->shouldReceive("validate")
            ->once()
            ->andReturn(true);

        $builder->shouldReceive("setLinks", "setMatchers")
            ->once()
            ->andReturn(null);

        return $builder;
    }
}
