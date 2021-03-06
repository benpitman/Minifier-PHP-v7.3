<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class MultilineArgument extends ARegex
    {
        protected static $description = "Removes escaped newlines used for long commands";
        protected static $pattern = '/\s*?(\s)\\$[\n\r]*/';
        protected static $replace = '$1';
    }
