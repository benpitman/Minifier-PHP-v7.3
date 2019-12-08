<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class BraceOpen extends ARegex
    {
        protected static $description = "Removes any whitespace succeeding '{'";
        protected static $pattern = '/\{\s+/';
        protected static $replace = '{' . PHP_EOL;
    }
