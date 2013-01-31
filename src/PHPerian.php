<?php

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * This class provides static methods for loading and autoloading library
     * classes during testing. The most common use for this class is to simply
     * call `\PHPerian\TestLoader::registerAutoloader()` before using any library
     * components.
     * Please do not use this class directly. If you are not autoloading from
     * Composer, you should include the file `../PHPerian.php`.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian.php
     */
    class PHPerian
    {

        // All the different types of application that Experian accept.
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

        // Varying channels in which the application is made.
        const APPLICATION_CHANNEL_FAX                           = 'FA';
        const APPLICATION_CHANNEL_FACE_TO_FACE                  = 'FF';
        const APPLICATION_CHANNEL_INTERMEDIARY                  = 'IN';
        const APPLICATION_CHANNEL_INTERNET                      = 'IT';
        const APPLICATION_CHANNEL_POST                          = 'PO';
        const APPLICATION_CHANNEL_TELEPHONE_INBOUND             = 'TI';
        const APPLICATION_CHANNEL_TELEPHONE_OUTBOUND            = 'TO';

        const TEST_DATABASE_STATIC          = 'S';
        const TEST_DATABASE_AGED            = 'A';
        const TEST_DATABASE_NONE            = 'N';
        const INTERACTIVE_MODE_INTERACTIVE  = 'Interactive';
        const INTERACTIVE_MODE_CONFIRM      = 'Confirm';
        const INTERACTIVE_MODE_ENHANCE      = 'Enhance';
        const INTERACTIVE_MODE_ONESHOT      = 'OneShot';
        const COUNTRY_UK                    = 'UK';
        const COUNTRY_IE                    = 'IE';
        const LOCATION_UK                   = 'UKLocation';
        const LOCATION_BFPO                 = 'BFPOLocation';
        const LOCATION_OVERSEAS             = 'OverseasLocation';
        const LOCATION_CURRENT              = '01';
        const LOCATION_CORRESPONDENCE       = 'C_';
        const LOCATION_EMPLOYMENT           = 'E_';
        const LOCATION_DELIVERY             = 'D_';
        const LOCATION_OTHER                = 'O_';

        /**
         * Load A Library Class
         *
         * Perform checks to make sure only local library classes are loaded,
         * and the class file exists within the library path.
         *
         * @static
         * @access public
         * @param string $class
         * @return void
         */
        public static function load($class)
        {
            if(substr($class, 0, 9) !== 'PHPerian\\') {
                return;
            }
            $library_root = realpath(__DIR__ . DIRECTORY_SEPARATOR);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $file = realpath($library_root . DIRECTORY_SEPARATOR . $file);
            if(substr($file, 0, strlen($library_root)) == $library_root) {
                if(is_readable($file)) {
                    include $file;
                }
            }
        }

        /**
         * Register Autoloader
         *
         * Register an autoloader for Nosco's Experian library.
         *
         * @static
         * @access public
         * @return boolean
         */
        public static function registerAutoloader()
        {
            return spl_autoload_register(array('PHPerian', 'load'));
        }

    }

    // Add the PHPerian autoloader method to the PHP's SPL Autoloader.
    PHPerian::registerAutoloader();