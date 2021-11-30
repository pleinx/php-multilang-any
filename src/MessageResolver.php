<?php

namespace MultilangAny;

use MultilangAny\Interfaces\MessageResolverInterface;
use MultilangAny\Interfaces\ResourceInterface;

/**
 * Class MessageResolver
 *
 * @package MultilangAny
 * @author  Fabian Hesse <pleinx0@gmail.com>
 * Visit me on: https://github.com/pleinx
 */
class MessageResolver implements MessageResolverInterface {

    private ResourceResolver $resourceResolver;

    function __construct (ResourceResolver $resourceResolver) {
        $this->resourceResolver = $resourceResolver;
    }

    function resolve (string $key, $args = []): string {
        $messageData = $this->getMessageData($key);
        $this->getResourceResolver()->loadLanguagePackByName($messageData['packageName']);
        $resources = $this->getResourceResolver()->getRequestedResource($messageData['packageName']);

        $msg = '';
        foreach ($resources as $resource) {
            $msg .= $this->resolveMessageKeyWithArguments($messageData['messageKey'], $args, $resource);

            if ($msg) {
                break;
            }
        }

        return $msg;
    }

    private function resolveMessageKeyWithArguments (string $key, $args, ResourceInterface $resource): string {
        $msg = $resource->getMessageByKey($key);

        if ($msg === null) {
            return '';
        }

        if (empty($args)) {
            return self::decodeMessage($msg);
        }

        preg_match_all(Container::MESSAGE_ARGUMENTS_PATTERN, $msg, $variables);
        if (!empty($variables) && isset($variables[0])) {
            $msg = str_replace($variables[0], $args, $msg);
        }

        return self::decodeMessage($msg);
    }

    function decodeMessage (string $message): string {
        return html_entity_decode(self::normalizeString($message));
    }

    function normalizeString (string $string): string {
        if (preg_match('!!u', $string)) {
            return $string;
        }

        return utf8_decode($string);
    }

    private function getResourceResolver (): ResourceResolver {
        return $this->resourceResolver;
    }

    private function getMessageData (string $key): array {
        $packageName = substr($key, 0, strpos($key, '.'));
        $messageKey = ltrim(str_replace($packageName, '', $key), '.');

        return [
            'packageName' => $packageName,
            'messageKey' => $messageKey,
        ];
    }
}