<?php namespace Essence\Matchers;

class AboveMatcher extends AbstractMatcher
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

        if ($this->value > ($number = end($this->arguments))) {
            return true;
        }

        $this->setMessage(sprintf(
            "AboveMatcher: %s is not greater than %s.",
            $this->value,
            $number
        ));

        return false;
    }
}
