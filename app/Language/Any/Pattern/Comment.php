<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class Comment extends ARegex
    {
        protected static $description = "Removes any lines that begin with '#'";
        protected static $pattern = '/^\s*#(?!\!).+$[\n\r]+/';
    }
