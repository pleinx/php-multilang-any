<?php

    namespace TranslatorAPI\Models;

    use TranslatorAPI\Interfaces\ResourceInterface;

    /**
     * Class Resource
     *
     * @package Translator\Models
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Resource implements ResourceInterface {

        /**
         * @var array
         */
        protected $data;

        /**
         * Resource constructor.
         *
         * @param array $input
         */
        public function __construct (Array $input) {
            $this->data = $input;
        }

        /**
         * @return bool
         */
        function hasData () {
            return (count($this->data) > 0);
        }

        /**
         * @param $key
         *
         * @return string
         */
        function getMessageByKey ($key) {
            return (isset($this->data[$key])) ? $this->data[$key] : '';
        }
    }