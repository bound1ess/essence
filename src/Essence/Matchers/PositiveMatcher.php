<?php namespace Essence\Matchers;

class PositiveMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->configurationOnly) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ( !! $this->value) {
            return true;
        }

        $this->setMessage(sprintf(
            "PositiveMatcher: the given %s is not positive.",
            gettype($this->value)
        ));

        return false;
    }
}
