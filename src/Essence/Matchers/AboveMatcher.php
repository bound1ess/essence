<?php namespace Essence\Matchers;

/**
 * A > B.
 */
class AboveMatcher extends AbstractMatcher
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

        if ($this->value > $number) {
            return true;
        }

        $this->setMessage("%s is not greater than %s", [$this->value, $number]);

        return false;
    }
}
