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
        private $settings;

        /**
         * AbstractConnector constructor.
         *
         * @param TranslatorSettings|null $settings
         */
        public function __construct (TranslatorSettings $settings = null) {
            $this->settings = ($settings) ?: new TranslatorSettings();
        }

        /**
         * @return string
         */
        function getLanguage () {
            return $this->getSettings()->getLanguage();
        }

        /**
         * @return string
         */
        function getFallbackLanguage () {
            return $this->getSettings()->getFallbackLanguage();
        }

        /**
         * @return TranslatorSettings
         */
        function getSettings () {
            return $this->settings;
        }
    }