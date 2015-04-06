<?php namespace Essence\Matchers;

/**
 * A >= B.
 */
class LeastMatcher extends AbstractMathMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $number = $this->number;

        if ($this->value >= $number) {
            $this->setMessage("%s is equal to %s, or greater", [$this->value, $number]);

            return true;
        }

        $this->setMessage("%s is not equal to %s, or greater", [$this->value, $number]);

        return false;
    }
}
