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
     * @link        https://github.com/mynameiszanders/experianwebservice/blob/develop/tests/Nosco/RequestTest.php
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
            $this->setExpectedException('\\Nosco\\Exception');
            $request->nonExistentMethod();
        }

    }