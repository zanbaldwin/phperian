<?php

    namespace Nosco\Request\Partial;

    use \PHPUnit_Framework_TestCase as TestCase;
    use \Nosco\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * @package     Nosco
     * @category    PHPerian
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/Nosco/Request/Partial/ApplicantTest.php
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
            $request = new \Nosco\Request;
            $this->assertTrue(
                is_object($request),
                'Ensure that a new Request object can be created.'
            );

            $applicant = new \Nosco\Request\Partial\Applicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new Applicant class can be created successfully.'
            );

            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new Applicant object can be created through the Request objects magic method.'
            );
        }

    }