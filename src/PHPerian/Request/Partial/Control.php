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

        // No constructor method is required as all sub-elements are optional.

        // Root methods.
        public function experianReference($experian_reference = null) {}
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