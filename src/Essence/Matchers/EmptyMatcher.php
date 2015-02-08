<?php namespace Essence\Matchers;

class EmptyMatcher extends AbstractMatcher
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

        if ( ! empty ($this->value)) {
            $this->setMessage(
                "EmptyMatcher: the given %s is not empty.",
                [gettype($this->value)]
            );

            return false;
        }

        return true;
    }
}
