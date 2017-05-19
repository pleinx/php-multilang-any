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
         * @return bool
         */
        function hasData ();

        /**
         * @param $key
         *
         * @return string
         */
        function getMessageByKey ($key);
    }