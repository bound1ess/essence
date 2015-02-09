<?php namespace Essence\Matchers;

/**
 * A < B.
 */
class BelowMatcher extends AbstractMatcher
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

        if ($this->value < $number) {
            return true;
        }

        $this->setMessage("BelowMatcher: %s is not greater than %s.", [$number, $this->value]);

        return false;
    }
}
