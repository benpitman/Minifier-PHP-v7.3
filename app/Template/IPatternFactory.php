<?php

    namespace App\Template;

    interface IPatternFactory
    {
        public static function get (string $className): string;
    }
