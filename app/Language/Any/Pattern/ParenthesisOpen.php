<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class ParenthesisOpen extends ARegex
    {
        protected static $description = "Removes any whitespace succeding '('";
        protected static $pattern = '/\(\s+/';
        protected static $replace = '('
    }
