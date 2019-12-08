<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class Oneliner extends ARegex
    {
        protected static $pattern = '/(?<!\;)\;\s+/';
        protected static $replace = PHP_EOL;
    }
