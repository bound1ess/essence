<?php namespace Essence\Matchers;

/**
 * Non-strict (loose) values comparison.
 */
class LikeMatcher extends AbstractMatcher {

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

        list ($anotherValue) = $this->arguments;

        if ($anotherValue == $this->value) {
            $this->setMessage("%s is equal to %s", [$this->value, $anotherValue]);

            return true;
        }

        $this->setMessage("%s is not equal to %s", [$this->value, $anotherValue]);

        return false;
    }
}
