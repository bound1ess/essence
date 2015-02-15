<?php namespace Essence\Matchers;

/**
 * Whether a string/array contains an element.
 */
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
                "ContainMatcher: %s does not contain %s.",
                [$this->value, $element]
            );

            return false;
        }

        return true;
    }
}
