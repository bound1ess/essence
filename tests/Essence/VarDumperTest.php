<?php namespace Essence;

class VarDumperTest extends \TestCase
{

    protected $subject = "Essence\VarDumper";

    /**
     * @test
     */
    public function it_prints_a_string()
    {
        $this->assertEquals($this->subject->dump("foobar"), "'foobar'");
        $this->assertEquals($this->subject->dump("foo".PHP_EOL."bar"), "'foo\\nbar'");

        $this->assertEquals(
            $this->subject->dump(str_repeat("a", 100)),
            "'".str_repeat("a", 30)."...'"
        );

        $this->assertEquals(
            $this->subject->dump("foobar".PHP_EOL.str_repeat("a", 30)),
            "'foobar\\n".str_repeat("a", 22)."...'"
        );
    }

    /**
     * @test
     */
    public function it_prints_an_integer()
    {
        $this->assertEquals($this->subject->dump(14896), "14896");
        $this->assertEquals($this->subject->dump(-1490), "-1490");
    }

    /**
     * @test
     */
    public function it_prints_a_float()
    {
        $this->assertEquals($this->subject->dump(41.4151515), "41.4151515");
        $this->assertEquals($this->subject->dump(-0.879), "-0.879");
        $this->assertEquals($this->subject->dump(2e6), "2e6");
    }

    /**
     * @test
     */
    public function it_prints_a_boolean()
    {
        $this->assertEquals($this->subject->dump(true), "true");
        $this->assertEquals($this->subject->dump(false), "false");
    }

    /**
     * @test
     */
    public function it_prints_null()
    {
        $this->assertEquals($this->subject->dump(null), "null");
    }

    /**
     * @test
     */
    public function it_prints_an_array()
    {
        $this->assertEquals($this->subject->dump([]), "array[0]");
        $this->assertEquals($this->subject->dump([1, 2, 3]), "array[3]");
    }

    /**
     * @test
     */
    public function it_prints_an_object()
    {
        $object = new \stdClass;

        $this->assertEquals(
            $this->subject->dump($object),
            sprintf("stdClass(#%s)", spl_object_hash($object))
        );
    }
}
