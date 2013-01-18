<?php

    namespace Nosco\Request;

    use \PHPUnit_Framework_TestCase as TestCase;
    use \Nosco\Exception as Exception;

    class PartialSubclass extends Partial
    {
        public function __construct()
        {
            parent::__construct();
        }
    }

    /**
     * Nosco's Library for Experian Web Services
     *
     * @package     Nosco
     * @category    Experian
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/experianwebservice/blob/develop/tests/Nosco/Request/PartialTest.php
     */
    class ExceptionTest extends TestCase
    {

        /**
         * Test: Fetch By ID
         *
         * @access public
         * @return void
         */
        public function testFetchById()
        {
            $partial_subclass = new PartialSubclass;
            $id = $partial_subclass->id();

            $object = Partial::fetchById($id);
            $this->assertTrue(is_object($object));

            $this->setExpectedException('\\Nosco\\Exception');
            $object = Partial::fetchById('NonExistantID');
        }

        /**
         * Test: Serialise
         *
         * @access public
         * @return void
         */
        public function testSerialise()
        {
            $partial_subclass = new PartialSubclass;
            $serial = $partial_subclass->serialize();
            $this->assertTrue(is_string($serial));
        }

        /**
         * Test: Serialise By ID
         *
         * @access public
         * @return void
         */
        public function testSerialiseById()
        {
            $partial_subclass = new PartialSubclass;
            $id = $partial_subclass->id();

            $serial = Partial::serializeById($id);
            $this->assertTrue(is_string($serial));

            $this->setExpectedException('\\Nosco\\Exception');
            $object = Partial::serializeById('NonExistantID');
        }

        /**
         * Test: Load From Serial
         *
         * @access public
         * @return void
         */
        public function testLoadFromSerial()
        {
            $serial_partial = 'TzoyOToiTm9zY29cUmVxdWVzdFxQYXJ0aWFsU3ViY2xhc3MiOjE6e3M6NToiACoAaWQiO3M6MzA6IlBhcnRpYWw1MGY4YjkxODJiNmRiOC41Mjk4MzY1OSI7fQ==';
            $object = Partial::loadFromSerial($serial_partial);
            $this->assertTrue(is_object($object));

            $partial_subclass = new PartialSubclass;
            $serial = $partial_subclass->serialize();
            $object = Partial::loadFromSerial($serial);
            $this->assertTrue(is_object($object));

            $serial_nopartial = 'TzoxMzoiTm9zY29cUmVxdWVzdCI6MDp7fQ==';
            $this->setExpectedException('\\Nosco\\Exception');
            $object = Partial::loadFromSerial($serial_nopartial);
        }

        /**
         * Test: Load From Serial (Incorrect Data Type)
         *
         * @access public
         * @return void
         */
        public function testLoadFromSerialIncorrectDataType()
        {
            $this->setExpectedException('\\Nosco\\Exception');
            $object = Partial::loadFromSerial(false);
        }

        /**
         * Test: Load From Serial (Undecodable)
         *
         * @access public
         * @return void
         */
        public function testLoadFromSerialUndecodable()
        {
            $this->setExpectedException('\\Nosco\Exception');
            $object = Partial::loadFromSerial('Undecodable String!');
        }

        /**
         * Test: ID
         *
         * @access public
         * @return void
         */
        public function testId()
        {
            $partial_subclass = new PartialSubclass;
            $id = $partial_subclass->id();
            $this->assertTrue(is_string($id));
        }

    }