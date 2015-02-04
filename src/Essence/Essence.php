<?php namespace Essence;

use Closure;

class Essence
{

    /**
     * @var array
     */
    protected $configuration = [
        "exception" => "Essence\Exceptions\AssertionException",
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
     * This trick allows us to implicitly perform the validation.
     *
     * @return void
     */
    public function __destruct()
    {
        if ( ! $this->builder->validate()) {
            $this->throwOnFailure($this->builder->getMessage());
        }
    }
}
