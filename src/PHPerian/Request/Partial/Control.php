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

        public function clientAccountNumber($client_account_number = null) {}
        public function clientBranchNumber($client_branch_number = null) {}
        public function userIdentity($identity = null) {}
        public function testDatabase($test_database = null) {}
        public function reprocessFlag($reprocess_flag = null) {}
        public function clientReference($client_reference = null) {}
        public function jobNumber($job_number = null) {}

        // Parameter methods.
        public function interactiveMode($interactive = null) {}
        public function fullFBL($full_fbl = null) {}
        public function authenticatePlus($authenticate_plus = null) {}
        public function detect($detect = null) {}
        public function testMode($test_mode) {}
        public function showDetect($show_detect = null) {}
        public function showAuthenticate($show_authenticate = null) {}
        public function showAddress($show_address = null) {}
        public function showCaseHistory($show_case_history = null) {}
        public function showHHO($show_hho = null) {}

    }