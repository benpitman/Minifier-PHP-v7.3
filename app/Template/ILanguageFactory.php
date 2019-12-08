<?php

    namespace App\Template;

    interface ILanguageFactory
    {
        public static function get (string $className): string;

        public static function getPatternList (): array;
    }
