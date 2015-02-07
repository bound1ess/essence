<?php namespace Essence\Matchers;

class RespondMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $object = $this->value;
        $method = end($this->arguments);

        if ($this->configurationOnly or ! is_object($object) or ! is_string($method)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ( ! method_exists($object, $method)) {
            $this->setMessage(sprintf(
                "RespondMatcher: the given object does not have a method called '%s'.",
                $method
            ));

            return false;
        }

        return true;
    }
}
