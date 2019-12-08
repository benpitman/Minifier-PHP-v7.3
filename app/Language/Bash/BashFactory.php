<?php

    namespace App\Language\Bash;

    use App\Language\Any\AnyLanguageFactory;

    use App\Template\ILanguageFactory;

    final class BashFactory extends AnyLanguageFactory implements ILanguageFactory
    {
        private static $ns = __NAMESPACE__ . "\Pattern\\";

        public static function get (string $className): string
        {
            $class = self::$ns . $className;

            if (!class_exists($class))
            {
                return parent::get($className);
            }

            return $class;
        }

        public static function getPatternList (): array
        {
            return sort(
                array_unique(
                    array_merge(
                        parent::getPatternList(),
                        [
                            "CaseItem",
                            "CaseOpen",
                            "Heredoc",
                            "MultilineArgument",
                            "Oneliner",
                            "ParenthesisClose",
                            "ParenthesisOpen"
                        ]
                    )
                )
            );
        }
    }
