<?php namespace Essence\Matchers;

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
            $this->setMessage("TrueMatcher: true (expected) !== false (actual).");

            return false;
        }

        return true;
    }
}
