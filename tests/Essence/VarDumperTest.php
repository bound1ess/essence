<?php namespace Essence;

class VarDumperTest extends \TestCase
{

    protected $subject = "Essence\VarDumper";

    /**
     * @test
     */
    public function it_prints_a_string()
    {
        $this->assertEquals($this->subject->dump("foobar"), "foobar");
        $this->assertEquals($this->subject->dump("foo".PHP_EOL."bar"), "foo\\nbar");

        $this->assertEquals(
            $this->subject->dump(str_repeat("a", 100)),
            str_repeat("a", 30)."..."
        );

        $this->assertEquals(
            $this->subject->dump("foobar".PHP_EOL.str_repeat("a", 30)),
            "foobar\\n".str_repeat("a", 22)."..."
        );
    }
}
