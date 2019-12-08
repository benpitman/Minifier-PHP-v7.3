<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class CaseOpen extends ARegex
    {
        protected static $description = "Removes any unnecessary whitespace around a case declaration";
        protected static $pattern = '/[\ \t]*case[\ \t]+(.+)\s+in\s+/';
        protected static $replace = 'case $1 in' . PHP_EOL;
    }
