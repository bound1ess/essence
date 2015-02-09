<?php namespace Essence\Matchers;

/**
 * !! preg_match(B, A).
 */
class MatchMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["string"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($pattern) = $this->arguments;

        if ( ! preg_match($pattern, $this->value)) {
            $this->setMessage(
                "MatchMatcher: '%s' does not match '%s'.",
                [$this->value, $pattern]
            );

            return false;
        }

        return true;
    }
}
