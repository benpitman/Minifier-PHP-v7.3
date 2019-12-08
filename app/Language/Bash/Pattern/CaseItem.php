<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class CaseItem extends ARegex
    {
        protected static $description = "Removes any whitespace around case items and deletes the opening parenthesis";
        protected static $pattern = '/(\s+in|\;(?:\;|&|\;&))\s+\(?(.+?)\)\s*/';
        protected static $replace = '$1' . PHP_EOL . '$2)';
    }
