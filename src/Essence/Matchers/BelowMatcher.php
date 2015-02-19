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
            $this->setMessage("%s is greater than %s", [$number, $this->value]);

            return true;
        }

        $this->setMessage("%s is not greater than %s", [$number, $this->value]);

        return false;
    }
}
