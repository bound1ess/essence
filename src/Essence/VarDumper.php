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
        switch (gettype($value)) {

            case "string":
                $value = str_replace(PHP_EOL, "\\n", $value);

                // @suggestion multibyte support?
                if (strlen($value) > 30) {
                    $value = substr($value, 0, 30)."...";
                }

                return $value;

            case "integer": return (string)$value;

            case "double": return (string)$value;
        }
    }
}
