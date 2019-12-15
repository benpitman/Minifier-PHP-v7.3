<?php

    namespace App\Entity;

    final class Grammar
    {
        private $getPatternList = false;
        private $inputFile;
        private $language;
        private $patterns = [];

        /**
         * Getters
         */

        public function getInputFile (): string
        {
            return $this->inputFile;
        }

        public function getLanguage (): string
        {
            return $this->language;
        }

        public function getPatterns (): array
        {
            return $this->patterns;
        }

        /**
         * Setters
         */

        public function setInputFile (string $filepath): void
        {
            $this->inputFile = $filepath;
        }

        public function setLanguage (?string $language): void
        {
            $this->language = $language;
        }

        public function setPatterns (array $patterns): void
        {
            $this->patterns = $patterns;
        }
    }
