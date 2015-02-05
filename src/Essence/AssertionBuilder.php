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
     * @var boolean
     */
    protected $inverse = false;

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
        $matchers = [];

        foreach ($this->getFluent()->getCalls() as $key) {
            if ("not" == $key) {
                $this->inverse = ! $this->inverse;
            } elseif (is_array($key) || (! in_array($key, $this->links) && "should" != $key)) {
                $matchers[] = $key;
            }
        }

        foreach ($matchers as $matcher) {
            $class = $this->aliasToMatcher(is_array($matcher) ? $matcher[0] : $matcher);

            var_dump($class);
        }

        return true;
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

    /**
     * Returns the "true" matcher's name (class name) by one of its aliases.
     *
     * @param string $alias
     * @throws Exceptions\UnknownAliasException
     * @return string
     */
    protected function aliasToMatcher($alias)
    {
        foreach ($this->matchers as $matcher => $aliases) {
            if (in_array($alias, $aliases)) {
                return $matcher;
            }
        }

        throw new Exceptions\UnknownAliasException($alias);
    }
}
