<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class ParenthesisOpen extends ARegex
    {
        protected static $pattern = '/(\$)?\(\(\s+/';
        protected static $replace = '$1(('
    }
