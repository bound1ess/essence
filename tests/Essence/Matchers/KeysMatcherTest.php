<?php namespace Essence\Matchers;

class KeysMatcherTest extends \MatcherTestCase
{

    protected $subject = "Essence\Matchers\KeysMatcher";

    /**
     * @test
     */
    public function it_works_as_expected()
    {
        $matcher = new KeysMatcher(["foo" => 123, "bar" => 321], [["foo", "baz"]]);

        $this->assertFalse($matcher->run());
        $this->assertNotNull($matcher->getMessage());

        $this->assertTrue((new KeysMatcher((object)["foo" => "bar"], ["foo"]))->run());

        (new KeysMatcher(["foo" => 123], [], true))->run();

        $this->assertEquals(essence()->getConfiguration("matcher_settings"), [
            "Essence\Matchers\ContainMatcher" => ["foo"],
        ]);
    }
}
