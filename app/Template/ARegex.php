<?php

    namespace App\Template;

    abstract class ARegex
    {
        protected static $pattern;
        protected static $replace = "";

        public static function getPattern (): string
        {
            return static::$pattern;
        }

        public static function getReplace (): string
        {
            return static::$replace;
        }
    }
