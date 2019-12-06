<?php

    namespace App\Language;

    use App\Language\Bash\BashFactory;

    use App\Entity\Variable;

    final class PatternFactory
    {
        //TODO return this to a getter so the language pattern factory can be saved
        public static function __callStatic (string $method, array $args)
        {
            $getter = Variable::getlanguage() . "Factory";

            if (!method_exists(self::class, $getter)) {
                throw new \Error(Variable::getLanguage() . " is not yet supported");
            }

            return self::$getter()::get($method);
        }

        private static function bashFactory (): string
        {
            return BashFactory::class;
        }
    }
