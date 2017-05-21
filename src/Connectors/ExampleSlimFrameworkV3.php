<?php

    namespace MultilangAny\Connectors;

    use MultilangAny\AbstractConnector;

    /**
     * This is just an Example of Connector how you can integrate Mutlilang-Any in SlimV3
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
            $baseUrlWithLanguage = self::$baseURL . self::getLanguage();
            $parsedUrl = parse_url($baseUrlWithLanguage . '/' . ltrim($url, '/'));
            $url = rtrim($parsedUrl['path'], '/') . '/' . (!empty($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');

            return $url;
        }
    }