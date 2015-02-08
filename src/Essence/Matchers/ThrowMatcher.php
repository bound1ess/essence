<?php namespace Essence\Matchers;

class ThrowMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    protected $valueType = ["object"];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        list($class) = $this->arguments;

        try
        {
            $callback = $this->value;
            $callback();
        }
        catch (\Exception $exception)
        {
            if (get_class($exception) == $class) {
                return true;
            } else {
                $this->setMessage(
                    "ThrowMatcher: %s was expected, but got %s.",
                    [$class, get_class($exception)]
                );

                return false;
            }
        }

        $this->setMessage("ThrowMatcher: nothing was thrown.");

        return false;
    }
}
