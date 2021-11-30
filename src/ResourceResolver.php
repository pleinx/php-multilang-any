<?php

namespace MultilangAny;

use MultilangAny\Settings as TranslatorSettings;
use MultilangAny\Models\JsonResource;

/**
 * Class ResourceResolver
 * Loads the requested Language-Resources (current Language+Fallback) by PackageName
 *
 * @package MultilangAny
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class ResourceResolver {

    private array $resources = [];

    private TranslatorSettings $config;

    function __construct (TranslatorSettings $config) {
        $this->config = $config;

        if (!is_dir($this->getPath())) {
            throw new \Exception(sprintf('Invalid Language-Files Path (%s). Please check your config.', $this->getPath()));
        }
    }

    function loadLanguagePackByName (string $packageName): bool {
        if (isset($this->resources[$packageName])) {
            return true;
        }

        $beforeResourcesCtn = count($this->getLoadedResources() ?? []);

        foreach ($this->getLanguages() as $language) {
            $resourceFile = $this->getLanguagePackageByParams($packageName, $language);

            if (!file_exists($resourceFile)) {
                continue;
            }

            switch (Container::LANGUAGE_FILE_EXTENSION) {
                default:
                case 'json':
                    $resource = new JsonResource(file_get_contents($resourceFile));
                    break;
            }

            if (!$resource->hasData()) {
                continue;
            }

            $this->resources[$packageName][$language] = $resource;
        }

        return $beforeResourcesCtn < count($this->getLoadedResources());
    }

    function getRequestedResource (string $packageName): array {
        return $this->getLoadedResources()[$packageName] ?? [];
    }

    function getLoadedResources (): array {
        return $this->resources;
    }

    private function getLanguages (): array {
        return array_unique([
            $this->getCurrentLanguage(),
            $this->getFallbackLanguage(),
        ]);
    }

    private function getLanguagePackageByParams (string $key, string $language): string {
        return sprintf('%s%s/%s.%s', rtrim($this->getPath(), '/') . '/', $language, $key, Container::LANGUAGE_FILE_EXTENSION);
    }

    function getConfig (): TranslatorSettings {
        return $this->config;
    }

    function getPath (): string {
        return $this->getConfig()->getLanguageFilesPath();
    }

    function getCurrentLanguage (): string {
        return $this->getConfig()->getLanguage();
    }

    function getFallbackLanguage (): string {
        return $this->getConfig()->getFallbackLanguage();
    }
}