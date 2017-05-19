<?php

    namespace MultilangAny;

    use MultilangAny\Models\Data;

    /**
     * Class Settings
     *
     * @package MultilangAny\Models
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Settings extends Data {

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
         * @return Settings
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
         * @return Settings
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
         * @return Settings
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
         * @return Settings
         */
        public function setLanguageFilesPath ($languageFilesPath) {
            $this->languageFilesPath = $languageFilesPath;

            return $this;
        }
    }