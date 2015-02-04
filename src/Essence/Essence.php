<?php namespace Essence;

use Closure;

class Essence
{

    /**
     * @var array
     */
    protected $configuration = [];

    /**
     * Allows you to configure Essence via a Closure.
     *
     * @param Closure $callback
     * @return void
     */
    public function configure(Closure $callback)
    {
        // @todo
    }
}
