<?php namespace Essence\Matchers;

class FalseMatcher extends AbstractMatcher
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

        if ($this->value !== false) {
            $this->setMessage("FalseMatcher: false (expected) !== true (actual).");

            return false;
        }

        return true;
    }
}
