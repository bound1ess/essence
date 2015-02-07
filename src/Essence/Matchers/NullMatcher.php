<?php namespace Essence\Matchers;

class NullMatcher extends AbstractMatcher
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

        if ( ! is_null($this->value)) {
            $this->setMessage(sprintf(
                "NullMatcher: type NULL (expected) !== %s (actual)",
                gettype($this->value)
            ));

            return false;
        }

        return true;
    }
}
