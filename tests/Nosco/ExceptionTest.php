<?php

    namespace PHPerian;

    use \PHPUnit_Framework_TestCase as TestCase;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/PHPerian/ExceptionTest.php
     */
    class ExceptionTest extends TestCase
    {

        /**
         * Test: Example
         *
         * @access public
         * @return void
         */
        public function testExceptionExtendsCorrectly()
        {
            $exception = new Exception;
            $this->assertTrue(is_a($exception, '\\Exception'));
            $this->assertTrue(is_a($exception, '\\PHPerian\\Exception'));
        }

    }