<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Association XML block for request SOAP requests to Experian's
     * Web Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Association.php
     */
    class Association extends Partial
    {

        /**
         * Constructor Method
         *
         * @access public
         * @param \PHPerian\Request\Partial\Applicant $appicant
         * @return void
         */
        public function __construct(\PHPerian\Request\Partial\Applicant $applicant)
        {
            $this->struct['ApplicantLinkTo'] = $applicant->autoIncrement();
            parent::__construct();
        }

        /**
         * Get and Set: Title
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function title()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Title'], func_get_args(), 10);
        }

        /**
         * Get and Set: Forename
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function forename()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Forename'], func_get_args(), 15);
        }

        /**
         * Get and Set: Middle Name
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function middleName()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['MiddleName'], func_get_args(), 15);
        }

        /**
         * Get and Set: Surname
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function surname()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Surname'], func_get_args(), 30);
        }

        /**
         * Get and Set: Suffix
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function suffix()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Suffix'], func_get_args(), 10);
        }

        /**
         * Get and Set: Gender
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function gender()
        {
            return $this->validateSet($this->struct['Gender'], func_get_args(), array('M', 'F'));
        }

        /**
         * Set: Gender (Male)
         *
         * @access public
         * @throws \PHPerian\Exception
         * @return Association $this
         */
        public function setGenderMale()
        {
            return $this->gender('M');
        }

        /**
         * Set: Gender (Female)
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function setGenderFemale()
        {
            return $this->gender('F');
        }

        /**
         * Get and Set: Date of Birth
         *
         * @access public
         * @param integer
         * @param integer
         * @param integer
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function dateOfBirth()
        {
            return $this->validateDate($this->struct['DateOfBirth'], func_get_args());
        }

        /**
         * Get and Set: Associated Date (From)
         *
         * @access public
         * @param integer
         * @param integer
         * @param integer
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function associatedDateFrom()
        {
            return $this->validateDate($this->struct['AssociatedDateFrom'], func_get_args());
        }

        /**
         * Get and Set: Associated Date (To)
         *
         * @access public
         * @param integer
         * @param integer
         * @param integer
         * @throws \PHPerian\Exception
         * @return string | Association $this
         */
        public function associatedDateTo()
        {
            return $this->validateDate($this->struct['AssociatedDateTo'], func_get_args());
        }

    }