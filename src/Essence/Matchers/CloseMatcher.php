<?php namespace Essence\Matchers;

/**
 * Approximate equality.
 */
class CloseMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["double"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($number, $delta) = $this->arguments;

        if (abs($this->value - $number) > $delta) {
            $this->setMessage(
                "%s is not approximately equal to %s", [$this->value, $number]
            );

            return false;
        }

        return true;
    }
}
