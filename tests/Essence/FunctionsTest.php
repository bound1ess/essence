<?php

class FunctionsTest extends TestCase
{

    /**
     * @test
     */
    public function it_returns_the_same_instance_of_Essence()
    {
        $this->assertInstanceOf("Essence\Essence", $essence = essence());

        $this->assertSame($essence, essence());
    }

    /**
     * @test
     */
    public function it_provides_five_entry_points()
    {
        $instances = [it(null), this(null), these(null), those(null), that(null)];

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
