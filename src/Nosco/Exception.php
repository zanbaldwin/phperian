<?php

    namespace Nosco;

    class Exception extends \Exception
    {

        /**
         * @var string $message
         * The default message for thrown \Nosco\Exception's when one is not set
         * in the constructor method.
         */
        protected $message = 'Nosco Exception';

    }