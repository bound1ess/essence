<?php namespace Essence\Matchers;

/**
 * Works with arrays (count), strings (strlen) and objects (get_object_vars into count).
 */
class LengthMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["string", "object", "array"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($length) = $this->arguments;
        $actualLength = null;

        if (is_string($this->value)) {
            // @suggestion: multibyte?
            $actualLength = strlen($this->value);
        }

        if (is_array($this->value)) {
            $actualLength = count($this->value);
        }

        if (is_object($this->value)) {
            $actualLength = count(get_object_vars($this->value));
        }

        if ($length !== $actualLength) {
            $this->setMessage(
                "LengthMatcher: %s (expected) !== %s (actual).",
                [$length, $actualLength]
            );

            return false;
        }

        return true;
    }
}
