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

        const MAX_CHARS_EXPERIAN_REFERENCE = 10;
        const MAX_CHARS_CLIENT_ACCOUNT_NUMBER = 5;
        const MAX_CHARS_CLIENT_BRANCH_NUMBER = 4;
        const MAX_CHARS_USER_IDENTITY = 40;
        const MAX_CHARS_TEST_DATABASE = 6;
        const MAX_CHARS_CLIENT_REFERENCE = 30;
        const MAX_CHARS_JOB_NUMBER = 36;
        const MAX_CHARS_INTERACTIVE_MODE = 11;

        const TEST_DATABASE_STATIC = 'S';
        const TEST_DATABASE_AGED = 'A';
        const TEST_DATABASE_NONE = 'N';
        const INTERACTIVE_MODE_INTERACTIVE = 'Interactive';
        const INTERACTIVE_MODE_CONFIRM = 'Confirm';
        const INTERACTIVE_MODE_ENHANCE = 'Enhance';
        const INTERACTIVE_MODE_ONESHOT = 'OneShot';

        // No constructor method is required as all sub-elements are optional.

        /**
         * Get and Set: Experian Reference
         *
         * @access public
         * @param string $experian_reference
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function experianReference($experian_reference = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ExperianReference'])
                    ? $this->struct['ExperianReference']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($experian_reference)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_EXPERIAN_REFERENCE . '}$/', $experian_reference)
            ) {
                $this->struct['ExperianReference'] = $experian_reference;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Client Account Number
         *
         * @access public
         * @param string $client_account_number
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientAccountNumber($client_account_number = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ClientAccountNumber'])
                    ? $this->struct['ClientAccountNumber']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($client_account_number)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_CLIENT_ACCOUNT_NUMBER . '}$/', $client_account_number)
            ) {
                $this->struct['ClientAccountNumber'] = $client_account_number;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Client Branch Number
         *
         * @access public
         * @param string $client_branch_number
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientBranchNumber($client_branch_number = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ClientBranchNumber'])
                    ? $this->struct['ClientBranchNumber']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($client_branch_number)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_CLIENT_BRANCH_NUMBER . '}$/', $client_branch_number)
            ) {
                $this->struct['ClientBranchNumber'] = $client_branch_number;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: User Identity
         *
         * @access public
         * @param string $user_identity
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function userIdentity($user_identity = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['UserIdentity'])
                    ? $this->struct['UserIdentity']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($user_identity)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_USER_IDENTITY . '}$/', $user_identity)
            ) {
                $this->struct['UserIdentity'] = $user_identity;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Test Database
         *
         * @access public
         * @param string $test_database
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function testDatabase($test_database = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['TestDatabase'])
                    ? $this->struct['TestDatabase']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($test_database)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_TEST_DATABASE . '}$/', $test_database)
            ) {
                $this->struct['TestDatabase'] = $test_database;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Reprocess Flag
         *
         * @access public
         * @param boolean $reprocess_flag
         * @throws \PHPerian\Exception
         * @return boolean | Control $this
         */
        public function reprocessFlag($reprocess_flag = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ReprocessFlag'])
                    ? $this->struct['ReprocessFlag'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($reprocess_flag)) {
                $this->struct['ReprocessFlag'] = $reprocess_flag ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Client Reference
         *
         * @access public
         * @param string $client_reference
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function clientReference($client_reference = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ClientRef'])
                    ? $this->struct['ClientRef']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($client_reference)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_CLIENT_REFERENCE . '}$/', $client_reference)
            ) {
                $this->struct['ClientRef'] = $client_reference;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Job Number
         *
         * @access public
         * @param string $job_number
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function jobNumber($job_number = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['JobNumber'])
                    ? $this->struct['JobNumber']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($job_number)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_JOB_NUMBER . '}$/', $job_number)
            ) {
                $this->struct['JobNumber'] = $job_number;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Interactive Mode (Parameter)
         *
         * @access public
         * @param string $interactive
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function interactiveMode($interactive = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['InteractiveMode'])
                    ? $this->struct['Parameters']['InteractiveMode']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($interactive)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_INTERACTIVE_MODE . '}$/', $interactive)
            ) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['InteractiveMode'] = $interactive;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Full FBL Required (Parameter)
         *
         * @access public
         * @param string $full_fbl
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function fullFBL($full_fbl = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['FullFBLRequired'])
                    ? $this->struct['Parameters']['FullFBLRequired'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($full_fbl)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['FullFBLRequired'] = $full_fbl ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Authenticate Plus Required (Parameter)
         *
         * @access public
         * @param string $authenticate_plus
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function authenticatePlus($authenticate_plus = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['AuthPlusRequired'])
                    ? $this->struct['Parameters']['AuthPlusRequired'] == 'E'
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($authenticate_plus)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['AuthPlusRequired'] = $authenticate_plus ? 'E' : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Detect Required (Parameter)
         *
         * @access public
         * @param string $detect
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function detect($detect = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['DetectRequired'])
                    ? $this->struct['Parameters']['DetectRequired'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($detect)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['DetectRequired'] = $detect ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Test Mode (Parameter)
         *
         * @access public
         * @param string $test_mode
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function testMode($test_mode = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['TestMode'])
                    ? $this->struct['Parameters']['TestMode'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($test_mode)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['TestMode'] = $test_mode ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Show Detect (Parameter)
         *
         * @access public
         * @param string $show_detect
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function showDetect($show_detect = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['ShowDetect'])
                    ? $this->struct['Parameters']['ShowDetect'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($show_detect)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['ShowDetect'] = $show_detect ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Show Authenticate (Parameter)
         *
         * @access public
         * @param string $show_authenticate
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function showAuthenticate($show_authenticate = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['ShowAuthenticate'])
                    ? $this->struct['Parameters']['ShowAuthenticate'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($show_authenticate)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['ShowAuthenticate'] = $show_authenticate ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Show Address (Parameter)
         *
         * @access public
         * @param string $show_address
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function showAddress($show_address = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['ShowAddress'])
                    ? $this->struct['Parameters']['ShowAddress'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($show_address)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['ShowAddress'] = $show_address ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Show Case History (Parameter)
         *
         * @access public
         * @param string $show_case_history
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function showCaseHistory($show_case_history = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['ShowCaseHistory'])
                    ? $this->struct['Parameters']['ShowCaseHistory'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($show_case_history)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['ShowCaseHistory'] = $show_case_history ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Show HHO (Parameter)
         *
         * @access public
         * @param string $show_HHO
         * @throws \PHPerian\Exception
         * @return string | Control $this
         */
        public function showHHO($show_hho = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Parameters']['ShowHHO'])
                    ? $this->struct['Parameters']['ShowHHO'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($show_hho)) {
                if(!isset($this->struct['Parameters']) || !is_array($this->struct['Parameters'])) {
                    $this->struct['Parameters'] = array();
                }
                $this->struct['Parameters']['ShowHHO'] = $show_hho ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

    }