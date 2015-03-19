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

        $arguments = array_slice(array_merge($this->arguments, [null, null]), 0, 3);

        list ($class, $message, $context) = $arguments;

        try
        {
            $callback = $this->value;

            if ( ! is_null($context)) {
                $callback = $callback->bindTo($context);
            }

            $callback();
        }
        catch (\Exception $exception)
        {
            if (get_class($exception) == $class) {
                if ( ! is_null($message) and $exception->getMessage() != $message) {
                    $this->setMessage("expected error message %s is not equal to %s", [
                        $message,
                        $exception->getMessage(),
                    ]);

                    return false;
                }

                $this->setMessage("got %s, just as expected", [$class]);

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
