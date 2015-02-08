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
     * @var array
     */
    protected $arguments;

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
        if ($this->configurationOnly and ! in_array("configuration", $this->modes)) {
            $this->incorrectUsage();
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
     * @return void
     */
    protected function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Throws a new instance of IncorrectUsageException (with the given message).
     *
     * @param string|null $message
     * @throws Essence\Exceptions\IncorrectUsageException
     * @return void
     */
    protected function incorrectUsage($message = null)
    {
        throw new \Essence\Exceptions\IncorrectUsageException($message);
    }
}
