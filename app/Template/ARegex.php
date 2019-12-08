<?php

    namespace App\Template;

    abstract class ARegex
    {
        protected static $description = "";
        protected static $pattern;
        protected static $replace = "";

        public static function getDescription (): string
        {
            return static::$description;
        }

        public static function getPattern (): string
        {
            return static::$pattern;
        }

        public static function getReplace (): string
        {
            return static::$replace;
        }
    }
