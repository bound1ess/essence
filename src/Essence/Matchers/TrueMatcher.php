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
            $this->setMessage("true (expected) !== false (actual)");

            return false;
        }

        return true;
    }
}
