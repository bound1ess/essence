<?php namespace Essence\Matchers;

/**
 * Checks if A has a method called B.
 */
class RespondMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["object", "string"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($method) = $this->arguments;

        if ( ! method_exists($this->value, $method)) {
            $this->setMessage(
                "RespondMatcher: the given object does not have a method called '%s'.",
                [$method]
            );

            return false;
        }

        return true;
    }
}
