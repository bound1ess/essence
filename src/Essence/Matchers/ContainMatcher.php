<?php namespace Essence\Matchers;

class ContainMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["string", "array"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if ( ! is_null($configuration = essence()->getMatcherConfiguration(__CLASS__))) {
            $this->value = $configuration;
        }

        list($element) = $this->arguments;
        $result = true;

        if (is_string($this->value)) {
            $result = strpos($this->value, $element) !== false;
        }

        if (is_array($this->value)) {
            $result = in_array($element, $this->value, true);
        }

        if ( ! $result) {
            $this->setMessage(
                "ContainMatcher: the given %s does not contain the given %s value.",
                [gettype($this->value), gettype($element)]
            );

            return false;
        }

        return true;
    }
}
