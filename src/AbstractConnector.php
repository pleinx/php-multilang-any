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
        private static $settings;

        /**
         * @return string
         */
        static function getLanguage () {
            return self::getSettings()->getLanguage();
        }

        /**
         * @return string
         */
        static function getFallbackLanguage () {
            return self::getSettings()->getFallbackLanguage();
        }

        /**
         * @return TranslatorSettings
         */
        static function getSettings () {
            return self::$settings;
        }

        /**
         * @param Settings $settings
         */
        function addSettings (Settings $settings) {
            self::$settings = $settings;
        }
    }