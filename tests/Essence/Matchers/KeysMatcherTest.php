<?php namespace Essence\Matchers;

class KeysMatcherTest extends \TestCase
{

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new KeysMatcher(["foo" => 123, "bar" => 321], [["foo", "bar"]], false);

        $this->assertTrue($matcher->run());
        $this->assertNull($matcher->getMessage());

        $this->assertFalse((new KeysMatcher((object)[], ["foo"], false))->run());

        (new KeysMatcher(["foo" => 123], [], true))->run();
        $this->assertEquals(essence()->getConfiguration("matcher_settings"), [
            "Essence\Matchers\ContainMatcher" => ["foo"],
        ]);

        $this->setExpectedException("Essence\Exceptions\UnintendedUsageException");
        (new KeysMatcher(null, [], false))->run();
    }
}
