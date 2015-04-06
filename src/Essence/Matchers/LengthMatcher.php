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
    protected $modes = ["normal", "configuration"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $actualLength = null;

        if (is_string($this->value)) {
            // @suggestion multibyte?
            $actualLength = strlen($this->value);
        }

        if (is_array($this->value)) {
            $actualLength = count($this->value);
        }

        if (is_object($this->value)) {
            $actualLength = count(get_object_vars($this->value));
        }

        // The configuration mode.
        if ($this->configurationOnly) {
            essence()->setMatcherConfiguration(__CLASS__, ["length" => $actualLength]);

            return true;
        }

        list($length) = $this->arguments;

        if ($length !== $actualLength) {
            $this->setMessage(
                "%s (expected length) is not equal to %s (actual length)",
                [$length, $actualLength]
            );

            return false;
        }

        $this->setMessage("%s and %s have identical length", [$length, $actualLength]);

        return true;
    }
}
