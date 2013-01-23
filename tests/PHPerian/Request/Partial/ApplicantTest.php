<?php

    namespace PHPerian\Request\Partial;

    use \PHPUnit_Framework_TestCase as TestCase;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/PHPerian/Request/Partial/ApplicantTest.php
     */
    class ApplicantTest extends TestCase
    {

        /**
         * Test: Applicant Creation
         *
         * @access public
         * @return void
         */
        public function testApplicantCreation()
        {
            $request = new \PHPerian\Request;
            $this->assertTrue(
                is_object($request),
                'Ensure that a new Request object can be created.'
            );

            $applicant = new \PHPerian\Request\Partial\Applicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new instance of the Applicant class can be created successfully.'
            );

            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new Applicant object can be created through the Request object\'s magic method.'
            );
        }

    }