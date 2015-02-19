<?php namespace Essence\Matchers;

/**
 * A === FALSE (strict).
 */
class FalseMatcher extends AbstractMatcher
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

        if ($this->value !== false) {
            $this->setMessage("false (expected) is not equal to true (actual)");

            return false;
        }

        $this->setMessage("the given value is equal to false");

        return true;
    }
}
