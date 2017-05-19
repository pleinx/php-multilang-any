<?php

    namespace MultilangAny;


    use MultilangAny\Settings AS TranslatorSettings;
    use MultilangAny\Models\JsonResource;

    /**
     * Class ResourceResolver
     * Loads the requested Language-Resources (current Language+Fallback) by PackageName
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class ResourceResolver {

        /**
         * @var array
         */
        private $resources;
        /**
         * @var TranslatorSettings
         */
        private $config;

        /**
         * ResourceResolver constructor.
         *
         * @param TranslatorSettings $config
         *
         * @throws \Exception
         */
        public function __construct (TranslatorSettings $config) {
            $this->config = $config;

            if (!is_dir($this->getPath())) {
                throw new \Exception(sprintf('Invalid Language-Files Path (%s). Please check your config.', $this->getPath()));
            }
        }

        /**
         * @param $packageName
         *
         * @return bool
         */
        public function loadLanguagePackByName ($packageName) {
            if (isset($this->resources[$packageName])) {
                return true;
            }

            $beforeResourcesCtn = count($this->getLoadedResources());

            foreach ($this->getLanguages() AS $language) {
                $resourceFile = $this->getLanguagePackageByParams($packageName, $language);

                if (!file_exists($resourceFile)) {
                    continue;
                }

                switch (Container::LANGUAGE_FILE_EXTENSION) {
                    default:
                    case 'json':
                        $resource = new JsonResource(file_get_contents($resourceFile));
                        break;
                }

                if (!$resource->hasData()) {
                    continue;
                }

                $this->resources[$packageName][$language] = $resource;
            }

            return $beforeResourcesCtn < count($this->getLoadedResources());
        }

        /**
         * @param $packageName
         *
         * @return array
         */
        public function getRequestedResource ($packageName) {
            return isset($this->getLoadedResources()[$packageName]) ? $this->getLoadedResources()[$packageName] : [];
        }

        /**
         * @return array
         */
        public function getLoadedResources () {
            return $this->resources;
        }

        /**
         * @return array
         */
        private function getLanguages () {
            return array_unique([
                $this->getCurrentLanguage(),
                $this->getFallbackLanguage()
            ]);
        }

        /**
         * @param $key
         * @param $language
         *
         * @return string
         */
        private function getLanguagePackageByParams ($key, $language) {
            return sprintf('%s%s/%s.%s', rtrim($this->getPath(), '/') . '/', $language, $key, Container::LANGUAGE_FILE_EXTENSION);
        }

        /**
         * @return TranslatorSettings
         */
        public function getConfig () {
            return $this->config;
        }

        /**
         * @return string
         */
        public function getPath () {
            return $this->getConfig()->getLanguageFilesPath();
        }

        /**
         * @return string
         */
        public function getCurrentLanguage () {
            return $this->getConfig()->getLanguage();
        }

        /**
         * @return string
         */
        public function getFallbackLanguage () {
            return $this->getConfig()->getFallbackLanguage();
        }
    }