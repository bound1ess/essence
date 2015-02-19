<?php namespace Essence\Matchers;

/**
 * Checks if A has value(s) stored in B.
 */
class ValuesMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["array"];

    /**
     * {@inheritdoc}
     */
    protected $modes = ["configuration", "normal"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if ($this->configurationOnly) {
            return true;
        }

        list($elements) = $this->arguments;

        if ( ! is_array($elements)) {
            $elements = [$elements];
        }

        foreach ($elements as $element) {
            if ( ! in_array($element, $this->value, true)) {
                $this->setMessage(
                    "the given array does not contain %s",
                    [$element]
                );

                return false;
            }
        }

        return true;
    }
}
