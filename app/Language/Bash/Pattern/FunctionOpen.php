<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class FunctionOpen extends ARegex
    {
        protected static $description = "Removes any unnecessary whitespace in function declaration";
        protected static $pattern = '/^[\ \t\h]*(\w+)\s*(\(\))\s*{/';
        protected static $replace = '$1$2{';
    }
