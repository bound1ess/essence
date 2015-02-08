<?php namespace Essence\Matchers;

class TrueMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->configurationOnly or ! is_bool($this->value)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ($this->value !== true) {
            $this->setMessage("TrueMatcher: true (expected) !== false (actual).");

            return false;
        }

        return true;
    }
}
