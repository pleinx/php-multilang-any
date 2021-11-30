<?php

namespace MultilangAny\Interfaces;

/**
 * Interface MessageResolverInterface
 *
 * @package MultilangAny\Interfaces
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
interface MessageResolverInterface {

    function resolve (string $key, $args = []);
}