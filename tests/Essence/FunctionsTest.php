<?php

class FunctionsTest extends TestCase
{

    /**
     * @test
     */
    public function it_returns_the_same_instance_of_Container()
    {
        $this->assertInstanceOf(
            "PhpPackages\Container\Container",
            $container = essence_get_container()
        );

        $this->assertSame($container, essence_get_container());
    }

    /**
     * @test
     */
    public function it_provides_four_entry_points()
    {
        $instances = [it(null), this(null), these(null), those(null)];

        foreach ($instances as $instance) {
            $this->assertInstanceOf("Essence\Essence", $instance);
        }
    }

    /**
     * @test
     */
    public function it_provides_wrappers_for_better_readability()
    {
        $this->assertEquals(expect(123), 123);
    }
}
