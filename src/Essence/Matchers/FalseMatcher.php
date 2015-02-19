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
            $this->setMessage("false (expected) !== true (actual)");

            return false;
        }

        return true;
    }
}
