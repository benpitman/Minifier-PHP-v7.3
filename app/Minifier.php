<?php

    namespace App;

    use App\Entity\Variable;

    use App\Language\PatternFactory;

    final class Minifier
    {
        private $fileContent;
        private $patternFactory;
        private $settings;

        public function __construct (string $language)
        {
            Variable::setLanguage($settings->getLanguage());
            $this->patternFactory = LanguageFactory::getPatternFactory();
        }

        public function setFilepath (string $filepath): void
        {
            $filepath = realpath($filepath);

            if (is_null($filepath) || !is_readable($filepath) || !is_writeable($filepath))
            {
                throw new \Exception("File '{$filepath}' does not exist or is not readble");
            }

            $this->fileContent = file_get_contents($filepath);
        }

        public function run (): bool
        {

        }

        private function rewindFile (): void
        {
            $this->fileContent->rewind();
        }
    }
