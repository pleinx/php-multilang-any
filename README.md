#### fyi: Currently not complete documented :-) Working on it...

#### Description

An PHP-library to handle translations (i18n) in your Project.
 
#### Basic Features

* [Production Modus](https://github.com/pleinx/php-multilang-any/wiki)
* [JSON-Files](https://github.com/pleinx/php-multilang-any/wiki) as Language-Resource
* Efficient loading of [Language-Packages](https://github.com/pleinx/php-multilang-any/wiki)
* [Automatic detection](https://github.com/pleinx/php-multilang-any/wiki) of Language (optional)
* Build a custom [Connector](https://github.com/pleinx/php-multilang-any/wiki) for your current Project

#### Translator Features

* Write your [own Translate](https://github.com/pleinx/php-multilang-any/wiki) Function like `__('foo', ['bar'])`
* Supports HTML-Markup in Translation

## Basic Usage 
```ini
Translate::__e('Foo', ['Bar']);
// Output "Foo is nicer than Bar"
```

## Configure

```ini
$translatorConfig = (new TranslatorSettings())
    ->setIsProduction(true)
    ->setLanguage('en')
    ->setFallbackLanguage('fr')
    ->setLanguageFilesPath(__DIR__ . '/lang')
    ->addData('customVar', 'customValue');

new TranslatorAPI($translatorConfig);
```

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

