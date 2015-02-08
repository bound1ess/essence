<?php namespace Essence\Matchers;

class EqualMatcher extends AbstractMatcher
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

        if ($this->value === ($value = end($this->arguments))) {
            return true;
        }

        $this->setMessage(sprintf(
            "EqualMatcher: the given value of type %s !== the given %s.",
            gettype($this->value),
            gettype($value)
        ));

        return false;
    }
}
