<?php

namespace MultilangAny;

use MultilangAny\Models\Data;

/**
 * Class Settings
 *
 * @package MultilangAny\Models
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class Settings extends Data {

    private bool $production = Container::IS_PRODUCTION_MODUS;

    private string $language = '';

    private string $fallbackLanguage = Container::FALLBACK_LANGUAGE;

    private string $languageFilesPath = Container::LANGUAGE_FILES_DIRECTORY;

    /**
     * @return bool
     */
    function isProduction (): bool {
        return $this->production;
    }

    /**
     * @param bool $production
     *
     * @return Settings
     */
    function setIsProduction (bool $production): Settings {
        $this->production = $production;

        return $this;
    }

    /**
     * @return string
     */
    function getLanguage (): string {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return Settings
     */
    function setLanguage (string $language): Settings {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    function getFallbackLanguage (): string {
        return $this->fallbackLanguage;
    }

    /**
     * @param string $fallbackLanguage
     *
     * @return Settings
     */
    function setFallbackLanguage (string $fallbackLanguage): Settings {
        $this->fallbackLanguage = $fallbackLanguage;

        return $this;
    }

    /**
     * @return string
     */
    function getLanguageFilesPath (): string {
        return $this->languageFilesPath;
    }

    /**
     * @param string $languageFilesPath
     *
     * @return Settings
     */
    function setLanguageFilesPath (string $languageFilesPath): Settings {
        $this->languageFilesPath = $languageFilesPath;

        return $this;
    }
}