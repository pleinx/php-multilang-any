<?php


    namespace MultilangAny;

    use MultilangAny\Settings AS TranslatorSettings;

    /**
     * Class Translator
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class TranslatorAPI {

        /**
         * @var TranslatorSettings
         */
        private $settings;
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
         * @param TranslatorSettings|null $settings
         * @param AbstractConnector|null $connector
         */
        public function __construct (TranslatorSettings $settings = null, AbstractConnector $connector = null) {
            // Basic Initialize
            $this->setSettings(($settings) ?: new TranslatorSettings());

            // Find the current Language
            $this->getSettings()->setLanguage($this->getLanguageByContext());

            // Set User Connector
            if ($connector instanceof AbstractConnector) {
                $this->setConnector($connector);
                $this->getConnector()->addSettings($settings);
            }

            // Add the MessageResolver
            $this->setMessageResolver(new MessageResolver($this->getSettings(), new ResourceResolver($this->getSettings())));

            // Initialize the Static-Translate Class with our MessageResolver
            new Translate($this->getMessageResolver());
        }

        /**
         * @return TranslatorSettings
         */
        public function getSettings () {
            return $this->settings;
        }

        /**
         * @param TranslatorSettings $config
         *
         * @return TranslatorAPI
         */
        private function setSettings (TranslatorSettings $config) {
            $this->settings = $config;

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
         * @return TranslatorAPI
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
            if ($this->getSettings()->getLanguage()) {
                return $this->getSettings()->getLanguage();
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
        public function getLanguage () {
            return $this->getSettings()->getLanguage();
        }

        /**
         * @return string
         */
        public function getFallbackLanguage () {
            return $this->getSettings()->getFallbackLanguage();
        }
    }