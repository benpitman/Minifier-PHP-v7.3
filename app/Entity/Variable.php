<?php

    namespace App\Entity;

    final class Variable
    {
        private static $language;

        public static function getLanguage (): string
        {
            return self::$language;
        }

        public static function setLanguage (string $language): void
        {
            self::$language = strtolower($language);
        }
    }
