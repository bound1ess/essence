<?php namespace Essence;

class AssertionBuilder
{

    use \PhpPackages\Fluent\FluentTrait;

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
