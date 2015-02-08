<?php namespace Essence\Matchers;

class MostMatcher extends AbstractMatcher
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

        if ($this->value <= ($number = end($this->arguments))) {
            return true;
        }

        $this->setMessage(sprintf(
            "MostMatcher: %s is not equal to %s, or less.",
            $this->value,
            $number
        ));

        return false;
    }
}
