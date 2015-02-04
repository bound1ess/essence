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
        $this->assertNotCount(0, $output);
        $this->assertArrayHasKey("foo", $output);
        $this->assertInternalType("array", $output["foo"]);

        $this->setExpectedException("Essence\Exceptions\InvalidConfigurationException", null);
        $this->subject->configure(function() {
            return null;
        });
    }

    /**
     * @test
     */
    public function it_will_override_the_configuration_with_default_values_if_you_mess_up()
    {
        $key = array_keys($configuration = $this->subject->getConfiguration())[0];

        $this->assertArrayHasKey($key, $configuration);

        $this->subject->configure(function() {
            return [];
        });

        $this->assertArrayHasKey($key, $this->subject->getConfiguration());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_specified_by_the_configuration()
    {
        $this->setExpectedException("Essence\Exceptions\AssertionException", null);
        $this->subject->throwOnFailure();
    }

    /**
     * @test
     */
    public function it_allows_you_to_change_the_exception_class()
    {
        $this->subject->configure(function() {
            return ["exception" => "RuntimeException"];
        });

        $this->setExpectedException("RuntimeException", "foobar");
        $this->subject->throwOnFailure("foobar");
    }

    /**
     * @test
     */
    public function it_validates_the_assertion_on_destruction_event()
    {
        $builder = \Mockery::mock("Essence\AssertionBuilder");

        $builder->shouldReceive("validate")->once()->andReturn(false);
        $builder->shouldReceive("getMessage")->once()->andReturn("foobar");

        $this->assertInstanceOf("Essence\AssertionBuilder", $this->subject->getBuilder());
        $this->subject->setBuilder($builder);

        $this->setExpectedException("Essence\Exceptions\AssertionException", "foobar");
        unset($this->subject);
    }
}
