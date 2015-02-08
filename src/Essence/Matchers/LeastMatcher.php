<?php namespace Essence\Matchers;

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
            "LeastMatcher: %s is not equal to %s, or greater.",
            [$this->value, $number]
        );

        return false;
    }
}
