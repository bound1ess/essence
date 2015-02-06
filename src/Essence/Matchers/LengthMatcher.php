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
        }

        $length = end($this->arguments);

        if (is_string($this->value)) {
            // @suggestion: multibyte?
            return strlen($this->value) === $length;
        }

        if (is_array($this->value)) {
            return count($this->value) === $length;
        }

        if (is_object($this->value)) {
            return count(get_object_vars($this->value)) === $length;
        }

        $this->throwUnintendedUsageException();
    }
}
