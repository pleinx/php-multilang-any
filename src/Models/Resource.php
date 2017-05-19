<?php

    namespace MultilangAny\Models;

    use MultilangAny\Interfaces\ResourceInterface;

    /**
     * Class Resource
     *
     * @package Translator\Models
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Resource extends Data implements ResourceInterface {

        /**
         * Resource constructor.
         *
         * @param array $input
         */
        public function __construct (Array $input) {
            $this->setData($input);
        }

        /**
         * @param $key
         *
         * @return string
         */
        function getMessageByKey ($key) {
            return $this->getItem($key);
        }
    }