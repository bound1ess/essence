<?php namespace Essence\Matchers;

/**
 * B <= A <= C.
 */
class WithinMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["integer"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($least, $most) = $this->arguments;

        if (($least <= $this->value) and ($this->value <= $most)) {
            return true;
        }

        $this->setMessage(
            "%s is not within %s and %s",
            [$this->value, $least, $most]
        );

        return false;
    }
}
