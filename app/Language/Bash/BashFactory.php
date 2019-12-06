<?php

    namespace App\Language\Bash;

    use App\Template\ALanguageFactory;

    use App\Language\Bash\Pattern\{
        CaseItem,
        CaseOpen,
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
                            "CaseItem",
                            "CaseOpen",
                            "ParenthesisClose",
                            "ParenthesisOpen"
                        ]
                    )
                )
            );
        }

        protected static function getCaseItem (): string
        {
            return CaseItem::class;
        }

        protected static function getCaseOpen (): string
        {
            return CaseOpen::class;
        }

        /**
         * Single parentheses in Bash are primarily used for subshells.
         * Minifying subshells is a bit above what I'm willing to do,
         * so I've overridden these to accommodate arithmetic syntax.
         */

        protected static function getParenthesisClose (): string
        {
            return ParenthesisClose::class;
        }

        protected static function getParenthesisOpen (): string
        {
            return ParenthesisOpen::class;
        }
    }
