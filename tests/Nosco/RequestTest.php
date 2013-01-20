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
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/PHPerian/RequestTest.php
     */
    class RequestTest extends TestCase
    {

        /**
         * Test: Example
         *
         * @access public
         * @return void
         */
        public function testMagicMethodThrowsException()
        {
            $request = new Request;
            $this->setExpectedException('\\PHPerian\\Exception');
            $request->nonExistentMethod();
        }

    }