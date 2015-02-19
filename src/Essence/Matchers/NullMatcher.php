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
            $this->setMessage("%s is not NULL", [$this->value]);

            return false;
        }

        $this->setMessage("the given value is NULL");

        return true;
    }
}
