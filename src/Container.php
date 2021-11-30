<?php

namespace MultilangAny;

/**
 * Class Container
 *
 * @package MultilangAny
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class Container {

    // On Production Modus you will only get critical errors
    const IS_PRODUCTION_MODUS = true;
    // Default Fallback Language if a Message not in your current choosen Language avaialable
    const FALLBACK_LANGUAGE = 'en';
    // Directory where the Translator find the Language-Resources
    const LANGUAGE_FILES_DIRECTORY = __DIR__ . '/LanguageFiles/';
    // Default Pattern for searching Variables in a Message
    const MESSAGE_ARGUMENTS_PATTERN = '~\{\{\s*(.*?)\s*\}\}~'; // Hello {{name}}
    // Default GET-Paramter if you set the Language via HTTP-Paramter
    const HTTP_LANGUAGE_PARAMTER = 'lang'; // e.g. ?lang=en
    // Default SESSION-Parameter if you set the Language via Session
    const SESSION_LANGUAGE_PARAMTER = 'lang'; // e.g. $_SESSION['lang']
    // Supported Language-File Extension
    const LANGUAGE_FILE_EXTENSION = 'json';
}