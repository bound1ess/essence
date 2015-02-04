<?php namespace Essence;

class EssenceTest extends \TestCase
{

    protected $subject = "Essence\Essence";

    /**
     * @test
     */
    public function it_allows_you_to_configure_Essence_via_a_Closure()
    {
        $this->assertInternalType("array", $this->subject->getConfiguration());

        $this->subject->configure(function($configuration) {
            return ["foo" => $configuration];
        });

        $this->assertInternalType("array", $output = $this->subject->getConfiguration());
        $this->assertCount(1, $output);
        $this->assertArrayHasKey("foo", $output);
        $this->assertInternalType("array", $output["foo"]);

        $this->setExpectedException("Essence\Exceptions\InvalidConfigurationException");
        $this->subject->configure(function() {
            return null;
        });
    }
}
