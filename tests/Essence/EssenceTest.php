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
    public function it_provides_nice_helper_methods_for_configuring_Essence()
    {
        $this->subject->addLink("foo");
        $this->subject->addMatcher("bar", ["baz"]);

        $configuration = $this->subject->getConfiguration();

        $this->assertContains("foo", $configuration["links"]);
        $this->assertArrayHasKey("bar", $configuration["matchers"]);
        $this->assertEquals(["baz"], $configuration["matchers"]["bar"]);

        $this->subject->implicitValidation(false);
        $this->assertSame(false, $this->subject->getConfiguration("implicit_validation"));
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
    public function it_returns_a_single_configuration_value()
    {
        $this->subject->configure(function() {
            return ["foo" => 123];
        });

        $this->assertEquals($this->subject->getConfiguration("foo"), 123);
        $this->assertEquals($this->subject->getConfiguration("bar"), null);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_specified_by_the_configuration()
    {
        $this->setExpectedException("Essence\Exceptions\AssertionException", "Error message.");
        $this->subject->throwOnFailure("Error message.");
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
    public function it_validates_the_assertion()
    {
        $builder = $this->mockAssertionBuilder();

        $builder->shouldReceive("validate")->twice()->andReturn(true, false);
        $builder->shouldReceive("getMessage")->once()->andReturn("foobar");
        $builder->shouldReceive("setLinks")->twice();
        $builder->shouldReceive("setMatchers")->twice();

        $this->subject->setBuilder($builder);
        $this->assertInstanceOf("Essence\AssertionBuilder", $this->subject->getBuilder());

        $this->assertTrue($this->subject->validate());

        $this->setExpectedException("Essence\Exceptions\AssertionException", "foobar");
        $this->subject->go();
    }

    /**
     * @test
     */
    public function it_validates_all_assertions()
    {
        $builder1 = $this->mockAssertionBuilder();
        $builder2 = $this->mockAssertionBuilder();

        // Enable implicit validaiton.
        $this->subject->implicitValidation(true);

        $builder1->shouldReceive("validate", "setLinks", "setMatchers")
            ->twice()->andReturn(true);

        $builder2->shouldReceive("validate", "setLinks", "setMatchers")
            ->once()->andReturn(true);

        $this->subject->setBuilder($builder1);
        $this->subject->setBuilder($builder2);

        $this->assertSame(2, $this->subject->validateAll());
        $this->assertSame($builder2, $this->subject->getBuilder());

        // Intended.
        $this->assertSame(0, $this->subject->validateAll());
        $this->assertSame($builder2, $this->subject->getBuilder());
    }

    /**
     * @test
     */
    public function it_redirects_calls()
    {
        $builder = $this->mockAssertionBuilder();

        $builder->shouldReceive("foo")->twice();

        $this->subject->setBuilder($builder);

        $this->subject->foo();
        $this->subject->foo;
    }

    protected function mockAssertionBuilder()
    {
        return \Mockery::mock("Essence\AssertionBuilder");
    }
}
