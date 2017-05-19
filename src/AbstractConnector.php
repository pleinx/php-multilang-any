<?php

    namespace MultilangAny;

    use MultilangAny\Interfaces\ConnectorInterface;
    use MultilangAny\Settings AS TranslatorSettings;

    /**
     * Class AbstractConnector
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class AbstractConnector implements ConnectorInterface {

        /**
         * @var TranslatorSettings
         */
        private $config;

        /**
         * AbstractConnector constructor.
         *
         * @param TranslatorSettings|null $config
         */
        public function __construct (TranslatorSettings $config = null) {
            $this->config = ($config) ?: new TranslatorSettings();
        }

        /**
         * @return string
         */
        function getLanguage () {
            return $this->getConfig()->getLanguage();
        }

        /**
         * @return string
         */
        function getFallbackLanguage () {
            return $this->getConfig()->getFallbackLanguage();
        }

        /**
         * @return TranslatorSettings
         */
        function getConfig () {
            return $this->config;
        }
    }