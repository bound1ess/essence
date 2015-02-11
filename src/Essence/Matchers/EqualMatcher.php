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
            "EqualMatcher: %s !== %s.",
            [gettype($this->value), gettype($anotherValue)]
        );

        return false;
    }
}
