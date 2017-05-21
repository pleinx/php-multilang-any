<?php

    namespace MultilangAny\Connectors;

    use MultilangAny\AbstractConnector;

    /**
     * Class ExampleSlimFrameworkV3
     *
     * @package MultilangAny\Connectors
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class ExampleSlimFrameworkV3 extends AbstractConnector {

        /**
         * @var string
         */
        static private $baseURL;

        /**
         * ExampleSlimFrameworkV3 constructor.
         */
        public function __construct () {
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $baseURL = str_replace(basename($scriptName), '', $scriptName);

            self::$baseURL = $baseURL;
        }

        /**
         * @param $url
         *
         * @return string
         */
        static function makeLink ($url) {
            return self::$baseURL . self::getLanguage() . '/' . rtrim(ltrim($url, '/'), '/') . '/';
        }
    }