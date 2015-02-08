<?php namespace Essence\Matchers;

class CloseMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $number = $this->value;

        if ($this->configurationOnly or ! is_float($number)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        list($value, $delta) = $this->arguments;

        if (abs($number - $value) > $delta) {
            $this->setMessage(sprintf(
                "CloseMatcher: %s is not approximately equal to %s.",
                $number,
                $value
            ));

            return false;
        }

        return true;
    }
}
