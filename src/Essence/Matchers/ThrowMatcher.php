<?php namespace Essence\Matchers;

use Closure;

class ThrowMatcher extends AbstractMatcher
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $class = end($this->arguments);

        if ($this->configurationOnly or ! ($this->value instanceof Closure)) {
            $this->throwUnintendedUsageException();
            // @codeCoverageIgnoreStart
        }
        // @codeCoverageIgnoreEnd

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
                $this->setMessage(sprintf(
                    "ThrowMatcher: %s was expected, but got %s.",
                    $class,
                    get_class($exception)
                ));

                return false;
            }
        }

        $this->setMessage("ThrowMatcher: nothing was thrown.");

        return false;
    }
}
