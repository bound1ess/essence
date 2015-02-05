<?php namespace Essence;

class AssertionBuilder
{

    use \PhpPackages\Fluent\FluentTrait;

    /**
     * @param mixed $value
     * @return AssertionBuilder
     */
    public function __construct($value = null)
    {
        // @todo
    }

    /**
     * Updates the list of available links.
     *
     * @param array $links
     * @return void
     */
    public function setLinks(array $links)
    {
        // @todo
    }

    /**
     * Updates the list of available matchers.
     *
     * @param array $matchers
     * @return void
     */
    public function setMatchers(array $matchers)
    {
        // @todo
    }

    /**
     * Performs the validation.
     *
     * @return boolean
     */
    public function validate()
    {
        return false; // or true
    }

    /**
     * Returns the error message (null if there is none).
     *
     * @return string|null
     */
    public function getMessage()
    {
        return "something or null";
    }
}
