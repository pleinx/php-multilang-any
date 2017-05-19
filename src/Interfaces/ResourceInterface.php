<?php

    namespace MultilangAny\Interfaces;


    /**
     * Interface ResourceInterface
     *
     * @package MultilangAny\Interfaces
     * @author Fabian Hesse <pleinx0@gmail.com>
     * Visit me on : https://github.com/pleinx
     */
    interface ResourceInterface {
        /**
         * @param $key
         *
         * @return string
         */
        function getMessageByKey ($key);
    }