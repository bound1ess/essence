<?php namespace Essence;

/**
 * Provides string representations for any of PHP data types.
 */
class VarDumper
{

    /**
     * Dumps a value.
     *
     * @param mixed $value
     * @return string
     */
    public function dump($value)
    {
        $value = str_replace(PHP_EOL, "\\n", $value);

        // @suggestion multibyte support?
        if (strlen($value) > 30) {
            $value = substr($value, 0, 30)."...";
        }

        return $value;
    }
}
