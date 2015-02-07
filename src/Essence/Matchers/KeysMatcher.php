<?php namespace Essence\Matchers;

class KeysMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if (is_array($this->value)) {
            $keys = array_keys($this->value);
        } elseif (is_object($this->value)) {
            $keys = array_keys(get_object_vars($this->value));
        } else {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

        if ($this->configurationOnly) {
            essence()->configure(function($configuration) use ($keys) {
                $configuration["matcher_settings"]["Essence\Matchers\ContainMatcher"] = $keys;

                return $configuration;
            });

            return true;
        }

        $searchFor = end($this->arguments);

        if ( ! is_array($searchFor)) {
            $searchFor = [$searchFor];
        }

        foreach ($searchFor as $key) {
            if ( ! in_array($key, $keys, true)) {
                $this->setMessage(sprintf(
                    "KeysMatcher: the key '%s' does not exist in the given %s.",
                    $key,
                    gettype($this->value)
                ));

                return false;
            }
        }

        return true;
    }
}
