<?php namespace Essence\Matchers;

interface MatcherInterface
{

    /**
     * The class constructor.
     *
     * @param mixed $value
     * @param array $arguments
     * @param boolean $configurationOnly
     */
    public function __construct($value, array $arguments = [], $configurationOnly = false);

    /**
     * Whether the given value is valid (in terms of the matcher).
     *
     * @return boolean
     */
    public function run();

    /**
     * Returns the error message (if there was an error) or an empty string.
     *
     * @return string
     */
    public function getMessage();
}
