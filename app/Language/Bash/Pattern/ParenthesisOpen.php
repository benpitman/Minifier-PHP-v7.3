<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    /**
     * Single parentheses in Bash are primarily used for subshells.
     * Minifying subshells is a bit above what I'm willing to do,
     * so I've overridden these to accommodate arithmetic syntax.
     */
    final class ParenthesisOpen extends ARegex
    {
        protected static $pattern = '/(\$)?\(\(\s+/';
        protected static $replace = '$1(('
    }
