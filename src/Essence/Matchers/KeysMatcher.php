<?php namespace Essence\Matchers;

/**
 * Works both in normal AND configuration modes.
 */
class KeysMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["array", "object"];

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

        if (is_array($this->value)) {
            $keys = array_keys($this->value);
        } else {
            $keys = array_keys(get_object_vars($this->value));
        }

        if ($this->configurationOnly) {
            essence()->setMatcherConfiguration("Essence\Matchers\ContainMatcher", $keys);

            return true;
        }

        list($elements) = $this->arguments;

        if ( ! is_array($elements)) {
            $elements = [$elements];
        }

        foreach ($elements as $key) {
            if ( ! in_array($key, $keys, true)) {
                $this->setMessage("key %s does not exist in %s", [$key, $this->value]);

                return false;
            }
        }

        $this->setMessage("key %s exists in %s", [$key, $this->value]);

        return true;
    }
}
