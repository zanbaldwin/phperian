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

        const APPLICATION_TYPE_ENQUIRY                          = 'EQ';
        const APPLICATION_TYPE_AGENTS_CUSTOMER_MAIL_ORDER       = 'AC';
        const APPLICATION_TYPE_AGENCY_ACCOUNTS                  = 'AG';
        const APPLICATION_TYPE_ADDRESS_AUTHENTICITY             = 'AO';
        const APPLICATION_TYPE_BROKER                           = 'BR';
        const APPLICATION_TYPE_CURRENT_ACCOUNT                  = 'CA';
        const APPLICATION_TYPE_CREDIT_CARD                      = 'CC';
        const APPLICATION_TYPE_CHARGE_CARD                      = 'CH';
        const APPLICATION_TYPE_CREDIT_LIMIT                     = 'CL';
        const APPLICATION_TYPE_CUSTOMER_MANAGEMENT              = 'CM';
        const APPLICATION_TYPE_CARD_NOT_PRESENT                 = 'CN';
        const APPLICATION_TYPE_COLLECTIONS_STRATEGY             = 'CO';
        const APPLICATION_TYPE_CATALOGUE_REQUEST                = 'CR';
        const APPLICATION_TYPE_CREDIT_SALE                      = 'CS';
        const APPLICATION_TYPE_CREDIT_UNION                     = 'CU';
        const APPLICATION_TYPE_DIRECT_MAIL                      = 'DM';
        const APPLICATION_TYPE_DEBT_RECOVERY                    = 'DR';
        const APPLICATION_TYPE_EMPLOYMENT_CHECK                 = 'EM';
        const APPLICATION_TYPE_FURTHER_ADVANCE                  = 'FA';
        const APPLICATION_TYPE_FRAUD_BENEFIT                    = 'FB';
        const APPLICATION_TYPE_TRACING_FRAUD                    = 'FD';
        const APPLICATION_TYPE_FRAUD_GENERIC                    = 'FG';
        const APPLICATION_TYPE_FRAUD_INVESTIGATION              = 'FI';
        const APPLICATION_TYPE_FRAUD_PRESCRIPTION               = 'FP';
        const APPLICATION_TYPE_FRAUD_TAX                        = 'FT';
        const APPLICATION_TYPE_GOVERNMENT_SECTOR                = 'GB';
        const APPLICATION_TYPE_GENERIC_SEARCH                   = 'GF';
        const APPLICATION_TYPE_HOME_CREDIT                      = 'HC';
        const APPLICATION_TYPE_HIRE_PURCHASE                    = 'HP';
        const APPLICATION_TYPE_IDENTIFICATION_AGE               = 'IA';
        const APPLICATION_TYPE_IDENTIFICATION_FINANCIAL         = 'IF';
        const APPLICATION_TYPE_IDENTIFICATION_CHECK             = 'IG';
        const APPLICATION_TYPE_IDENTIFICATION_MONEY_LAUNDERING  = 'IM';
        const APPLICATION_TYPE_INSURANCE_PROVIDER               = 'IN';
        const APPLICATION_TYPE_INTERNET_PROVIDER                = 'IP';
        const APPLICATION_TYPE_IDENTIFICATION_TRANSACTION       = 'IT';
        const APPLICATION_TYPE_MORTGAGE_BUY_TO_LET              = 'MB';
        const APPLICATION_TYPE_MORTGAGE_FIRST                   = 'MG';
        const APPLICATION_TYPE_MORTGAGE_HIGH_LTV                = 'MH';
        const APPLICATION_TYPE_MORTGAGE_MULTIPLE                = 'MX';
        const APPLICATION_TYPE_UNSECURED_PERSONAL_LOAN          = 'PL';
        const APPLICATION_TYPE_CREDIT_CARD_QUOTATION            = 'QC';
        const APPLICATION_TYPE_QUOTATION_CHARGE_CARD            = 'QH';
        const APPLICATION_TYPE_QUOTATION_INSURANCE              = 'QI';
        const APPLICATION_TYPE_QUOTATION_PERSONAL_LOAN          = 'QL';
        const APPLICATION_TYPE_QUOTATION_MORTGAGE               = 'QM';
        const APPLICATION_TYPE_QUOTATION_PROVIDER               = 'QP';
        const APPLICATION_TYPE_QUOTATION_STORE_CARD             = 'QS';
        const APPLICATION_TYPE_QUOTATION_TELCO                  = 'QT';
        const APPLICATION_TYPE_QUOTATION_UTILITY                = 'QU';
        const APPLICATION_TYPE_QUOTATION_MULTIPLE               = 'QX';
        const APPLICATION_TYPE_RENTAL_AGREEMENT                 = 'RA';
        const APPLICATION_TYPE_REVOLVING_CREDIT                 = 'RC';
        const APPLICATION_TYPE_REPROCESS                        = 'RE';
        const APPLICATION_TYPE_DEBT_RECOVERY_SUNDRY             = 'RS';
        const APPLICATION_TYPE_DEBT_RECOVERY_TAX                = 'RT';
        const APPLICATION_TYPE_STORE_CARD                       = 'SC';
        const APPLICATION_TYPE_SECURED_LOAN                     = 'SL';
        const APPLICATION_TYPE_STUDENT_LOAN                     = 'ST';
        const APPLICATION_TYPE_TRACING_BENEFIT                  = 'TB';
        const APPLICATION_TYPE_TENANT_RENTAL                    = 'TC';
        const APPLICATION_TYPE_FIXED_LINE_AGREEMENT             = 'TF';
        const APPLICATION_TYPE_MOBILE_PHONE                     = 'TM';
        const APPLICATION_TYPE_TRACING_SUNDRY                   = 'TS';
        const APPLICATION_TYPE_TRACING_TAX                      = 'TT';
        const APPLICATION_TYPE_FINANCIAL_PARTNER_ENQUIRY        = 'UA';
        const APPLICATION_TYPE_CONSUMER_CREDIT_REPORT           = 'UC';
        const APPLICATION_TYPE_UNREGISTERED_ENQUIRY             = 'UE';
        const APPLICATION_TYPE_UTILITY                          = 'UT';
        const APPLICATION_TYPE_VERIFICATION_RESIDENCY           = 'VG';
        const APPLICATION_TYPE_VERIFICATION_HOMELESS            = 'VH';

        const APPLICATION_CHANNEL_FAX                           = 'FA';
        const APPLICATION_CHANNEL_FACE_TO_FACE                  = 'FF';
        const APPLICATION_CHANNEL_INTERMEDIARY                  = 'IN';
        const APPLICATION_CHANNEL_INTERNET                      = 'IT';
        const APPLICATION_CHANNEL_POST                          = 'PO';
        const APPLICATION_CHANNEL_TELEPHONE_INBOUND             = 'TI';
        const APPLICATION_CHANNEL_TELEPHONE_OUTBOUND            = 'TO';

        const MAX_CHARS_AMOUNT                                  = 7;
        const MAX_CHARS_TERM                                    = 3;
        const MAX_CHARS_LIMIT_APPLIED                           = 5;
        const MAX_CHARS_LIMIT_GIVEN                             = 5;

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
         * @param integer $amount
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function amount($amount = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Amount'])
                    ? (int) $this->struct['Amount']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            // Because this is a numerical input, we also accept integer data types; convert it to string though.
            if(is_int($amount)) {
                $amount = (string) $amount;
            }
            if(
                is_string($amount)
             && preg_match('/^' . parent::PCRE_NUMERIC . '{1,' . self::MAX_CHARS_AMOUNT . '}$/', $amount)
            ) {
                $this->struct['Amount'] = $amount;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

        /**
         * Get and Set: Term
         *
         * @access public
         * @param integer $term
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function term($term = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Term'])
                    ? (int) $this->struct['Term']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            // Because this is a numerical input, we also accept integer data types; convert it to string though.
            if(is_int($term)) {
                $term = (string) $term;
            }
            if(
                is_string($term)
             && preg_match('/^' . parent::PCRE_NUMERIC . '{1,' . self::MAX_CHARS_TERM . '}$/', $term)
            ) {
                $this->struct['Term'] = $term;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

        /**
         * Get and Set: Limit Applied
         *
         * @access public
         * @param integer $limit
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function limitApplied($limit = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LimitApplied'])
                    ? (int) $this->struct['LimitApplied']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            // Because this is a numerical input, we also accept integer data types; convert it to string though.
            if(is_int($term)) {
                $term = (string) $term;
            }
            if(
                is_string($term)
             && preg_match('/^' . parent::PCRE_NUMERIC . '{1,' . self::MAX_CHARS_LIMIT_APPLIED . '}$/', $term)
            ) {
                $this->struct['LimitApplied'] = $term;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

        /**
         * Get and Set: Limit Given
         *
         * @access public
         * @param integer $limit
         * @throws \PHPerian\Exception
         * @return integer | Application $this
         */
        public function limitGiven($limit = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LimitGiven'])
                    ? (int) $this->struct['LimitGiven']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            // Because this is a numerical input, we also accept integer data types; convert it to string though.
            if(is_int($term)) {
                $term = (string) $term;
            }
            if(
                is_string($term)
             && preg_match('/^' . parent::PCRE_NUMERIC . '{1,' . self::MAX_CHARS_LIMIT_GIVEN . '}$/', $term)
            ) {
                $this->struct['LimitGiven'] = $term;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

        /**
         * Get and Set: Application Channel
         *
         * @access public
         * @param string $channel
         * @throws \PHPerian\Exception
         * @return string | Application $this
         */
        public function applicationChannel($channel = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['ApplicationChannel'])
                    ? $this->struct['ApplicationChannel']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($channel)
             && preg_match('/^' . parent::PCRE_ALPHA . '{2}$/', $channel)
            ) {
                $this->struct['ApplicationChannel'] = $channel;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
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