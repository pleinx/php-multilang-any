<?php
    /**
     * Notice: You dont need forcing a TranslatorConfig or the Static Translate (aka. TranslateMe) Class.
     * You can also use the Default Path (Check your Config)
     * Its just a Example how to use the Translator.
     */

    // ========================= Initialize the Translator =========================
    use MultilangAny\Models\Config AS TranslatorConfig;
    use MultilangAny\Translator;

    // Give a custom alias, what you want
    // e.g. T = T::__(foo, bar)
    use MultilangAny\Translate AS TranslateMe;

    require '../vendor/autoload.php';

    $translatorConfig = (new TranslatorConfig())
        ->setIsProduction(false)
        ->setLanguageFilesPath(__DIR__ . '/lang');

    $translator = new Translator($translatorConfig);


    // ========================= Usage via Dependendcy Injection =========================
    echo $translator->translate('pkg_general.SayHelloTo', 'Tim');
    // Output in German: "Hallo Tim!" and in english: "Hello Tim"


    // ========================= Usage via Static Class =========================
    TranslateMe::__e('pkg_general.SayHelloTo', 'Peter');
    // Output in German: "Hallo Peter!" and in english: "Hello Peter"


    // ========================= Usage via known helper function =========================
    function __ ($messageKey, $arguments = []) {
        return TranslateMe::__($messageKey, $arguments);
    }

    function __e ($messageKey, $arguments = []) {
        TranslateMe::__e($messageKey, $arguments);
    }

    // As returned value
    $storeMessageSayHelloMessage = __('pkg_general.SayHelloTo', 'Sandra');


    // Direct echo
    __e('pkg_general.SayHelloTo', 'Sandra');
    // Output in German: "Hallo Sandra!" and in english: "Hello Sandra"


    // ========================= Usage with multiply arguments =========================
    TranslateMe::__e('pkg_search.SearchedFor', ['RC Car', 'Toys']);
    // Output in English: Your search results for: "RC Car" in the category "Toys"

    // or if you using one argument multiply in the message
    TranslateMe::__e('pkg_search.SearchResult', ['itemCount' => 5, 'itemCountTotal' => 10]);
    // Output in English: Found 5 from 10. Displayed items 5.