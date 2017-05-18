<?php


    namespace TranslatorAPI;

    use TranslatorAPI\Models\Config AS TranslatorConfig;

    /**
     * Class Translator
     *
     * @package TranslatorAPI
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class Translator {

        /**
         * @var TranslatorConfig
         */
        private $config;
        /**
         * @var AbstractConnector
         */
        private $connector;
        /**
         * @var MessageResolver
         */
        private $messageResolver;

        /**
         * Translator constructor.
         *
         * @param TranslatorConfig|null $config
         * @param AbstractConnector|null $connector
         */
        public function __construct (TranslatorConfig $config = null, AbstractConnector $connector = null) {
            // Basic Initialize
            $this->setConfig(($config) ?: new TranslatorConfig());
            $this->setConnector($connector);

            // Find the current Language
            $this->getConfig()->setLanguage($this->getLanguageByContext());

            // Add the MessageResolver
            $this->setMessageResolver(new MessageResolver($this->getConfig(), new ResourceResolver($this->getConfig())));

            // Initialize the Static-Translate Class with our MessageResolver
            new Translate($this->getMessageResolver());
        }

        /**
         * @return TranslatorConfig
         */
        public function getConfig () {
            return $this->config;
        }

        /**
         * @param TranslatorConfig $config
         *
         * @return Translator
         */
        private function setConfig (TranslatorConfig $config) {
            $this->config = $config;

            return $this;
        }

        /**
         * @return AbstractConnector
         */
        public function getConnector () {
            return $this->connector;
        }

        /**
         * @param AbstractConnector|null $connector
         *
         * @return $this
         */
        private function setConnector (AbstractConnector $connector = null) {
            $this->connector = $connector;

            return $this;
        }

        /**
         * @return MessageResolver
         */
        public function getMessageResolver () {
            return $this->messageResolver;
        }

        /**
         * @param MessageResolver $messageResolver
         *
         * @return Translator
         */
        private function setMessageResolver ($messageResolver) {
            $this->messageResolver = $messageResolver;

            return $this;
        }

        /**
         * @return bool|string
         */
        private function getLanguageByContext () {
            // User has forced a Language
            if ($this->getConfig()->getLanguage()) {
                return $this->getConfig()->getLanguage();
            }

            // User has own Connector
            if ($this->getConnector() && $this->getConnector()->getLanguage()) {
                return $this->getConnector()->getLanguage();
            }

            // General Priority if no Language isset
            if (!empty($this->getLanguageByGetParametr())) {
                // by $_GET['YOUR_CHOOSEN_KEY']
                return $this->getLanguageByGetParametr();
            } else if (isset($_SESSION[Container::SESSION_LANGUAGE_PARAMTER])) {
                // by $_SESSION['YOUR_CHOOSEN_KEY']
                return $_SESSION[Container::SESSION_LANGUAGE_PARAMTER];
            }

            // Current Browser Language
            return $this->getBrowserLanguage();
        }

        /**
         * @return bool|string
         */
        private function getLanguageByGetParametr () {
            return (isset($_GET[Container::HTTP_LANGUAGE_PARAMTER])) ? trim($_GET[Container::HTTP_LANGUAGE_PARAMTER]) : false;
        }

        /**
         * @param bool $complete
         *
         * @return bool|string
         */
        private function getBrowserLanguage ($complete = false) {
            return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, ($complete ? null : 2));
        }

        /**
         * @param $messageKey
         * @param array $arguments
         *
         * @return string
         */
        public function translate ($messageKey, $arguments = []) {
            return $this->messageResolver->resolve($messageKey, $arguments);
        }

        /**
         * @return string
         */
        public function getLanguage() {
            return $this->getConfig()->getLanguage();
        }

        /**
         * @return string
         */
        public function getFallbackLanguage() {
            return $this->getConfig()->getFallbackLanguage();
        }
    }