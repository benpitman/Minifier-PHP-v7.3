<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class MultilineArgument extends ARegex
    {
        protected static $pattern = '/\s*?(\s)\\$[\n\r]*/';
        protected static $replace = '$1';
    }
