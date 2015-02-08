<?php namespace Essence\Matchers;

class TypeMatcher extends AbstractMatcher
{

    /**
     * @var array
     */
    protected $types = [
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
        $type = end($this->arguments);

        if ($this->configurationOnly or ! is_string($type)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if (in_array($type, $this->types)) {
            if (gettype($this->value) == $type) {
                return true;
            }

            $this->setMessage(sprintf(
                "TypeMatcher: the given %s is not of the type '%s'.",
                gettype($this->value),
                $type
            ));

            return false;
        } else {
            if (is_object($this->value) and get_class($this->value) == $type) {
                return true;
            }

            $this->setMessage(sprintf(
                "TypeMatcher: the given %s is not an instance of '%s'.",
                gettype($this->value),
                $type
            ));

            return false;
        }
    }
}