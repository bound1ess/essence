<?php namespace Essence\Matchers;

/**
 * Checks if A is of type B.
 */
class TypeMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = [
        "string",
        "integer",
        "double",
        "boolean",
        "array",
        "object",
        "NULL",
    ];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($type) = $this->arguments;

        if (in_array($type, $this->valueType)) {
            if (gettype($this->value) == $type) {
                return true;
            }

            $this->setMessage(
                "TypeMatcher: the given %s is not of the type '%s'.",
                [gettype($this->value), $type]
            );

            return false;
        } else {
            if (is_object($this->value) and get_class($this->value) == $type) {
                return true;
            }

            $this->setMessage(
                "TypeMatcher: the given %s is not an instance of '%s'.",
                [gettype($this->value), $type]
            );

            return false;
        }
    }
}
