<?php namespace Essence\Matchers;

class ContainMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $element = end($this->arguments);
        $ofCorrectType = (is_array($this->value) or is_string($this->value));

        if ($this->configurationOnly or ! $ofCorrectType) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        $result = true;

        if (is_string($this->value)) {
            $result = strpos($this->value, $element) !== false;
        }

        if (is_array($this->value)) {
            $result = in_array($element, $this->value, true);
        }

        if ( ! $result) {
            $this->setMessage(sprintf(
                "ContainMatcher: the given %s does not contain the given %s value.",
                gettype($this->value),
                gettype($element)
            ));

            return false;
        }

        return true;
    }
}
