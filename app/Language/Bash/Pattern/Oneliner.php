<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class Oneliner extends ARegex
    {
        protected static $description = "Removes any whitespace succeeding ';'";
        protected static $pattern = '/(?<!\;)\;\s+/';
        protected static $replace = ';';
    }
