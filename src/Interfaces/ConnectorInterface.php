<?php


    namespace TranslatorAPI\Interfaces;

    /**
     * Interface ConnectorInterface
     *
     * @package TranslatorAPI\Interfaces
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    interface ConnectorInterface {

        /**
         * @return string
         */
        function getLanguage ();

        /**
         * @return string
         */
        function getFallbackLanguage();
    }