<?php namespace Essence\Matchers;

class WithinMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["integer"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($least, $most) = $this->arguments;

        if (($least <= $this->value) and ($this->value <= $most)) {
            return true;
        }

        $this->setMessage(
            "WithinMatcher: (%s <= %s <= %s) === FALSE.",
            [$least, $this->value, $most]
        );

        return false;
    }
}
