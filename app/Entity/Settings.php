<?php

    namespace App\Entity;

    use App\Entity\PatternCollection;

    final class Settings
    {
        private $patternCollection;

        public function __construct (?string $language = "Any")
        {
            $this->language = $language;
            $this->pattternCollection = new PatternCollection();
        }

        /**
         * Setters
         */

        public function setArithmetic (bool $arithmetic = true): void
        {
            $this->arithmetic = $arithmetic;
        }

        public function setBraces (bool $braces = true): void
        {
            $this->braces = $braces;
        }

        public function setCases (bool $cases = true): void
        {
            $this->cases = $cases;
        }

        public function setComments (bool $comments = true): void
        {
            $this->comments = $comments;
        }

        public function setFunctions (bool $functions = true): void
        {
            $this->functions = $functions;
        }

        public function setHeredocs (bool $heredocs = true): void
        {
            $this->heredocs = $heredocs;
        }

        public function setOneliners (bool $oneliners = true): void
        {
            $this->oneliners = $oneliners;
        }

        public function setVariables (bool $variables = true): void
        {
            $this->variables = $variables;
        }

        public function setTrim (bool $trim = true): void
        {
            $this->trim = $trim;
        }
    }
