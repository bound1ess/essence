<?php namespace Essence\Matchers;

abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var boolean
     */
    protected $configurationOnly;

    /**
     * {@inheritdoc}
     */
    public function __construct($value, $configurationOnly)
    {
        $this->value = $value;
        $this->configurationOnly = $configurationOnly;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function run();

    /**
     * {@inheritdoc}
     */
    abstract public function getMessage();
}
