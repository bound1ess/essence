<?php namespace Essence;

use Closure;

/**
 * The main class that ties everything together.
 */
class Essence
{

    /**
     * The Essence configuration map.
     *
     * @var array
     */
    protected $configuration = [
        // Will be thrown when an assertion fails.
        "exception" => "Essence\Exceptions\AssertionException",

        // When a new assertion was created, validate the previous one.
        "implicit_validation" => true,

        // These don't have any special meaning, but do drastically improve the readability.
        "links" => [
            "to",
            "at",
            "of",
            "have",
            "be",
        ],

        // Don't have much to say here. A single matcher can have 1+ aliases.
        "matchers" => [
            "Essence\Matchers\TypeMatcher"     => ["a", "an", "type"],
            "Essence\Matchers\ContainMatcher"  => ["contain", "include"],
            "Essence\Matchers\PositiveMatcher" => ["ok", "fine"],
            "Essence\Matchers\TrueMatcher"     => ["true"],
            "Essence\Matchers\FalseMatcher"    => ["false"],
            "Essence\Matchers\NullMatcher"     => ["null"],
            "Essence\Matchers\EmptyMatcher"    => ["empty"],
            "Essence\Matchers\EqualMatcher"    => ["equal"],
            "Essence\Matchers\AboveMatcher"    => ["above"],
            "Essence\Matchers\LeastMatcher"    => ["least"],
            "Essence\Matchers\BelowMatcher"    => ["below"],
            "Essence\Matchers\MostMatcher"     => ["most"],
            "Essence\Matchers\WithinMatcher"   => ["within"],
            "Essence\Matchers\LengthMatcher"   => ["length"],
            "Essence\Matchers\MatchMatcher"    => ["match"],
            "Essence\Matchers\KeysMatcher"     => ["keys", "key"],
            "Essence\Matchers\ValuesMatcher"   => ["values", "value"],
            "Essence\Matchers\ThrowMatcher"    => ["throw"],
            "Essence\Matchers\RespondMatcher"  => ["respond"],
            "Essence\Matchers\CloseMatcher"    => ["close"],
        ],

        // An interaction point between normal matchers and those ran in "configruration" mode.
        "matcher_settings" => [],
    ];

    /**
     * An exact copy of $configuration.
     *
     * @see Essence\Essence::__construct
     * @var array
     */
    protected $defaultConfiguration;

    /**
     * An instance of AssertionBuilder (a new one will be created for every single assertion).
     *
     * @var Essence\AssertionBuilder
     */
    protected $builder;

    /**
     * The class constructor.
     *
     * @return Essence\Essence
     */
    public function __construct()
    {
        // Makes the configuration process simpler.
        $this->defaultConfiguration = $this->configuration;
    }

    /**
     * Throws an exception (specified in the configuration) with the given error message.
     *
     * @param string $message
     * @throws Essence\Exceptions\AssertionException|object
     * @return void
     */
    public function throwOnFailure($message)
    {
        $class = $this->configuration["exception"];

        throw new $class($message);
    }

    /**
     * Returns the entire configuration array or a single key-value pair from it.
     *
     * @param string|null $key
     * @return array|null|mixed
     */
    public function getConfiguration($key = null)
    {
        if ( ! is_null($key)) {
            return array_key_exists($key, $this->configuration)
                ? $this->configuration[$key] : null;
        }

        return $this->configuration;
    }

    /**
     * Returns the configuration for the given matcher, or null.
     *
     * @param string $matcherClass
     * @return array|null
     */
    public function getMatcherConfiguration($matcherClass)
    {
        if ( ! array_key_exists($matcherClass, $this->configuration["matcher_settings"])) {
            return null;
        }

        $configuration = $this->configuration["matcher_settings"][$matcherClass];

        unset($this->configuration["matcher_settings"][$matcherClass]);

        return $configuration;
    }

    /**
     * Sets the matcher configuration.
     *
     * @param string $matcherClass
     * @param array $value
     * @return void
     */
    public function setMatcherConfiguration($matcherClass, array $value)
    {
        $this->configuration["matcher_settings"][$matcherClass] = $value;
    }

    /**
     * Configures Essence via the given Closure.
     *
     * @throws Essence\Exceptions\InvalidConfiguraitonException
     * @param Closure $callback
     * @return void
     */
    public function configure(Closure $callback)
    {
        if ( ! is_array($configuration = $callback($this->configuration))) {
            throw new Exceptions\InvalidConfigurationException($configuration);
        }

        $this->configuration = array_merge($this->defaultConfiguration, $configuration);
    }

    /**
     * Adds a new link to the configuration array.
     *
     * @see Essence\Essence::$configuration
     * @param string $link
     * @return void
     */
    public function addLink($link)
    {
        $this->configuration["links"][] = $link;
    }

    /**
     * Adds a new matcher to the configuration array.
     *
     * @see Essence\Essence::$configuration
     * @param string $matcherClass
     * @param array $aliases
     * @return void
     */
    public function addMatcher($matcherClass, array $aliases)
    {
        $this->configuration["matchers"][$matcherClass] = $aliases;
    }

    /**
     * Returns the currently stored instance of AssertionBuilder.
     *
     * @see Essence\Essence::$builder
     * @see Essence\Essence::setBuilder
     * @return Essence\AssertionBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Replaces the stored AssertionBuilder instance with the given one.
     *
     * @see Essence\Essence::$builder
     * @see Essence\Essence::getBuilder
     * @param Essence\AssertionBuilder $builder
     * @return void
     */
    public function setBuilder(AssertionBuilder $builder)
    {
        if ( ! is_null($this->builder) and $this->configuration["implicit_validation"]) {
            $this->builder->go();
        }

        $this->builder = $builder;
    }

    /**
     * Explicitly performs the validation.
     *
     * @throws Essence\Exceptions\AssertionException|object
     * @return boolean
     */
    public function go()
    {
        $this->builder->setLinks($this->configuration["links"]);
        $this->builder->setMatchers($this->configuration["matchers"]);

        if ( ! $this->builder->validate()) {
            $this->throwOnFailure($this->builder->getMessage());
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        return true;
    }

    /**
     * Alias of Essence\Essence::go().
     *
     * @see Essence\Essence::go
     * @return boolean
     */
    public function validate()
    {
        return $this->go();
    }

    /**
     * Redirects all calls (to undefined methods) to the builder instance.
     *
     * @see Essence\Essence::$builder
     * @see Essence\Essence::__get
     * @param string $name
     * @param array $arguments
     * @return object
     */
    public function __call($name, array $arguments)
    {
        call_user_func_array([$this->builder, $name], $arguments);

        return $this;
    }

    /**
     * Same, but for undefined properties.
     *
     * @see Essence\Essence::__call
     * @see Essence\Essence::$builder
     * @param string $name
     * @return object
     */
    public function __get($name)
    {
        call_user_func_array([$this->builder, $name], []);

        return $this;
    }
}
