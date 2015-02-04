<?php namespace Essence;

use Closure;

class Essence
{

    /**
     * @var array
     */
    protected $configuration = [];

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

        $this->configuration = $configuration;
    }
}
