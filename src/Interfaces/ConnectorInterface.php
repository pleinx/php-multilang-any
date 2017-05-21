<?php


    namespace MultilangAny\Interfaces;

    use MultilangAny\Settings;

    /**
     * Interface ConnectorInterface
     *
     * @package MultilangAny\Interfaces
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    interface ConnectorInterface {

        /**
         * @return string
         */
        static function getLanguage ();

        /**
         * @return string
         */
        static function getFallbackLanguage ();

        /**
         * @param Settings $settings
         */
        function addSettings (Settings $settings);
    }