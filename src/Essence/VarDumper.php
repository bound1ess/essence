<?php namespace Essence;

/**
 * Connects Dumpy (@php-packages/dumpy) to Essence.
 * @codeCoverageIgnore
 */
class VarDumper extends \PhpPackages\Dumpy\Dumpy
{

    /**
     * @return VarDumper
     */
    public function __construct()
    {
        $this->configure("str_max_length", 100);
        $this->configure("bool_lowercase", false);
        $this->configure("null_lowercase", false);
        $this->configure("round_double", false);
        $this->configure("replace_newline", true);
        $this->configure("array_max_elements", 42);
        // Only 2 spaces for better readability on tight screens.
        $this->configure("array_indenting", "  ");
        $this->configure("object_limited_info", false);
    }
}
