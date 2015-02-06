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
     * @var string|null
     */
    protected $message;

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
     * @param string $message
     * @return void
     */
    protected function setMessage($message)
    {
        $this->message = $message;
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
