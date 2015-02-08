<?php namespace Essence\Matchers;

class BelowMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->configurationOnly or ! is_int($this->value)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ($this->value < ($number = end($this->arguments))) {
            return true;
        }

        $this->setMessage(sprintf(
            "BelowMatcher: %s is not greater than %s.",
            $number,
            $this->value
        ));

        return false;
    }
}
