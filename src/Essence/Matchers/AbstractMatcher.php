<?php namespace Essence\Matchers;

abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var boolean
     */
    protected $configurationOnly;

    /**
     * @var string
     */
    protected $message = "";

    /**
     * {@inheritdoc}
     */
    public function __construct($value, array $arguments, $configurationOnly)
    {
        $this->value = $value;
        $this->arguments = $arguments;
        $this->configurationOnly = $configurationOnly;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function run();

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @throws \Essence\Exceptions\UnintendedUsageException
     * @return void
     */
    protected function throwUnintendedUsageException()
    {
        throw new \Essence\Exceptions\UnintendedUsageException;
    }
}
