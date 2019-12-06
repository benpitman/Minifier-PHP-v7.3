<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class ParenthesisClose extends ARegex
    {
        protected static $pattern = '/\s+\)\)/';
        protected static $replace = '))';
    }
