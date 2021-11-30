<?php

namespace MultilangAny;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use MultilangAny\Settings as TranslatorSettings;

/**
 * Class Translator
 *
 * @package MultilangAny
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class TranslatorAPI {

    private TranslatorSettings $settings;

    private MessageResolver $messageResolver;

    function __construct (TranslatorSettings $settings = null) {
        // Basic Initialize
        $this->setSettings(($settings) ?: new TranslatorSettings());

        // Find the current Language
        $this->getSettings()->setLanguage($this->getLanguageByContext());

        // Add the MessageResolver
        $this->setMessageResolver(new MessageResolver(new ResourceResolver($this->getSettings())));

        // Initialize the Static-Translate Class with our MessageResolver
        new Translate($this->getMessageResolver());
    }

    function getSettings (): TranslatorSettings {
        return $this->settings;
    }

    private function setSettings (TranslatorSettings $config): TranslatorAPI {
        $this->settings = $config;

        return $this;
    }

    function getMessageResolver (): MessageResolver {
        return $this->messageResolver;
    }

    private function setMessageResolver (MessageResolver $messageResolver): self {
        $this->messageResolver = $messageResolver;

        return $this;
    }

    private function getLanguageByContext () {
        // User has forced a Language
        if ($this->getSettings()->getLanguage()) {
            return $this->getSettings()->getLanguage();
        }

        // General Priority if no Language isset
        if (!empty($this->getLanguageByUrl())) {
            // by $_GET['YOUR_CHOOSEN_KEY']
            return $this->getLanguageByUrl();
        } elseif (isset($_SESSION[Container::SESSION_LANGUAGE_PARAMTER])) {
            // by $_SESSION['YOUR_CHOOSEN_KEY']
            return $_SESSION[Container::SESSION_LANGUAGE_PARAMTER];
        }

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            // Current Browser Language
            return $this->getLanguageFromUserAgent();
        }

        // no language found - return the fallback language
        return $this->getSettings()->getFallbackLanguage();
    }

    private function getLanguageByUrl () {
        return (isset($_GET[Container::HTTP_LANGUAGE_PARAMTER])) ? trim($_GET[Container::HTTP_LANGUAGE_PARAMTER]) : false;
    }

    private function getLanguageFromUserAgent (bool $complete = false) {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, $complete ? null : 2);
    }

    function translate (string $messageKey, $arguments = []) {
        return $this->messageResolver->resolve($messageKey, $arguments);
    }

    function getLanguage (): string {
        return $this->getSettings()->getLanguage();
    }

    function getFallbackLanguage (): string {
        return $this->getSettings()->getFallbackLanguage();
    }
}