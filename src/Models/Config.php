<?php

    namespace TranslatorAPI\Models;

    use TranslatorAPI\Container;

    /**
     * Class Config
     *
     * @package TranslatorAPI\Models
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Config {

        /**
         * @var bool
         */
        private $production;
        /**
         * @var string
         */
        private $language;
        /**
         * @var string
         */
        private $fallbackLanguage;
        /**
         * @var string
         */
        private $languageFilesPath;

        /**
         * Config constructor.
         */
        public function __construct () {
            $this->setIsProduction(Container::IS_PRODUCTION_MODUS);
            $this->setLanguage(null);
            $this->setFallbackLanguage(Container::FALLBACK_LANGUAGE);
            $this->setLanguageFilesPath(Container::LANGUAGE_FILES_DIRECTORY);
        }

        /**
         * @return bool
         */
        public function isProduction () {
            return $this->production;
        }

        /**
         * @param bool $production
         *
         * @return Config
         */
        public function setIsProduction ($production) {
            $this->production = $production;

            return $this;
        }

        /**
         * @return string
         */
        public function getLanguage () {
            return $this->language;
        }

        /**
         * @param string $language
         *
         * @return Config
         */
        public function setLanguage ($language) {
            $this->language = trim($language);

            return $this;
        }

        /**
         * @return string
         */
        public function getFallbackLanguage () {
            return $this->fallbackLanguage;
        }

        /**
         * @param string $fallbackLanguage
         *
         * @return Config
         */
        public function setFallbackLanguage ($fallbackLanguage) {
            $this->fallbackLanguage = trim($fallbackLanguage);

            return $this;
        }

        /**
         * @return string
         */
        public function getLanguageFilesPath () {
            return $this->languageFilesPath;
        }

        /**
         * @param string $languageFilesPath
         *
         * @return Config
         */
        public function setLanguageFilesPath ($languageFilesPath) {
            $this->languageFilesPath = $languageFilesPath;

            return $this;
        }
    }