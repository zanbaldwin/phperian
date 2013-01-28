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
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/tests/PHPerian/Request/Partial/ApplicationDataTest.php
     */
    class ApplicationDataTest extends TestCase
    {

        private $request = null;

        public function createInstance()
        {
            $request = new \PHPerian\Request;
            $this->assertTrue(
                is_object($request),
                'Ensure that a new Request object can be created.'
            );
            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new Applicant object can be created.'
            );
            $appdata = $request->createApplicationData($applicant);
            $this->assertTrue(
                is_object($appdata),
                'Ensure that a new Application object can be created through the Request object\'s magic method.'
            );
            $this->request = $request;
            return $appdata;
        }

        public function testApplicationDataCreation()
        {
            $request = new \PHPerian\Request;
            $this->assertTrue(
                is_object($request),
                'Ensure that a new Request object can be created.'
            );

            $applicant = $request->createApplicant('Test', 'Case');
            $this->assertTrue(
                is_object($applicant),
                'Ensure that a new Applicant object can be created.'
            );

            $appdata = new \PHPerian\Request\Partial\ApplicationData($applicant);
            $this->assertTrue(
                is_object($appdata),
                'Ensure that a new instance of the Application class can be created successfully.'
            );

            $appdata = $request->createApplicationData($applicant);
            $this->assertTrue(
                is_object($appdata),
                'Ensure that a new Application object can be created through the Request object\'s magic method.'
            );
        }

        public function testMaritalStatus()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->maritalStatus() === null,
                'Ensure that the return value is none when a marital status has not yet been set.'
            );
            $this->assertTrue(
                is_object($appdata->maritalStatus('S')),
                'Ensure that an object is returned when a valid value is set.'
            );
            $this->assertTrue(
                $appdata->maritalStatus() === 'S',
                'Ensure that the return value is the same as the one we set.'
            );
            $this->request->silent();
            $this->assertTrue(
                is_object($appdata->maritalStatus('A')),
                'Ensure that an object is returned when an invalid value is set in silent mode().'
            );
            $this->assertTrue(
                $appdata->maritalStatus() === 'S',
                'Ensure that the invalid value does not override our previously set value.'
            );
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->maritalStatus('A');
        }

        public function testHomeTelephone()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->homeTelephone() === null,
                'Ensure that the return value is null when a home telephone number has not yet been set.'
            );
            $this->assertTrue(
                is_object($appdata->homeTelephone('01452', '123456')),
                'Ensure that an object is returned when a valid value is set.'
            );
            $this->assertTrue(
                $appdata->homeTelephone() === '01452 123456',
                'Ensure that a formatted string from our passed values is returned.'
            );
            $this->request->silent();
            $this->assertTrue(
                is_object($appdata->homeTelephone(123, 456)),
                'Ensure that an object is returned when non-strings are passed in silent mode.'
            );
            $this->assertTrue(
                $appdata->homeTelephone() === '01452 123456',
                'Ensure that our previous values were not overwritten when in silent mode.'
            );
            $this->assertTrue(
                is_object($appdata->homeTelephone('01242')),
                'Ensure that an object is returned when only one parameter is passed in silent mode.'
            );
            $this->assertTrue(
                $appdata->homeTelephone() === '01452 123456',
                'Ensure that our previous values were not overwritten when only one parameter was passed.'
            );
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->homeTelephone('123a');
        }

        public function testMobileTelephone()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->mobileTelephoneNumber() === null,
                'Ensure that the return value is null when a home telephone area has not yet been set.'
            );
            $this->assertTrue(
                is_object($appdata->mobileTelephoneNumber('01452')),
                'Ensure that an object is returned when a valid value is set.'
            );
            $this->assertTrue(
                $appdata->mobileTelephoneNumber() === '01452',
                'Ensure that the return value is the same as the one we set.'
            );
            $this->request->silent();
            $this->assertTrue(
                is_object($appdata->mobileTelephoneNumber('12 34')),
                'Ensure that an object is returned when an invalid value is set in silent mode.'
            );
            $this->assertTrue(
                $appdata->mobileTelephoneNumber() === '01452',
                'Ensure that our previous value was not overwritten with the invalid value.'
            );
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->mobileTelephoneNumber('12 34');
        }

        public function testDependants()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->dependants() === null,
                'Ensure that the return value is null when nothing has been set yet.'
            );
            $this->assertTrue(
                is_object($appdata->dependants(3)),
                'Ensure that an object is returned when a valid value is set.'
            );
            $this->assertTrue(
                $appdata->dependants() === 3,
                'Ensure that the return value is the same as the one we set.'
            );
            $appdata->dependants(14);
            $this->assertTrue(
                $appdata->dependants() === 7,
                'Ensure that a value above seven is returned as seven, since we set it as an integer.'
            );
            $appdata->dependants('Z');
            $this->assertTrue(
                $appdata->dependants() === 8,
                'Ensure that the return value is an integer 8, when "Z" (not given) is set.'
            );
            $appdata->dependants('Q');
            $this->assertTrue(
                $appdata->dependants() === 9,
                'Ensure that the return value is an integer 9, when "Q" (not asked) is set.'
            );
            $this->request->silent();
            $this->assertTrue(
                is_object($appdata->dependants('asd')),
                'Ensure that an object is returned when an invalid value is set in silent mode.'
            );
            $this->assertTrue(
                $appdata->dependants() === 9,
                'Ensure that our previous value was not overwritten when an invalid value was set in silent mode.'
            );
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->dependants('asd');
        }

        public function testResidentialStatus()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->residentialStatus() === null,
                'Ensure that the return value is none when a marital status has not yet been set.'
            );
            $this->assertTrue(
                is_object($appdata->residentialStatus('O')),
                'Ensure that an object is returned when a valid value is set.'
            );
            $this->assertTrue(
                $appdata->residentialStatus() === 'O',
                'Ensure that the return value is the same as the one we set.'
            );
            $this->request->silent();
            $this->assertTrue(
                is_object($appdata->residentialStatus('A')),
                'Ensure that an object is returned when an invalid value is set in silent mode().'
            );
            $this->assertTrue(
                $appdata->residentialStatus() === 'O',
                'Ensure that the invalid value does not override our previously set value.'
            );
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->residentialStatus('A');
        }

        public function testEmailAddress()
        {
            $appdata = $this->createInstance();
            $this->assertTrue(
                $appdata->emailAddress() === null
            );
            $this->assertTrue(is_object($appdata->emailAddress('test@example.com')));
            $this->assertTrue($appdata->emailAddress() === 'test@example.com');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->emailAddress('notanemailaddress')));
            $this->assertTrue($appdata->emailAddress() === 'test@example.com');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->emailAddress('notanemailaddress');
        }

        public function testNationalInsuranceNumber()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->nationalInsuranceNumber() === null);
            $this->assertTrue(is_object($appdata->nationalInsuranceNumber('AB123456C')));
            $this->assertTrue($appdata->nationalInsuranceNumber() === 'AB123456C');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->nationalInsuranceNumber('this is completely wrong')));
            $this->assertTrue($appdata->nationalInsuranceNumber() === 'AB123456C');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->nationalInsuranceNumber('this is completely wrong');
        }

        public function testPassportNumber()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->passportNumber() === null);
            $this->assertTrue(is_object($appdata->passportNumber('AB123456C')));
            $this->assertTrue($appdata->passportNumber() === 'AB123456C');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->passportNumber('this is completely wrong')));
            $this->assertTrue($appdata->passportNumber() === 'AB123456C');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->passportNumber('this is completely wrong');
        }

        public function testCountryOfBirth()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->countryOfBirth() === null);
            $this->assertTrue(is_object($appdata->countryOfBirth('E')));
            $this->assertTrue($appdata->countryOfBirth() === 'E');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->countryOfBirth('A')));
            $this->assertTrue($appdata->countryOfBirth() === 'E');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->countryOfBirth('A');
        }

        public function testTimeWithBank()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->timeWithBank() === null);
            $this->assertTrue(is_object($appdata->timeWithBank(10, 10)));
            $this->assertTrue($appdata->timeWithBank() === '10y 10m');
            $this->assertTrue(is_object($appdata->timeWithBank(10)));
            $this->assertTrue($appdata->timeWithBank() === '10y');
            $this->assertTrue(is_object($appdata->timeWithBank(0, 10)));
            $this->assertTrue($appdata->timeWithBank() === '10m');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->timeWithBank(10, 'asd')));
            $this->assertTrue($appdata->timeWithBank() === '10m');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->timeWithBank(10, 'asd');
        }

        public function testBankSortCode()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->bankSortCode() === null);
            $this->assertTrue(is_object($appdata->bankSortCode('AB123456C')));
            $this->assertTrue($appdata->bankSortCode() === 'AB123456C');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->bankSortCode('this is completely wrong')));
            $this->assertTrue($appdata->bankSortCode() === 'AB123456C');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->bankSortCode('this is completely wrong');
        }

        public function testBankAccountNumber()
        {
            $appdata = $this->createInstance();
            $this->assertTrue($appdata->bankAccountNumber() === null);
            $this->assertTrue(is_object($appdata->bankAccountNumber('AB123456C')));
            $this->assertTrue($appdata->bankAccountNumber() === 'AB123456C');
            $this->request->silent();
            $this->assertTrue(is_object($appdata->bankAccountNumber('this is completely wrong')));
            $this->assertTrue($appdata->bankAccountNumber() === 'AB123456C');
            $this->request->verbose();
            $this->setExpectedException('\\PHPerian\\Exception');
            $appdata->bankAccountNumber('this is completely wrong');
        }

    }