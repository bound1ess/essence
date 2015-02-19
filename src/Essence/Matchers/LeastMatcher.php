<?php namespace Essence\Matchers;

/**
 * A >= B.
 */
class LeastMatcher extends AbstractMatcher
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

        list($number) = $this->arguments;

        if ($this->value >= $number) {
            return true;
        }

        $this->setMessage(
            "%s is not equal to %s, or greater",
            [$this->value, $number]
        );

        return false;
    }
}
