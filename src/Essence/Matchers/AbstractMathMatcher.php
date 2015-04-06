<?php namespace Essence\Matchers;

abstract class AbstractMathMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["integer", "array"];

    /**
     * @var integer
     */
    protected $number;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if (count($this->arguments) > 0) {
            $this->number = (int) end($this->arguments);
        } else {
            $this->incorrectUsage("Desired condition was not specified.");
        }

        if ($config = essence()->getMatcherConfiguration("Essence\Matchers\LengthMatcher")) {
            $this->value = $config["length"];
        }
    }
}
