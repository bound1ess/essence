<?php namespace Essence\Matchers;

/**
 * !! A
 */
class PositiveMatcher extends AbstractMatcher
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

        if ( !! $this->value) {
            return true;
        }

        $this->setMessage(
            "PositiveMatcher: the given %s is not positive.",
            [gettype($this->value)]
        );

        return false;
    }
}
