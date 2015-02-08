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

        $configuration = essence()->getConfiguration("matcher_settings");

        if (array_key_exists(__CLASS__, $configuration)) {
            $this->value = $configuration[__CLASS__];

            unset($configuration[__CLASS__]);
            essence()->configure(function() use ($configuration) {
                return $configuration;
            });
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
