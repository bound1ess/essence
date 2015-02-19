<?php namespace Essence\Extensions;

/**
 * This class helps you integrate Essence into PHPUnit.
 */
class PhpunitExtension extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function tearDown()
    {
        $assertions = essence()->validateAll();

        for ($index = 0; $index < $assertions; $index += 1) {
            // The fastest one (I believe).
            $this->assertTrue(true);
        }

        // If Mockery is utilised.
        if (class_exists("Mockery")) {
            \Mockery::close();
        }
    }
}
