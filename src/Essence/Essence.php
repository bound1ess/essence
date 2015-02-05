<?php namespace Essence;

use Closure;

class Essence
{

    /**
     * @var array
     */
    protected $configuration = [
        "exception" => "Essence\Exceptions\AssertionException",

        "links" => [
            "to",
            "at",
            "of",
            "is",
            "have",
            "has",
            "be",
            "been",
            "with",
            "that",
            "and",
            "same",
        ],

        "matchers" => [
            "Essence\Matchers\TypeMatcher"     => ["a", "an"],
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
            "Essence\Matchers\PropertyMatcher" => ["property"],
            "Essence\Matchers\LengthMatcher"   => ["length"],
            "Essence\Matchers\MatchMatcher"    => ["match"],
            "Essence\Matchers\StringMatcher"   => ["string"],
            "Essence\Matchers\KeysMatcher"     => ["keys"],
            "Essence\Matchers\ValuesMatcher"   => ["values"],
            "Essence\Matchers\ThrowMatcher"    => ["throw"],
            "Essence\Matchers\RespondMatcher"  => ["respond"],
            "Essence\Matchers\SatisfyMatcher"  => ["satisfy"],
            "Essence\Matchers\CloseMatcher"    => ["close"],
            "Essence\Matchers\MembersMatcher"  => ["members"],
        ],
    ];

    /**
     * @var array
     */
    protected $defaultConfiguration;

    /**
     * @var AssertionBuilder
     */
    protected $builder;

    /**
     * @param mixed $value
     * @return Essence
     */
    public function __construct($value = null)
    {
        $this->defaultConfiguration = $this->configuration;
        $this->builder = new AssertionBuilder($value);
    }

    /**
     * Throws an exception (specified in the configuration) with the given error message.
     *
     * @param string|null $message
     * @throws Exceptions\AssertionException|object
     * @return void
     */
    public function throwOnFailure($message = null)
    {
        $class = $this->configuration["exception"];

        throw new $class($message);
    }

    /**
     * Returns the configuration array.
     *
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Allows you to configure Essence via a Closure.
     *
     * @throws Exceptions\InvalidConfiguraitonException
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
     * Returns the currently stored instance of AssertionBuilder.
     *
     * @return AssertionBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Replaces the stored AssertionBuilder instance with the given one.
     *
     * @param AssertionBuilder $builder
     * @return void
     */
    public function setBuilder(AssertionBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Allows us to explicitly perform the validation.
     *
     * @throws Exceptions\AssertionException|object
     * @return void
     */
    public function go()
    {
        $this->builder->setLinks($this->configuration["links"]);
        $this->builder->setMatchers($this->configuration["matchers"]);

        if ( ! $this->builder->validate()) {
            $this->throwOnFailure($this->builder->getMessage());
            // @codeCoverageIgnoreStart
        }
    }
    // @codeCoverageIgnoreEnd

    /**
     * Redirects all calls (to undefined methods) to the builder instance.
     *
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
     * @see Essence::__call
     * @param string $name
     * @return object
     */
    public function __get($name)
    {
        call_user_func_array([$this->builder, $name], []);

        return $this;
    }
}
