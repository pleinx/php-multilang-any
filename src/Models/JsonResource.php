<?php

    namespace TranslatorAPI\Models;

    /**
     * Class JsonResource
     *
     * @package Translator
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class JsonResource extends Resource {

        /**
         * JsonResource constructor.
         *
         * @param string $jsonString
         *
         * @throws \Exception
         */
        public function __construct ($jsonString) {
            $array = json_decode($jsonString, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid or broken JsonResource');
            }

            parent::__construct($array);
        }
    }