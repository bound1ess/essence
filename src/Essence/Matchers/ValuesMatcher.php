<?php namespace Essence\Matchers;

class ValuesMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ( ! is_array($this->value)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ($this->configurationOnly) {
            return true;
        }

        $elements = end($this->arguments);

        if ( ! is_array($elements)) {
            $elements = [$elements];
        }

        foreach ($elements as $element) {
            if ( ! in_array($element, $this->value, true)) {
                $this->setMessage(sprintf(
                    "ValuesMatcher: the given array does not contain the given %s.",
                    gettype($element)
                ));

                return false;
            }
        }

        return true;
    }
}
