<?php namespace Essence\Matchers;

/**
 * Depending on the output of empty() built-in.
 */
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
                "%s is not empty",
                [$this->value]
            );

            return false;
        }

        return true;
    }
}
