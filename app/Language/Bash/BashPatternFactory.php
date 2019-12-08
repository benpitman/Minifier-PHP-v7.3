<?php

    namespace App\Language\Bash;

    use App\Language\Any\AnyPatternFactory;

    use App\Template\IPatternFactory;

    final class BashPatternFactory extends AnyPatternFactory implements IPatternFactory
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
    }
