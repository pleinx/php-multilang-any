#### fyi: Currently not complete documented :-) Working on it...

# php-multilang-any

A simple library to handle translations (i18n) in your Project.
 
#### Basic Features

* [Production Modus](https://github.com/pleinx/php-multilang-any/wiki)
* [JSON-Files](https://github.com/pleinx/php-multilang-any/wiki) as Language-Resource
* Efficient loading of [Language-Packages](https://github.com/pleinx/php-multilang-any/wiki)
* [Automatic detection](https://github.com/pleinx/php-multilang-any/wiki) of Language (optional)
* Build a custom [Connector](https://github.com/pleinx/php-multilang-any/wiki) for your current Project

#### Translator Features

* Write your [own Translate](https://github.com/pleinx/php-multilang-any/wiki) Function like `__('foo', ['bar'])`
* Support HTML-Markup in Translation

## Basic Usage 
```ini
Translate::__e('Foo', ['Bar']);
// Output "Foo is nicer than Bar"
```

### Configure

```ini
$translatorConfig = (new TranslatorSettings())
    ->setIsProduction(true)
    ->setLanguage('en')
    ->setFallbackLanguage('fr')
    ->setLanguageFilesPath(__DIR__ . '/lang')
    ->addData('customVar', 'customValue');

new TranslatorAPI($translatorConfig);
```

#### Requirements
* PHP 5.6 and above

