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