<?php

    namespace Nosco;

    use \PHPUnit_Framework_TestCase as TestCase;

    /**
     * Nosco's Library for Experian Web Services
     *
     * This is a convinience file for bootstrapping the library during testing.
     * Do not call this file if you are autoloading via Composer.
     *
     * @package     Nosco
     * @category    Experian
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/experianwebservice/blob/develop/tests/Nosco/ExampleTest.php
     */
    class ExampleTest extends TestCase
    {

        /**
         * Test: Example
         *
         * @access public
         * @return void
         */
        public function testExample()
        {
            $this->assertTrue(true);
        }

    }