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
}
