<?php

    namespace TranslatorAPI\Interfaces;


    /**
     * Interface MessageResolverInterface
     *
     * @package TranslatorAPI\Interfaces
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    interface MessageResolverInterface {

        /**
         * @param $key
         * @param array $args
         *
         * @return string
         */
        function resolve ($key, $args = []);
    }