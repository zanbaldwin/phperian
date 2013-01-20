<?php

    namespace PHPerian;

    class Exception extends \Exception
    {

        /**
         * @var string $message
         * The default message for thrown \PHPerian\Exception's when one is not set
         * in the constructor method.
         */
        protected $message = 'PHPerian Exception';

    }