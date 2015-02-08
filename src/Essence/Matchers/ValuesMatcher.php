<?php namespace Essence\Matchers;

class ValuesMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["array"];

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
                    "ValuesMatcher: the given array does not contain the given %s.",
                    [gettype($element)]
                );

                return false;
            }
        }

        return true;
    }
}
