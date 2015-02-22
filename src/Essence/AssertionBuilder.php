<?php namespace Essence;

/**
 * This class helps build new assertions and validate them against given values.
 */
class AssertionBuilder
{

    // Fluent helps handle dynamic calls nicely.
    use \PhpPackages\Fluent\FluentTrait;

    /**
     * The value we're working with, can be anything.
     *
     * @var mixed
     */
    protected $value;

    /**
     * The error message passed by a matcher (if there were any).
     *
     * @var null|string
     */
    protected $message;

    /**
     * @see Essence\Essence::$configuration
     * @var array
     */
    protected $links = [];

    /**
     * @see Essence\Essence::$configuration
     * @var array
     */
    protected $matchers = [];

    /**
     * Whether the validation result should be inversed.
     *
     * @var boolean
     */
    protected $inverse = false;

    /**
     * The last matcher that was validated.
     *
     * @var Essence\Matchers\AbstractMatcher
     */
    protected $lastMatcher;

    /**
     * The class constructor.
     *
     * @param null|mixed $value
     * @return Essence\AssertionBuilder
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * Returns the last matcher that was validated.
     *
     * @return Essence\Matchers\AbstractMatcher
     */
    protected function getLastMatcher()
    {
        return $this->lastMatcher;
    }

    /**
     * Swaps the links array with the given one.
     *
     * @see Essence\AssertionBuilder::$links
     * @param array $links
     * @return void
     */
    public function setLinks(array $links)
    {
        $this->links = $links;
    }

    /**
     * Returns the links array.
     *
     * @see Essence\AssertionBuilder::$links
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Updates the list of available matchers.
     *
     * @see Essence\AssertionBuilder::$matchers
     * @param array $matchers
     * @return void
     */
    public function setMatchers(array $matchers)
    {
        $this->matchers = $matchers;
    }

    /**
     * Returns the matchers array.
     *
     * @see Essence\AssertionBuilder::$matchers
     * @return array
     */
    public function getMatchers()
    {
        return $this->matchers;
    }

    /**
     * Performs the validation.
     *
     * @throws Essence\Exceptions\NoMatcherFoundException
     * @return boolean
     */
    public function validate()
    {
        $matchers = [];

        // #1: find matchers.
        foreach ($this->getFluent()->getCalls() as $key) {
            // Keyword "not" inverses the end result.
            // Using it twice in the same assertion will have no effect (see the code).
            if ("not" == $key) {
                $this->inverse = true;

                continue;
            }

            if (is_array($key)) {
                // Handle "matcher+link+arguments" (instead of "matcher+arguments") cases.
                if (in_array($key[0], $this->links) and count($matchers) > 0) {
                    $lastIndex = count($matchers) - 1;
                    $matchers[$lastIndex] = [$matchers[$lastIndex], $key[1]];
                } else {
                    $matchers[] = $key;
                }

                continue;
            }

            // If the given keyword is NEITHER a link NOR "should", it must be a matcher name.
            if ( ! in_array($key, $this->links) && "should" != $key) {
                $matchers[] = $key;
            }
        }

        // If no matchers were found, just return "true" (there is no way it can be "false").
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
                $this->value, // The value we're working with.
                (is_array($matcher) ? $matcher[1] : []), // The matcher arguments.
                // Whether it should be in "configuration" or "normal" mode.
                (count($matchers) - 1 != $key) && count($matchers) != 1
            );
            // @codeCoverageIgnoreEnd
        }

        $result = true;

        // #3: run the matchers!
        foreach ($matchers as $matcher) {
            $this->lastMatcher = $matcher;

            if ( ! $matcher->run()) {
                $this->message = $matcher->getMessage();
                $result = false;

                break;
            }

            // We want to grab the message anyway.
            $this->message = $matcher->getMessage();
        }

        // #4: if the result should be inversed, do it.
        if ($this->inverse) {
            $this->inverse = false;
            $result = ! $result;

            $this->message = "NOT keyword (failed): ".$this->message;
        }

        return $result;
    }

    /**
     * Returns the error message (or null if there is none).
     *
     * @see Essence\AssertionBuilder::$message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns the "true" matcher name (class name) by one of its aliases.
     *
     * @param string $alias
     * @throws Essence\Exceptions\UnknownAliasException
     * @return string
     */
    protected function aliasToMatcher($alias)
    {
        foreach ($this->matchers as $class => $aliases) {
            if (in_array($alias, $aliases)) {
                return $class;
            }
        }

        throw new Exceptions\UnknownAliasException($alias);
    }
}
