<?php

    namespace App\Template;

    use App\Entity\Variable;

    use App\Pattern\{
        BraceClose,
        BraceOpen,
        FunctionOpen,
        ParenthesisClose,
        ParenthesisOpen
    };

    abstract class ALanguageFactory
    {
        public static function get (string $className)
        {
            $method = "get{$className}";

            if (!method_exists(static::class, $method) || !is_callable([static::class, $method]))
            {
                throw new \Error("Pattern '$className' is not available for " . Variable::getLanguage());
            }

            return static::$method();
        }

        public static function getPatternList (): array
        {
            return [
                "BraceClose",
                "BraceOpen",
                "FunctionOpen",
                "ParenthesisClose",
                "ParenthesisOpen"
            ];
        }

        private static function getBraceClose (): string
        {
            return BraceClose::class;
        }

        private static function getBraceOpen (): string
        {
            return BraceOpen::class;
        }

        private static function getFunctionOpen (): string
        {
            return FunctionOpen::class;
        }

        private static function getParenthesisClose (): string
        {
            return ParenthesisClose::class;
        }

        private static function getParenthesisOpen (): string
        {
            return ParenthesisOpen::class;
        }
    }
