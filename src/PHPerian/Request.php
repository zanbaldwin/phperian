<?php

    namespace PHPerian;

    use \PHPerian\Exception as Exception;

    /**
     * Request Base Class
     *
     * The base class for all service calls to Experian.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request.php
     */
    class Request
    {

        /**
         * Constructor Method
         *
         * @access public
         * @return void
         */
        public function __construct() {}

        /**
         * Magic Method: Call
         *
         * If a method to create a new object has been called, attempt to find
         * the class and initialise it with the parameters passed.
         * Obviously, if the method does not exist, throw an exception.
         *
         * @access public
         * @throws \Nosco\Exception
         * @return object
         */
        public function __call($method, $arguments)
        {
            // This magic method is to catch any calls to "magic" methods that create and return a new instance of a
            // Request sub-class. So, make sure that the method keyword is "create", and that the rest of the method
            // string identifies the class to initiate.
            if(preg_match('/^create([A-Z].*)$/', $method, $matches)) {
                // Make sure that the class specified in the method exists as a Request sub-class.
                $class = '\\' . __CLASS__ . '\\Partial\\' . $matches[1];
                if(class_exists($class)) {
                    // It does? Great! Create a new instance based on the arguments passed and return it.
                    $reflection = new \ReflectionClass($class);
                    return $reflection->newInstanceArgs($arguments);
                }
            }
            // If the method called was invalid (eg, it didn't map to a Request sub-class) throw an exception.
            throw new Exception('Call to undefined method "' . $method . '" on class "' . __CLASS__ . '".');
        }

        /**
         * Shortcut: Verbose
         *
         * @access public
         * @return void
         */
        public function verbose()
        {
            \PHPerian\Request\Partial::verbose();
        }

        /**
         * Shortcut: Silent
         *
         * @access public
         * @return void
         */
        public function silent()
        {
            \PHPerian\Request\Partial::silent();
        }

    }