<?php namespace Essence\Matchers;

abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * The value we're working with, can be anything.
     *
     * @var mixed
     */
    protected $value;

    /**
     * The matcher arguments, can be an empty array (if there are none).
     *
     * @var array
     */
    protected $arguments;

    /**
     * The type(s) that the passed value should be of (one of them).
     *
     * @var array
     */
    protected $valueType = [];

    /**
     * Whether this matcher should be ran in "configuration" mode.
     *
     * @var boolean
     */
    protected $configurationOnly;

    /**
     * The error message (if there were any).
     *
     * @var string|null
     */
    protected $message;

    /**
     * The modes this matcher can be ran in ("normal", "configuration").
     *
     * @var array
     */
    protected $modes = ["normal"];

    /**
     * {@inheritdoc}
     */
    public function __construct($value, array $arguments = [], $configurationOnly = false)
    {
        $this->value = $value;
        $this->arguments = $arguments;
        $this->configurationOnly = $configurationOnly;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $matcher = get_class($this);

        if ($this->configurationOnly and ! in_array("configuration", $this->modes)) {
            $this->incorrectUsage("You can't run {$matcher} in the configuration mode.");
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ( ! in_array(gettype($this->value), $this->valueType)) {
            $this->incorrectUsage("You are trying to run {$matcher} with invalid data.");
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @see Essence\Matchers\AbstractMatcher::$message
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the error message.
     *
     * @see Essence\Matchers\AbstractMatcher::$message
     * @param string $message
     * @param array $parameters
     * @return void
     */
    protected function setMessage($message, array $parameters = [])
    {
        $this->message = call_user_func_array("sprintf", array_merge([$message], $parameters));
    }

    /**
     * Throws a new instance of IncorrectUsageException (with the given message).
     *
     * @param string $message
     * @throws Essence\Exceptions\IncorrectUsageException
     * @return void
     */
    protected function incorrectUsage($message)
    {
        throw new \Essence\Exceptions\IncorrectUsageException($message);
    }
}
