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
        $this->configuration = $callback($this->configuration);
    }
}
