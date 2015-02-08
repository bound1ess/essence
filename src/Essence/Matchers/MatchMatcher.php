<?php namespace Essence\Matchers;

class MatchMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $subject = $this->value;
        $pattern = end($this->arguments);

        if ($this->configurationOnly or ! is_string($subject)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ( ! preg_match($pattern, $subject)) {
            $this->setMessage(sprintf(
                "MatchMatcher: '%s' does not match '%s'.",
                $subject,
                $pattern
            ));

            return false;
        }

        return true;
    }
}
