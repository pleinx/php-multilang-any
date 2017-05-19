<?php


    namespace MultilangAny;


    use MultilangAny\Interfaces\MessageResolverInterface;
    use MultilangAny\Interfaces\ResourceInterface;
    use MultilangAny\Settings AS TranslatorSettings;

    /**
     * Class MessageResolver
     *
     * @package MultilangAny
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    class MessageResolver implements MessageResolverInterface {

        /**
         * @var TranslatorSettings
         */
        private $config;
        /**
         * @var ResourceResolver
         */
        private $resourceResolver;

        /**
         * MessageResolver constructor.
         *
         * @param TranslatorSettings $config
         * @param ResourceResolver $resourceResolver
         */
        public function __construct (TranslatorSettings $config, ResourceResolver $resourceResolver) {
            $this->config = $config;
            $this->resourceResolver = $resourceResolver;
        }

        /**
         * @param $key
         * @param array $args
         *
         * @return string
         */
        function resolve ($key, $args = []) {
            $messageData = $this->getMessageData($key);
            $this->getResourceResolver()->loadLanguagePackByName($messageData['packageName']);
            $resources = $this->getResourceResolver()->getRequestedResource($messageData['packageName']);

            $msg = '';

            foreach ($resources AS $resource) {
                $msg .= $this->__buildMessageWithArguments($messageData['messageKey'], $args, $resource);

                if ($msg) {
                    break;
                }
            }

            return $msg;
        }

        /**
         * @param $key
         * @param $args
         * @param ResourceInterface $resource
         *
         * @return mixed|string
         */
        private function __buildMessageWithArguments ($key, $args, ResourceInterface $resource) {
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

        /**
         * @param $message
         *
         * @return string
         */
        function decodeMessage ($message) {
            return html_entity_decode(self::encodeToUtf8($message));
        }

        /**
         * @param $string
         *
         * @return string
         */
        function encodeToUtf8 ($string) {
            if (preg_match('!!u', $string)) {
                return $string;
            }

            return utf8_decode($string);
        }

        /**
         * @return ResourceResolver
         */
        private function getResourceResolver () {
            return $this->resourceResolver;
        }

        /**
         * @param $key
         *
         * @return array
         */
        private function getMessageData ($key) {
            $packageName = substr($key, 0, strpos($key, '.'));
            $messageKey = ltrim(str_replace($packageName, '', $key), '.');

            return [
                'packageName' => $packageName,
                'messageKey' => $messageKey
            ];
        }
    }