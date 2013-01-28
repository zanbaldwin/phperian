<?php

    namespace PHPerian\Request;

    use \PHPUnit_Framework_TestCase as TestCase;
    use \PHPerian\Exception as Exception;

    class PartialTestClass extends Partial {}

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/PHPerian/Request/PartialTest.php
     */
    class PartialTest extends TestCase
    {

        /**
         * Test: Fetch By ID
         *
         * @access public
         * @return void
         */
        public function testFetchById()
        {
            $partial_test_class = new PartialTestClass;
            $id = $partial_test_class->id();
            $this->assertTrue(
                is_string($id),
                'Check that the ID return from the id() method is a string.'
            );

            $object = Partial::fetchById($id);
            $this->assertTrue(
                is_object($object),
                'Check that an object is returned when fetched by the ID previously returned.'
            );

            Partial::silent();
            $object = Partial::fetchById('NonExistantID');
            $this->assertTrue(
                $object === false,
                'Make sure that a boolean false value is returned when an invalid ID is referenced, instead of an '
              . 'exception thrown, when in silent mode.'
            );

            Partial::verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
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
            $partial_test_class = new PartialTestClass;
            $serial = $partial_test_class->serialize();
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
            $partial_test_class = new PartialTestClass;
            $id = $partial_test_class->id();

            $serial = Partial::serializeById($id);
            $this->assertTrue(
                is_string($serial),
                'Ensure that the serial returned when serializing by the ID that was previously generated is a string.'
            );

            Partial::silent();
            $object = Partial::serializeById('NonExistantID');
            $this->assertTrue(
                $object === false,
                'Ensure that a boolean false is returned when trying to serialize by an ID that does not exist in '
              . 'silent mode.'
            );

            Partial::verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
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
            Partial::silent();

            $serial_partial = 'TzozMzoiUEhQZXJpYW5cUmVxdWVzdFxQYXJ0aWFsVGVzdENsYXNzIjoyOntzOjU6IgAqAGlkIjtzOjMwOiJQYXJ0aWFsNTBmZDI0YTA4MDJjYzcuNjU3MDc2ODYiO3M6OToiACoAc3RydWN0IjthOjA6e319';
            $object = Partial::loadFromSerial($serial_partial);
            $this->assertTrue(
                is_object($object),
                'Ensure that loading from a serial determined from a previous application run returns an object.'
            );

            $partial_test_class = new PartialTestClass;
            $serial = $partial_test_class->serialize();
            $this->assertTrue(
                is_string($serial),
                'Ensure that the value returned by calling serialize() on an object is a string.'
            );

            $object = Partial::loadFromSerial($serial);
            $this->assertTrue(
                is_object($object),
                'Ensure that loading from the serial just created, an object is returned.'
            );

            $serial_nopartial = 'TzoxMzoiTm9zY29cUmVxdWVzdCI6MDp7fQ==';
            $object = Partial::loadFromSerial($serial_nopartial);
            $this->assertTrue(
                $object === false,
                'Ensure that loading from the serial of an object that does not extend Partial returns a boolean false '
              . 'when in silent mode.'
            );

            $object = Partial::loadFromSerial(false);
            $this->assertTrue(
                $object === false,
                'Ensure that trying to load from a serial when the serial passed is not a string returns a boolean '
              . 'false when in silent mode.'
            );

            $object = Partial::loadFromSerial('Undecodable String!');
            $this->assertTrue(
                $object === false,
                'Ensure that trying to load from a serial when the string is undecodable returns a boolean false when '
              . 'in silent mode.'
            );
        }

        /**
         * Test: Load From Serial (Non-Partial Class)
         *
         * @access public
         * @return void
         */
        public function testLoadFromSerialNonPartialClass()
        {
            Partial::verbose();
            $serial_nopartial = 'TzoxMzoiTm9zY29cUmVxdWVzdCI6MDp7fQ==';
            $this->setExpectedException('\\PHPerian\\Exception');
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
            Partial::verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
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
            Partial::verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
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
            $partial_test_class = new PartialTestClass;
            $id = $partial_test_class->id();
            $this->assertTrue(is_string($id));
        }

        /**
         * Test: Is Associative
         *
         * @access public
         * @return void
         */
        public function testIsAssociative()
        {
            $assoc_array = array('zero' => 0, 'one' => 1, 'two' => 2);
            $this->assertTrue(Partial::isAssoc($assoc_array));

            $numerical_array = array(0 => 'zero', 1 => 'one', 2 => 'two');
            $this->assertFalse(Partial::isAssoc($numerical_array));

            $fake_numerical_array = array(0 => 'zero', 2 => 'two', 1 => 'one');
            $this->assertTrue(Partial::isAssoc($fake_numerical_array));
        }

    }