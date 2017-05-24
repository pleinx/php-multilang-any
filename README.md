[![Latest Stable Version](https://poser.pugx.org/pleinx/php-multilang-any/v/stable)](https://packagist.org/packages/pleinx/php-multilang-any)
[![Total Downloads](https://poser.pugx.org/pleinx/php-multilang-any/downloads)](https://packagist.org/packages/pleinx/php-multilang-any)
![compatible](https://img.shields.io/badge/PHP%207-Compatible-brightgreen.svg)
[![License](https://poser.pugx.org/pleinx/php-multilang-any/license)](https://packagist.org/packages/pleinx/php-multilang-any)

##### fyi: Currently not complete documented :-) Working on it...

#### Description

Handles easy your translations for your multi language PHP Project.  

#### Basic Features

* [Production/Debug Modus](https://github.com/pleinx/php-multilang-any/wiki)
* [JSON-Files](https://github.com/pleinx/php-multilang-any/wiki) as Language-Resource
* Efficient loading of [Language-Packages](https://github.com/pleinx/php-multilang-any/wiki)
* [Automatic detection](https://github.com/pleinx/php-multilang-any/wiki) of Language (optional)

#### Translator Features

* Write your [own Translate](https://github.com/pleinx/php-multilang-any/wiki) Function like `__('foo', ['bar'])`
* Supports HTML-Markup in Translation

## Installation via Composer

```ini
composer require pleinx/php-multilang-any
```

##### Don't have Composer?
Just download it here: [https://getcomposer.org/](https://getcomposer.org/)

## Basic Usage 
```ini
Translate::__e('Foo', ['Bar']);
// Output "Foo is nicer than Bar"
```

By default the `TranslatorAPI` load the Translations in `./languageFiles/`.

**Notice:** You find all these default parameters [here](https://github.com/pleinx/php-multilang-any/wiki).

## Customize

```ini
$settings = (new TranslatorSettings())
    ->setIsProduction(false)
    ->setLanguage('de')
    ->setFallbackLanguage('en')
    ->setLanguageFilesPath(__DIR__ . '/lang');

new TranslatorAPI($settings);
```

**Notice:** Or just change the Default Settings, see [here](https://github.com/pleinx/php-multilang-any/wiki).

#### Language Resource Example (JSON) 
```ini
// package_serach.json
{
    "results.success.text": "Your search Results for {{searchTerm}}.",
    "results.failed.text": "Nothing found for {{searchTerm}}",
    "results.success.itemsInCategories": "Found {{itemsCount}} in {{categories}}"
}
```

#### Requirements
* PHP 5.6 and above

