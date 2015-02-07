<?php namespace Essence\Matchers;

class EmptyMatcher extends AbstractMatcher
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

        if ( ! empty ($this->value)) {
            $this->setMessage(sprintf(
                "EmptyMatcher: the given %s is not empty.",
                gettype($this->value)
            ));

            return false;
        }

        return true;
    }
}
