<?php namespace Essence\Matchers;

/**
 * A === TRUE (strict).
 */
class TrueMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["boolean"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if ($this->value !== true) {
            $this->setMessage("true (expected) is not equal to false (actual)");

            return false;
        }

        $this->setMessage("the given value is equal to true");

        return true;
    }
}
