<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Application XML block for request SOAP requests to Experian's
     * Web Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/ApplicationData.php
     */
    class ApplicationData extends Partial
    {

        const APPLICATIONDATA_NOT_ASKED = 'Q';
        const APPLICATIONDATA_NOT_GIVEN = 'Z';

        public function __construct(\PHPerian\Request\Partial\Applicant $applicant)
        {
            $this->struct['ApplicantIdentifier'] = $applicant->autoIncrement();
            parent::__construct();
        }

        const APPLICATIONDATA_MARTIAL_STATUS_MARRIED = 'M';
        const APPLICATIONDATA_MARTIAL_STATUS_SINGLE = 'S';
        const APPLICATIONDATA_MARTIAL_STATUS_DIVORCED = 'D';
        const APPLICATIONDATA_MARTIAL_STATUS_WIDOWED = 'W';
        const APPLICATIONDATA_MARTIAL_STATUS_TO_BE_MARRIED = 'E';
        const APPLICATIONDATA_MARTIAL_STATUS_COHABITING = 'C';
        const APPLICATIONDATA_MARTIAL_STATUS_SEPARATED = 'X';
        const APPLICATIONDATA_MARTIAL_STATUS_OTHER = 'O';

        /**
         * Get and Set: Marital Status
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function maritalStatus()
        {
            return $this->validateSet(
                $this->struct['Personal']['MaritalStatus'],
                func_get_args(),
                array('M', 'S', 'D', 'W', 'E', 'C', 'X', 'O', 'Q', 'Z')
            );
        }

        const APPLICATIONDATA_TELEPHONE_EXDIRECTORY = 'X';
        const APPLICATIONDATA_TELEPHONE_NOT_GIVEN = 'N';

        /**
         * Get and Set: Home Telephone
         *
         * @access public
         * @param string
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function homeTelephone()
        {
            return $this->validatePhoneNumber($this->struct['Personal']['HomeTelephone'], func_get_args());
        }

        /**
         * Get and Set: Mobile Telephone (Number)
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function mobileTelephoneNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Personal']['MobileTelNumber'], func_get_args(), 16);
        }

        const APPLICATIONDATA_DEPENDANTS_NOT_GIVEN = '8';
        const APPLICATIONDATA_DEPENDANTS_NOT_ASKED = '9';

        /**
         * Get and Set: Dependants
         *
         * @access public
         * @param string|integer
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function dependants()
        {
            $arguments = func_get_args();
            if(isset($arguments[0])) {
                switch(true) {
                    case is_int($arguments[0]) && $arguments[0] > 7:
                        $arguments[0] = 7;
                        break;
                    case $arguments[0] == 'Z':
                        $arguments[0] = 8;
                        break;
                    case $arguments[0] == 'Q':
                        $arguments[0] = 9;
                        break;
                }
            }
            return $this->validateNumeric($this->struct['Personal']['Dependants'], $arguments, 1);
        }

        const APPLICATIONDATA_RESIDENTIAL_OWNER = 'O';
        const APPLICATIONDATA_RESIDENTIAL_LIVING_WITH_PARENTS = 'P';
        const APPLICATIONDATA_RESIDENTIAL_TENANT_FURNISHED = 'F';
        const APPLICATIONDATA_RESIDENTIAL_TENANT_UNFURNISHED = 'U';
        const APPLICATIONDATA_RESIDENTIAL_COUNCIL_TENANT = 'C';
        const APPLICATIONDATA_RESIDENTIAL_OTHER_TENANT = 'T';
        const APPLICATIONDATA_RESIDENTIAL_JOINT_OWNER = 'J';
        const APPLICATIONDATA_RESIDENTIAL_OTHER = 'X';

        /**
         * Get and Set: Residential Status
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function residentialStatus()
        {
            return $this->validateSet(
                $this->struct['Personal']['ResidentialStatus'],
                func_get_args(),
                array('O', 'P', 'F', 'U', 'C', 'T', 'J', 'X', 'Q', 'Z')
            );
        }

        /**
         * Get and Set: Email Address
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function emailAddress()
        {
            $arguments = func_get_args();
            if(isset($arguments[0]) && is_string($arguments[0]) && !filter_var($arguments[0], FILTER_VALIDATE_EMAIL)) {
                $arguments[0] = false;
            }
            return $this->validateAlphaNumericExtra($this->struct['Personal']['EmailAddress'], $arguments, 60);
        }

        /**
         * Get and Set: National Insurance Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function nationalInsuranceNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Personal']['NatInsuranceNum'], func_get_args(), 16);
        }

        /**
         * Get and Set: Passport Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function passportNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Personal']['PassportNumber'], func_get_args(), 16);
        }

        const APPLICATIONDATA_COUNTRY_OF_BIRTH_ENGLAND = 'E';
        const APPLICATIONDATA_COUNTRY_OF_BIRTH_WALES = 'W';
        const APPLICATIONDATA_COUNTRY_OF_BIRTH_SCOTLAND = 'S';
        const APPLICATIONDATA_COUNTRY_OF_BIRTH_NORTHERN_IRELAND = 'I';
        const APPLICATIONDATA_COUNTRY_OF_BIRTH_OTHER = 'O';

        /**
         * Get and Set: Country of Birth
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function countryOfBirth()
        {
            return $this->validateSet(
                $this->struct['Personal']['CountryOfBirth'],
                func_get_args(),
                array('E','W','S','I','O')
            );
        }

        /**
         * Get and Set: Time With Bank
         *
         * @access public
         * @param integer|string
         * @param integer
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function timeWithBank()
        {
            return $this->validateTimeRange($this->struct['Bank']['TimeWithBank'], func_get_args());
        }

        /**
         * Get and Set: Bank Sort Code
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function bankSortCode()
        {
            return $this->validateAlphaNumeric($this->struct['Bank']['BankSortCode'], func_get_args(), 15);
        }

        /**
         * Get and Set: Bank Account Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function bankAccountNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Bank']['BankAccountNumber'], func_get_args(), 16);
        }

        /**
         * Get and Set: Current Account Held?
         *
         * @access public
         * @param boolean|string
         * @throws \PHPerian\Exception
         * @return boolean | string | ApplicationData $this
         */
        public function currentAccountHeld()
        {
            $arguments = func_get_args();
            if(isset($arguments[0])) {
                switch(true) {
                    case $arguments[0] === true:
                        $arguments[0] = 'Y';
                        break;
                    case $arguments[0] === false:
                        $arguments[0] = 'N';
                        break;
                }
            }
            $return = $this->validateSet($this->struct['Bank']['CurrentAccountHeld'], $arguments, array('Y', 'N', 'Q', 'Z'));
            if(is_string($return)) {
                switch($return) {
                    case 'Y':
                        $return = true;
                        break;
                    case 'N':
                        $return = false;
                        break;
                }
            }
            return $return;
        }

        /**
         * Get and Set: Check Card Held?
         *
         * @access public
         * @param boolean|string
         * @throws \PHPerian\Exception
         * @return boolean | string | ApplicationData $this
         */
        public function checkCardHeld()
        {
            $arguments = func_get_args();
            if(isset($arguments[0])) {
                switch(true) {
                    case $arguments[0] === true:
                        $arguments[0] = 'Y';
                        break;
                    case $arguments[0] === false:
                        $arguments[0] = 'N';
                        break;
                }
            }
            $return = $this->validateSet($this->struct['Bank']['CheckCardHeld'], $arguments, array('Y', 'N', 'Q', 'Z'));
            if(is_string($return)) {
                switch($return) {
                    case 'Y':
                        $return = true;
                        break;
                    case 'N':
                        $return = false;
                        break;
                }
            }
            return $return;
        }

        /**
         * Get and Set: Gross Annual Income
         *
         * @access public
         * @param integer
         * @throws \PHPerian\Exception
         * @return integer | ApplicationData $this
         */
        public function grossAnnualIncome()
        {
            return $this->validateNumeric($this->struct['Financial']['GrossAnnualIncome'], func_get_args(), 7);
        }

        /**
         * Get and Set: Work Telephone (Area Code)
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function workTelephoneArea()
        {
            return $this->validateAlphaNumeric($this->struct['Employment']['WorkTelephone']['STDCode'], func_get_args(), 6);
        }

        /**
         * Get and Set: Work Telephone (Number)
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function workTelephoneNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Employment']['WorkTelephone']['LocalNumber'], func_get_args(), 10);
        }

        /**
         * Get and Set: Time With Employer
         *
         * @access public
         * @param integer|string
         * @param integer
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function timeWithEmployer()
        {
            return $this->validateTimeRange($this->struct['Employment']['TimeWithEmployer'], func_get_args());
        }

        /**
         * Get and Set: Employer Name
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function employerName()
        {
            return $this->validateAlphaNumericExtra($this->struct['Employment']['EmployerName'], func_get_args(), 30);
        }

        const APPLICATIONDATA_OCCUPATION_MANAGEMENT = 'T';
        const APPLICATIONDATA_OCCUPATION_PROFESSIONAL = 'M';
        const APPLICATIONDATA_OCCUPATION_SUPERVISOR = 'O';
        const APPLICATIONDATA_OCCUPATION_SKILLED = 'S';
        const APPLICATIONDATA_OCCUPATION_SEMI_SKILLED = 'P';
        const APPLICATIONDATA_OCCUPATION_UNSKILLED = 'N';
        const APPLICATIONDATA_OCCUPATION_JUNIOR = 'J';
        const APPLICATIONDATA_OCCUPATION_OTHER = 'X';
        const APPLICATIONDATA_OCCUPATION_UNEMPLOYED = 'U';

        /**
         * Get and Set: Occupation Status
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function occupationStatus()
        {
            return $this->validateSet(
                $this->struct['Employment']['OccupationStatus'],
                func_get_args(),
                array('T', 'M', 'O', 'S', 'P', 'N', 'J', 'X', 'U', 'Z')
            );
        }

        const APPLICATIONDATA_EMPLOYMENT_EMPLOYED = 'E';
        const APPLICATIONDATA_EMPLOYMENT_SELF_EMPLOYED_PROFESSIONAL = 'P';
        const APPLICATIONDATA_EMPLOYMENT_SELF_EMPLOYED_NON_PROFESSIONAL = 'N';
        const APPLICATIONDATA_EMPLOYMENT_STUDENT = 'S';
        const APPLICATIONDATA_EMPLOYMENT_HOUSEWIFE = 'H';
        const APPLICATIONDATA_EMPLOYMENT_RETIRED = 'R';
        const APPLICATIONDATA_EMPLOYMENT_PART_TIME = 'L';
        const APPLICATIONDATA_EMPLOYMENT_TEMPORARY_EMPLOYMENT = 'T';
        const APPLICATIONDATA_EMPLOYMENT_UNEMPLOYED = 'U';
        const APPLICATIONDATA_EMPLOYMENT_OTHER = 'X';

        /**
         * Get and Set: Employment Status
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function employmentStatus()
        {
            return $this->validateSet(
                $this->struct['Employment']['EmploymentStatus'],
                func_get_args(),
                array('E', 'P', 'N', 'S', 'H', 'R', 'L', 'T', 'U', 'X', 'Z')
            );
        }

        /**
         * Get and Set: Driving License Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function drivingLicenseNumber()
        {
            return $this->validateAlphaNumeric($this->struct['Vehicle']['DrivingLicenceNum'], func_get_args(), 16);
        }

        /**
         * Get and Set: Vehicle Registration
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function vehicleRegistration()
        {
            return $this->validateAlphaNumeric($this->struct['Vehicle']['VehicleRegistration'], func_get_args(), 8);
        }

        /**
         * Get and Set: Place of Birth
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function placeOfBirth()
        {
            return $this->validateAlphaNumeric($this->struct['Security']['PlaceOfBirth'], func_get_args(), 80);
        }

        /**
         * Get and Set: Mother's Maiden Name
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function mothersMaidenName()
        {
            return $this->validateAlphaNumeric($this->struct['Security']['MothersMaidenName'], func_get_args(), 80);
        }

        /**
         * Get and Set: Birth Surname
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ApplicationData $this
         */
        public function birthSurname()
        {
            return $this->validateAlphaNumericExtra($this->struct['Security']['BirthSurname'], func_get_args(), 30);
        }

    }