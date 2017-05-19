<?php

    namespace MultilangAny;

    use MultilangAny\Interfaces\ConnectorInterface;
    use MultilangAny\Models\Config AS TranslatorConfig;

    /**
     * Class AbstractConnector
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class AbstractConnector implements ConnectorInterface {

        /**
         * @var TranslatorConfig
         */
        private $config;

        /**
         * AbstractConnector constructor.
         *
         * @param TranslatorConfig|null $config
         */
        public function __construct (TranslatorConfig $config = null) {
            $this->config = ($config) ?: new TranslatorConfig();
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
         * @return TranslatorConfig
         */
        function getConfig () {
            return $this->config;
        }
    }