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
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Application.php
     */
    class Application extends Partial
    {

        /**
         * Constructor Method
         *
         * @access public
         * @param string $application_type
         * @throws \PHPerian\Exception
         * @return void
         */
        public function __construct($application_type)
        {
            // Make sure that the application type is a non-empty string, and matches the correct validation criteria.
            if(!is_string($application_type) || !preg_match('/^' . parent::PCRE_ALPHA . '{2}$/', $application_type)) {
                // IF the application type does not validate, then throw an exception regardless of whether verbose or
                // silent mode is on; the class cannot be used.
                throw new Exception();
            }
            $this->struct['ApplicationType'] = strtoupper($application_type);
            parent::__construct();
        }

        /**
         * Get and Set: Amount
         *
         * @access public
         * @param integer
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function amount()
        {
            return $this->validateNumeric($this->struct['Amount'], func_get_args(), 7);
        }

        /**
         * Get and Set: Term
         *
         * @access public
         * @param integer
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function term()
        {
            return $this->validateNumeric($this->struct['Term'], func_get_args(), 3);
        }

        /**
         * Get and Set: Limit Applied
         *
         * @access public
         * @param integer
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function limitApplied()
        {
            return $this->validateNumeric($this->struct['LimitApplied'], func_get_args(), 5);
        }

        /**
         * Get and Set: Limit Given
         *
         * @access public
         * @param integer
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function limitGiven()
        {
            return $this->validateNumeric($this->struct['LimitGiven'], func_get_args(), 5);
        }

        /**
         * Get and Set: Application Channel
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | Application $this
         */
        public function applicationChannel()
        {
            return $this->validateAlpha($this->struct['ApplicationChannel'], func_get_args(), 2, true);
        }

        /**
         * Get and Set: Manual Authentication
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Application $this
         */
        public function manualAuthentication()
        {
            return $this->validateBoolean($this->struct['ManualAuthReq'], func_get_args());
        }
        
        /**
         * Get and Set: Search Consent
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | Application $this
         */
        public function searchConsent()
        {
            return $this->validateBoolean($this->struct['SearchConsent'], func_get_args());
        }

    }