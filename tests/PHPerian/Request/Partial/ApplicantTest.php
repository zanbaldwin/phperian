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

            $this->setExpectedException('\\PHPerian\\Exception');
            $request->createApplicant('Test', 123);
        }

        /**
         * Test: Title
         *
         * @access public
         * @return void
         */
        public function testTitle()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->title() === null,
                'Ensure that the return value of title() is null when a title has not yet been set.'
            );
            $applicant = $applicant->title('Lord');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the title() method returns an object after a successfully setting the title.'
            );
            $this->assertTrue(
                $applicant->title() === 'Lord',
                'Ensure the title() method returns the same string that we set.'
            );

            $wrong = 'Th1$ i$ completely wrong {or @ title input.';

            $request->silent();
            $return = $applicant->title($wrong);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the title() method returns an object after an invalid input has been set when in silent mode.'
            );
            $this->assertTrue(
                $applicant->title() === 'Lord',
                'Ensure that the last value set is returned, and an invalid input has not overwritten it.'
            );
            $this->setExpectedException('\\PHPerian\\Exception');
            $request->verbose();
            $applicant = $applicant->title($wrong);
        }

        /**
         * Test: Middle Name
         *
         * @access public
         * @return void
         */
        public function testMiddleName()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->middleName() === null,
                'Ensure that the return value of middleName() is null when a middle name has not yet been set.'
            );
            $applicant = $applicant->middleName('Scenario');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the middleName() method returns an object after a successfully setting the middleName.'
            );
            $this->assertTrue(
                $applicant->middleName() === 'Scenario',
                'Ensure the middleName() method returns the same string that we set.'
            );

            $wrong = 'Th1$ i$ completely wrong {or @ middleName input.';

            $request->silent();
            $return = $applicant->middleName($wrong);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the middleName() method returns an object after an invalid input has been set when in silent mode.'
            );
            $this->assertTrue(
                $applicant->middleName() === 'Scenario',
                'Ensure that the last value set is returned, and an invalid input has not overwritten it.'
            );
            $this->setExpectedException('\\PHPerian\\Exception');
            $request->verbose();
            $applicant = $applicant->middleName($wrong);
        }

        /**
         * Test: Suffix
         *
         * @access public
         * @return void
         */
        public function testSuffix()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->suffix() === null,
                'Ensure that the return value of suffix() is null when a suffix has not yet been set.'
            );
            $applicant = $applicant->suffix('MBCS');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the suffix() method returns an object after a successfully setting the suffix.'
            );
            $this->assertTrue(
                $applicant->suffix() === 'MBCS',
                'Ensure the suffix() method returns the same string that we set.'
            );

            $wrong = 'Th1$ i$ completely wrong {or @ suffix input.';

            $request->silent();
            $return = $applicant->suffix($wrong);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the suffix() method returns an object after an invalid input has been set when in silent mode.'
            );
            $this->assertTrue(
                $applicant->suffix() === 'MBCS',
                'Ensure that the last value set is returned, and an invalid input has not overwritten it.'
            );
            $this->setExpectedException('\\PHPerian\\Exception');
            $request->verbose();
            $applicant = $applicant->suffix($wrong);
        }

        /**
         * Test: Gender
         *
         * @access public
         * @return void
         */
        public function testGender()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->gender() === null,
                'Ensure that the return value of gender() is null when a gender has not yet been set.'
            );
            $applicant = $applicant->gender('M');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the gender() method returns an object after a successfully setting the gender.'
            );
            $this->assertTrue(
                $applicant->gender() === 'M',
                'Ensure the gender() method returns the same string that we set.'
            );

            $wrong = 'X';

            $request->silent();
            $return = $applicant->gender($wrong);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the gender() method returns an object after an invalid input has been set when in silent mode.'
            );
            $this->assertTrue(
                $applicant->gender() === 'M',
                'Ensure that the last value set is returned, and an invalid input has not overwritten it.'
            );
            $this->setExpectedException('\\PHPerian\\Exception');
            $request->verbose();
            $applicant = $applicant->gender($wrong);
        }

        /**
         * Test: Set Gender Male
         *
         * @access public
         * @return void
         */
        public function testGenderMale()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->gender() === null,
                'Ensure that the return value of gender() is null when a gender has not yet been set.'
            );
            $applicant->setGenderMale();
            $this->assertTrue(
                $applicant->gender() === 'M',
                'Ensure that the return value of gender() is "M" when the method setGenderMale() is invoked.'
            );
        }

        /**
         * Test: Set Gender Female
         *
         * @access public
         * @return void
         */
        public function testGenderFemale()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->gender() === null,
                'Ensure that the return value of gender() is null when a gender has not yet been set.'
            );
            $applicant->setGenderFemale();
            $this->assertTrue(
                $applicant->gender() === 'F',
                'Ensure that the return value of gender() is "F" when the method setGenderFemale() is invoked.'
            );
        }

        /**
         * Test: Date Of Birth
         *
         * @access public
         * @return void
         */
        public function testDateOfBirth()
        {
            $request = new \PHPerian\Request;
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                $applicant->dateOfBirth() === null,
                'Ensure that the return value of dateOfBirth() is null when a DOB has not yet been set.'
            );
            $applicant = $applicant->dateOfBirth(1970, 1, 1);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the dateOfBirth() method returns an object after a successfully setting the DOB.'
            );
            $this->assertTrue(
                $applicant->dateOfBirth() === '1970/01/01',
                'Ensure the dateOfBirth() method returns the same date that we set.'
            );
            $request->silent();
            $applicant = $applicant->dateOfBirth(1971, 1);
            $this->assertTrue(
                is_object($applicant),
                'Ensure that the dateOfBirth() method returns an object after an unsuccessfully setting of the DOB when in silent mode.'
            );
            $this->assertTrue(
                $applicant->dateOfBirth() === '1970/01/01',
                'Ensure the dateOfBirth() method returns the same date that we set before the invalid data we passed. '
              . 'This asserts that all three parameters are needed to successfully set the DOB.'
            );

            $this->setExpectedException('\\PHPerian\\Exception');
            $request->verbose();
            $applicant->dateOfBirth(1850);
        }

    }