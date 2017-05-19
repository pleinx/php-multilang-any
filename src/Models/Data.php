<?php

    namespace MultilangAny\Models;

    /**
     * Class Data
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Data {

        /**
         * @var array
         */
        protected $data;

        /**
         * @return array
         */
        public function getData () {
            return $this->data;
        }

        /**
         * @param array $data
         *
         * @return Data
         */
        public function setData ($data) {
            $this->data = $data;

            return $this;
        }

        /**
         * @return bool
         */
        public function hasData () {
            return (!empty($this->getData()));
        }

        /**
         * @param $key
         *
         * @return mixed|null
         */
        public function getItem ($key) {
            return ($this->exists($key)) ? $this->data[$key] : null;
        }

        /**
         * @param $key
         *
         * @return bool
         */
        public function exists ($key) {
            return (isset($this->data[$key]));
        }

        /**
         * @param $key
         * @param $value
         */
        public function addData ($key, $value) {
            $this->data[$key] = $value;
        }
    }