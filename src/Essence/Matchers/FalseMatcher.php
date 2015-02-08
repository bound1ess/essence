<?php namespace Essence\Matchers;

class FalseMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = [
        "string",
        "integer",
        "double",
        "array",
        "object",
        "NULL",
        "boolean",
    ];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if ($this->value !== false) {
            $this->setMessage("FalseMatcher: false (expected) !== true (actual).");

            return false;
        }

        return true;
    }
}
