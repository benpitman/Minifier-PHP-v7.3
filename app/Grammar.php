<?php

    namespace App;

    use App\Entity\Settings;

    final class Grammar
    {
        private const ATTRIBUTES = 1;
        private const INPUT_FILE = 2;
        private const LANGUAGE = 3;
        private const PATTERN_START = 4;

        private const MASK_MINIFY = 1;
        private const MASK_IN_PLACE = 2;
        private const MASK_ALL_PATTERNS = 4;

        private static $arguments;

        public static function parseInputs (array $arguments)
        {
            $settings = new Settings();

            self::$arguments = $arguments;

            $settings->setMinify(self::getMinify());

            $settings->setInputFile(self::getValue(self::INPUT_FILE));
            $settings->setLanguage(self::getValue(self::LANGUAGE));

            $settings->setPatterns(self::getPatterns());
        }

        private static function getValue (int $index): ?string
        {
            return self::$arguments[$index] ?: null;
        }

        private static function getPatterns (): array
        {
            return array_slice(self::$arguments, self::PATTERN_START) ?? [];
        }

        private static function getMinify (): bool
        {
            return !!(self::getAttributes() & self::MASK_MINIFY);
        }

        private static function getInPlace (): bool
        {
            return !!(self::getAttributes() & self::MASK_IN_PLACE);
        }

        private static function getAllPatterns (): bool
        {
            return !!(self::getAttributes() & self::MASK_ALL_PATTERNS);
        }

        private static function getAttributes (): ACommand
        {
            return (
                self::getValue(self::ATTRIBUTES)
            );
        }
    }
