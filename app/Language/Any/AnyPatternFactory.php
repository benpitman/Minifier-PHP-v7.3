<?php

    namespace App\Language\Any;

    use App\Entity\Variable;

    use App\Template\IPatternFactory;

    class AnyPatternFactory implements IPatternFactory
    {
        private static $ns = __NAMESPACE__ . "\Pattern\\";

        public static function get (string $className): string
        {
            $class = self::$ns . $className;

            if (!class_exists($class))
            {
                throw new \Error("Pattern '$className' is not available for language '" . Variable::getLanguage() . "'");
            }

            return $class;
        }

        public static function getPatternList (): array
        {
            return [
                "BraceClose",
                "BraceOpen",
                "Comment",
                "CommentInline",
                "FunctionOpen",
                "ParenthesisClose",
                "ParenthesisOpen"
            ];
        }
    }
