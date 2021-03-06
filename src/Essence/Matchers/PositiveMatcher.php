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
            $this->setMessage("%s is positive", [$this->value]);

            return true;
        }

        $this->setMessage("%s is not positive", [$this->value]);

        return false;
    }
}
