<?php

    namespace App\Language\Bash;

    use App\Template\ALanguageFactory;

    use App\Language\Bash\Pattern\{
        ParenthesisClose,
        ParenthesisOpen
    };

    final class BashFactory extends ALanguageFactory
    {
        public static function getPatternList (): array
        {
            return sort(
                array_unique(
                    array_merge(
                        parent::getPatternList(),
                        [

                        ]
                    )
                )
            );
        }

        protected static function getParenthesisClose (): ARegex
        {
            return new ParenthesisClose();
        }

        protected static function getParenthesisOpen (): ARegex
        {
            return new ParenthesisOpen();
        }
    }
