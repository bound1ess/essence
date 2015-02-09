<?php namespace Essence\Matchers;

/**
 * Based on is_null() built-in function.
 */
class NullMatcher extends AbstractMatcher
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

        if ( ! is_null($this->value)) {
            $this->setMessage(
                "NullMatcher: type NULL (expected) !== %s (actual).",
                [gettype($this->value)]
            );

            return false;
        }

        return true;
    }
}
