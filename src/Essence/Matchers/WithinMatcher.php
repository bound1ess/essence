<?php namespace Essence\Matchers;

class WithinMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->configurationOnly or ! is_numeric($this->value)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        list($least, $most) = $this->arguments;

        if (($least <= $this->value) and ($this->value <= $most)) {
            return true;
        }

        $this->setMessage(sprintf(
            "WithinMatcher: (%s <= %s <= %s) === FALSE.",
            $least,
            $this->value,
            $most
        ));

        return false;
    }
}
