<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class CaseItem extends ARegex
    {
        protected static $pattern = '/(\s+in|\;(?:\;|&|\;&))\s+\(?(.+?)\)\s*/';
        protected static $replace = '$1' . PHP_EOL . '$2)';
    }
