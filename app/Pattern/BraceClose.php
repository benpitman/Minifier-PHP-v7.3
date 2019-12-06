<?php

    namespace App\Pattern;

    use App\Template\ARegex;

    final class BraceClose extends ARegex
    {
        protected static $pattern = '/\s+\}/';
        protected static $replace = PHP_EOL . '}';
    }
