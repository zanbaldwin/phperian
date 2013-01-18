<?php

    namespace Nosco;

    use \PHPUnit_Framework_TestCase as TestCase;

    /**
     * Nosco's Library for Experian Web Services
     *
     * @package     Nosco
     * @category    Experian
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/experianwebservice/blob/develop/tests/Nosco/ExceptionTest.php
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
            $this->assertTrue(is_a($exception, '\\Nosco\\Exception'));
        }

    }