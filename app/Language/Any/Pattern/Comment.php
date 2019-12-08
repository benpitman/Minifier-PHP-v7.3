<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class Comment extends ARegex
    {
        protected static $pattern = '/^\s*#(?!\!).+$[\n\r]+/';
    }
