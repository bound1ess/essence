<?php namespace Essence;

class AssertionBuilder
{

    use \PhpPackages\Fluent\FluentTrait;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var null|string
     */
    protected $message;

    /**
     * @var array
     */
    protected $links = [];

    /**
     * @var array
     */
    protected $matchers = [];

    /**
     * @param mixed $value
     * @return AssertionBuilder
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * Updates the list of available links.
     *
     * @param array $links
     * @return void
     */
    public function setLinks(array $links)
    {
        $this->links = $links;
    }

    /**
     * Returns the links stored.
     *
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Updates the list of available matchers.
     *
     * @param array $matchers
     * @return void
     */
    public function setMatchers(array $matchers)
    {
        $this->matchers = $matchers;
    }

    /**
     * Returns the matchers stored.
     *
     * @return array
     */
    public function getMatchers()
    {
        return $this->matchers;
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
        return $this->message;
    }
}
