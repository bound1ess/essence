<?php namespace Essence\Matchers;

/**
 * Checks if A (a callable) throws an exception of class B.
 */
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
                    "%s was expected, but got %s",
                    [$class, get_class($exception)]
                );

                return false;
            }
        }

        $this->setMessage("nothing was thrown");

        return false;
    }
}
