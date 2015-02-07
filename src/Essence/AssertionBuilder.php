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
     * @throws Exceptions\NoMatcherFoundException
     * @return boolean
     */
    public function validate()
    {
        $matchers = [];

        // #1: find matchers.
        foreach ($this->getFluent()->getCalls() as $key) {
            if ("not" == $key) {
                $this->inverse = true;

                continue;
            }

            if (is_array($key)) {
                if (in_array($key[0], $this->links) and count($matchers) > 0) {
                    $lastIndex = count($matchers) - 1;
                    $matchers[$lastIndex] = [$matchers[$lastIndex], $key[1]];
                } else {
                    $matchers[] = $key;
                }

                continue;
            }

            if ( ! in_array($key, $this->links) && "should" != $key) {
                $matchers[] = $key;
            }
        }

        if (count($matchers) == 0) {
            return true;
        }

        // #2: initialize the matchers.
        foreach ($matchers as $key => $matcher) {
            $class = $this->aliasToMatcher(is_array($matcher) ? $matcher[0] : $matcher);

            if ( ! class_exists($class)) {
                throw new Exceptions\NoMatcherFoundException($class);
            }

            $matchers[$key] = new $class(
                // @codeCoverageIgnoreStart
                $this->value,
                (is_array($matcher) ? $matcher[1] : []),
                (count($matchers) - 1 != $key) && count($matchers) != 1
            );
            // @codeCoverageIgnoreEnd
        }

        $result = true;

        // #3: run the matchers!
        foreach ($matchers as $matcher) {
            if ( ! $matcher->run()) {
                $this->message = $matcher->getMessage();
                $result = false;

                break;
            }
        }

        if ($this->inverse) {
            $this->inverse = false;
            $result = ! $result;

            $this->message = "The keyword NOT was used to inverse the result.";
        }

        return $result;
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
