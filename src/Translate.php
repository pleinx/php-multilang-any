<?php

    namespace MultilangAny;


    /**
     * Class Translate
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Translate {

        /**
         * @var MessageResolver
         */
        static private $messageResolver;

        /**
         * Translate constructor.
         *
         * @param MessageResolver $messageResolver
         */
        public function __construct (MessageResolver $messageResolver) {
            self::$messageResolver = $messageResolver;
        }

        /**
         * @param $key
         * @param array $args
         *
         * @return string
         */
        static function __ ($key, $args = []) {
            return self::$messageResolver->resolve($key, $args);
        }

        /**
         * @param $key
         * @param array $args
         */
        static function __e ($key, $args = []) {
            echo self::__($key, $args);
        }
    }