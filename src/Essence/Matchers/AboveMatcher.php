<?php namespace Essence\Matchers;

/**
 * A > B.
 */
class AboveMatcher extends AbstractMathMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $number = $this->number;

        if ($this->value > $number) {
            $this->setMessage("%s is greater than %s", [$this->value, $number]);

            return true;
        }

        $this->setMessage("%s is not greater than %s", [$this->value, $number]);

        return false;
    }
}
