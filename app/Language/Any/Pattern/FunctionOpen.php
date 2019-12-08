<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class FunctionOpen extends ARegex
    {
        protected static $pattern = '/^[\ \t\h]*(\w+)\s*(\(\))\s*{/';
        protected static $replace = '$1$2{';
    }
