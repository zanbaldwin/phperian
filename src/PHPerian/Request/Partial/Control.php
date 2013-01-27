<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Control XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Control.php
     */
    class Control extends Partial
    {

        const MAX_CHARS_CLIENT_REFERENCE = 30;
        const MAX_CHARS_JOB_NUMBER = 36;
        const MAX_CHARS_INTERACTIVE_MODE = 11;

        // No constructor method is required as all sub-elements are optional.

        /**
         * Get and Set: Experian Reference
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function experianReference()
        {
            return $this->validateAlphaNumeric($this->struct['ExperianReference'], func_get_args(), 10);
        }

        /**
         * Get and Set: Client Account Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientAccountNumber()
        {
            return $this->validateAlphaNumeric($this->struct['ClientAccountNumber'], func_get_args(), 5);
        }

        /**
         * Get and Set: Client Branch Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientBranchNumber()
        {
            return $this->validateAlphaNumeric($this->struct['ClientBranchNumber'], func_get_args(), 4);
        }

        /**
         * Get and Set: User Identity
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function userIdentity()
        {
            return $this->validateAlphaNumeric($this->struct['UserIdentity'], func_get_args(), 40);
        }

        /**
         * Get and Set: Test Database
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function testDatabase()
        {
            return $this->validateAlphaNumeric($this->struct['TestDatabase'], func_get_args(), 6);
        }

        /**
         * Get and Set: Reprocess Flag
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function reprocessFlag()
        {
            return $this->validateBoolean($this->struct['ReprocessFlag'], func_get_args());
        }

        /**
         * Get and Set: Client Reference
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientReference()
        {
            return $this->validateAlphaNumeric($this->struct['ClientRef'], func_get_args(), 30);
        }

        /**
         * Get and Set: Job Number
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function jobNumber()
        {
            return $this->validateAlphaNumeric($this->struct['JobNumber'], func_get_args(), 36);
        }

        /**
         * Get and Set: Interactive Mode (Parameter)
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function interactiveMode()
        {
            return $this->validateSet(
                $this->struct['Parameters']['InteractiveMode'],
                func_get_args(),
                array(
                    'Interactive',
                    'Confirm',
                    'Enhance',
                    'OneShot',
                )
            );
        }

        /**
         * Get and Set: Full FBL Required (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function fullFBL()
        {
            return $this->validateBoolean($this->struct['Parameters']['FullFBLRequired'], func_get_args());
        }

        /**
         * Get and Set: Authenticate Plus Required (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function authenticatePlus()
        {
            return $this->validateBoolean($this->struct['Parameters']['AuthPlusRequired'], func_get_args(), 'E', '');
        }

        /**
         * Get and Set: Detect Required (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function detect()
        {
            return $this->validateBoolean($this->struct['Parameters']['DetectRequired'], func_get_args());
        }

        /**
         * Get and Set: Test Mode (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function testMode()
        {
            return $this->validateBoolean($this->struct['Parameters']['TestMode'], func_get_args());
        }

        /**
         * Get and Set: Show Detect (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function showDetect()
        {
            return $this->validateBoolean($this->struct['Parameters']['ShowDetect'], func_get_args());
        }

        /**
         * Get and Set: Show Authenticate (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function showAuthenticate()
        {
            return $this->validateBoolean($this->struct['Parameters']['ShowAuthenticate'], func_get_args());
        }

        /**
         * Get and Set: Show Address (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function showAddress()
        {
            return $this->validateBoolean($this->struct['Parameters']['ShowAddress'], func_get_args());
        }

        /**
         * Get and Set: Show Case History (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function showCaseHistory()
        {
            return $this->validateBoolean($this->struct['Parameters']['ShowCaseHistory'], func_get_args());
        }

        /**
         * Get and Set: Show HHO (Parameter)
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function showHHO()
        {
            return $this->validateBoolean($this->struct['Parameters']['ShowHHO'], func_get_args());
        }

    }