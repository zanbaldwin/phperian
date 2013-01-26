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

        const APPLICATION_TYPE_ENQUIRY = 'EQ';
        const APPLICATION_TYPE_ Agents Customer Mail Order = 'AC';
        const APPLICATION_TYPE_AGENCY_ACCOUNTS = 'AG';
        const APPLICATION_TYPE_ADDRESS_AUTHENTICITY = 'AO';
        const APPLICATION_TYPE_BROKER = 'BR';
        const APPLICATION_TYPE_CURRENT_ACCOUNT = 'CA';
        const APPLICATION_TYPE_CREDIT_CARD = 'CC';
        const APPLICATION_TYPE_CHARGE_CARD = 'CH';
        const APPLICATION_TYPE_CREDIT_LIMIT = 'CL';
        const APPLICATION_TYPE_CUSTOMER_MANAGEMENT = 'CM';
        const APPLICATION_TYPE_CARD_NOT_PRESENT = 'CN';
        const APPLICATION_TYPE_COLLECTIONS_STRATEGY = 'CO';
        const APPLICATION_TYPE_CATALOGUE_REQUEST = 'CR';
        const APPLICATION_TYPE_CREDIT_SALE = 'CS';
        const APPLICATION_TYPE_CREDIT_UNION = 'CU';
        const APPLICATION_TYPE_DIRECT_MAIL = 'DM';
        const APPLICATION_TYPE_DEBT_RECOVERY = 'DR';
        const APPLICATION_TYPE_EMPLOYMENT_CHECK = 'EM';
        const APPLICATION_TYPE_FURTHER_ADVANCE = 'FA';
        const APPLICATION_TYPE_FRAUD_BENEFIT = 'FB';
        const APPLICATION_TYPE_TRACING_FRAUD = 'FD';
        const APPLICATION_TYPE_FRAUD_GENERIC = 'FG';
        const APPLICATION_TYPE_FRAUD_INVESTIGATION = 'FI';
        const APPLICATION_TYPE_FRAUD_PRESCRIPTION = 'FP';
        const APPLICATION_TYPE_FRAUD_TAX = 'FT';
        const APPLICATION_TYPE_GOVERNMENT_SECTOR = 'GB';
        const APPLICATION_TYPE_GENERIC_SEARCH = 'GF';
        const APPLICATION_TYPE_HOME_CREDIT = 'HC';
        const APPLICATION_TYPE_HIRE_PURCHASE = 'HP';
        const APPLICATION_TYPE_IDENTIFICATION_AGE = 'IA';
        const APPLICATION_TYPE_IDENTIFICATION_FINANCIAL = 'IF';
        const APPLICATION_TYPE_IDENTIFICATION_CHECK = 'IG';
        const APPLICATION_TYPE_IDENTIFICATION_MONEY_LAUNDERING = 'IM';
        const APPLICATION_TYPE_INSURANCE_PROVIDER = 'IN';
        const APPLICATION_TYPE_INTERNET_PROVIDER = 'IP';
        const APPLICATION_TYPE_IDENTIFICATION_TRANSACTION = 'IT';
        const APPLICATION_TYPE_MORTGAGE_BUY_TO_LET = 'MB';
        const APPLICATION_TYPE_MORTGAGE_FIRST = 'MG';
        const APPLICATION_TYPE_MORTGAGE_HIGH_LTV = 'MH';
        const APPLICATION_TYPE_MORTGAGE_MULTIPLE = 'MX';
        const APPLICATION_TYPE_UNSECURED_PERSONAL_LOAN = 'PL';
        const APPLICATION_TYPE_CREDIT_CARD_QUOTATION = 'QC';
        const APPLICATION_TYPE_QUOTATION_CHARGE_CARD = 'QH';
        const APPLICATION_TYPE_QUOTATION_INSURANCE = 'QI';
        const APPLICATION_TYPE_QUOTATION_PERSONAL_LOAN = 'QL';
        const APPLICATION_TYPE_QUOTATION_MORTGAGE = 'QM';
        const APPLICATION_TYPE_QUOTATION_PROVIDER = 'QP';
        const APPLICATION_TYPE_QUOTATION_STORE_CARD = 'QS';
        const APPLICATION_TYPE_QUOTATION_TELCO = 'QT';
        const APPLICATION_TYPE_QUOTATION_UTILITY = 'QU';
        const APPLICATION_TYPE_QUOTATION_MULTIPLE = 'QX';
        const APPLICATION_TYPE_RENTAL_AGREEMENT = 'RA';
        const APPLICATION_TYPE_REVOLVING_CREDIT = 'RC';
        const APPLICATION_TYPE_REPROCESS = 'RE';
        const APPLICATION_TYPE_DEBT_RECOVERY_SUNDRY = 'RS';
        const APPLICATION_TYPE_DEBT_RECOVERY_TAX = 'RT';
        const APPLICATION_TYPE_STORE_CARD = 'SC';
        const APPLICATION_TYPE_SECURED_LOAN = 'SL';
        const APPLICATION_TYPE_STUDENT_LOAN = 'ST';
        const APPLICATION_TYPE_TRACING_BENEFIT = 'TB';
        const APPLICATION_TYPE_TENANT_RENTAL = 'TC';
        const APPLICATION_TYPE_FIXED_LINE_AGREEMENT = 'TF';
        const APPLICATION_TYPE_MOBILE_PHONE = 'TM';
        const APPLICATION_TYPE_TRACING_SUNDRY = 'TS';
        const APPLICATION_TYPE_TRACING_TAX = 'TT';
        const APPLICATION_TYPE_FINANCIAL_PARTNER_ENQUIRY = 'UA';
        const APPLICATION_TYPE_CONSUMER_CREDIT_REPORT = 'UC';
        const APPLICATION_TYPE_UNREGISTERED_ENQUIRY = 'UE';
        const APPLICATION_TYPE_UTILITY = 'UT';
        const APPLICATION_TYPE_VERIFICATION_RESIDENCY = 'VG';
        const APPLICATION_TYPE_VERIFICATION_HOMELESS = 'VH';

        public function type($type = null) {}
        public function amount($amount = null) {}
        public function term($term = null) {}
        public function purpose($purpose = null) {}
        public function propertyValue($value = null) {}
        public function mortgageType($type = null) {}
        public function monthlyAmount($amount = null) {}
        public function limitApplied($limit = null) {}
        public function limitGiven($limit = null) {}
        public function applicationChannel($channel = null) {}
        public function authenticationType($type = null) {}
        public function manualAuthentication($manual = null) {}
        public function searchConsent($consent = null) {}

    }