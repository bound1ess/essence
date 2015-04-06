<?php namespace Essence\Matchers;

abstract class AbstractMathMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["integer"];

    /**
     * @var integer|null
     */
    protected $number = null;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        if (count($this->arguments) > 0) {
            $this->number = end($this->arguments);
        }

        if ($config = essence()->getMatcherConfiguration("Essence\Matchers\LengthMatcher")) {
            $this->number = end($config);
        }
    }
}
