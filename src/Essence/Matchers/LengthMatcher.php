<?php namespace Essence\Matchers;

class LengthMatcher extends AbstractMatcher
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

        $length = end($this->arguments);
        $actualLength = null;

        if (is_string($this->value)) {
            // @suggestion: multibyte?
            $actualLength = strlen($this->value);
        }

        if (is_array($this->value)) {
            $actualLength = count($this->value);
        }

        if (is_object($this->value)) {
            $actualLength = count(get_object_vars($this->value));
        }

        if (is_null($actualLength)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ($length !== $actualLength) {
            $this->setMessage(sprintf(
                "LengthMatcher: %s (expected) !== %s (actual)", $length, $actualLength
            ));

            return false;
        }

        return true;
    }
}
