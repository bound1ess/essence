<?php namespace Essence\Matchers;

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

        $this->setMessage("AboveMatcher: %s is not greater than %s.", [$this->value, $number]);

        return false;
    }
}
