<?php

    namespace App\Language;

    use App\Entity\Variable;

    final class LanguageFactory
    {
        public static function getPatternFactory (): string
        {
            $titleClass = ucfirst(Variabe::getLanguage());
            $class = __NAMESPACE__ . "\\{$titleClass}\\{$titleClass}PatternFactory";

            if (!class_exists($class)) {
                throw new \Error(Variable::getLanguage() . " is not yet supported");
            }

            return $class;
        }
    }
