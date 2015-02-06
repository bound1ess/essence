<?php namespace Essence\Matchers;

class LengthMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->configurationOnly) {
            throw new \Essence\Exceptions\UnintendedUsageException;
        }
    }
}
