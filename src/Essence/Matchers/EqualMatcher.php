<?php namespace Essence\Matchers;

/**
 * A === B (strict check).
 */
class EqualMatcher extends AbstractMatcher
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

        list($anotherValue) = $this->arguments;

        if ($this->value === $anotherValue) {
            return true;
        }

        $this->setMessage(
            "EqualMatcher: the given value of type %s !== the given %s.",
            [gettype($this->value), gettype($anotherValue)]
        );

        return false;
    }
}
