<?php

    namespace App\Entity;

    final class PatternCollection
    {
        private $patterns = [];

        public function addPattern (ARegex $pattern): void
        {
            $this->patterns[] = $pattern;
        }

        public function iteratePatterns (): iterable
        {
            foreach ($this->patterns as $pattern)
            {
                yield $pattern;
            }
        }
    }
