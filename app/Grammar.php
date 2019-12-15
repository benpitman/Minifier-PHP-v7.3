<?php

    namespace App;

    use App\Entity\Grammar as GrammarEntity;

    final class Grammar
    {
        private const COMMAND = 1;
        private const INPUT_FILE = 2;
        private const LANGUAGE = 3;
        private const PATTERN_START = 4;

        private static $arguments;

        public static function parseInputs (array $arguments)
        {
            $grammarEntity = new GrammarEntity();

            self::$arguments = $arguments;

            $command = self::getValue(self::COMMAND);

            $grammarEntity->setInputFile(self::getValue(self::INPUT_FILE));
            $grammarEntity->setLanguage(self::getValue(self::LANGUAGE));

            $grammarEntity->setPatterns(self::getPatterns());
            var_dump($grammarEntity);
        }

        private static function getValue (int $index): ?string
        {
            return self::$arguments[$index] ?: null;
        }

        private static function getPatterns (): array
        {
            return array_slice(self::$arguments, self::PATTERN_START) ?? [];
        }
    }
