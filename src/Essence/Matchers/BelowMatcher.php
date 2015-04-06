<?php namespace Essence\Matchers;

/**
 * A < B.
 */
class BelowMatcher extends AbstractMathMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $number = $this->number;

        if ($this->value < $number) {
            $this->setMessage("%s is greater than %s", [$number, $this->value]);

            return true;
        }

        $this->setMessage("%s is not greater than %s", [$number, $this->value]);

        return false;
    }
}
