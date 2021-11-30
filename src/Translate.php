<?php

namespace MultilangAny;

/**
 * Class Translate
 *
 * @package MultilangAny
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class Translate {

    private static MessageResolver $messageResolver;

    function __construct (MessageResolver $messageResolver) {
        self::$messageResolver = $messageResolver;
    }

    static function __ (string $key, $args = []): string {
        return self::$messageResolver->resolve($key, $args);
    }

    static function __e (string $key, $args = []): void {
        echo self::__($key, $args);
    }
}