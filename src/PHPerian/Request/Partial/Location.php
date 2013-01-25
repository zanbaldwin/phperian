<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Location XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Location.php
     */
    class Location extends Partial
    {

        const MAX_CHARS_FLAT = 30;

        /**
         * @var array $struct
         * Define a class member to hold the Applicant XML structure.
         */
        protected $struct = array(
            'LocationIdentifier' => -1,
        );

        /**
         * @var boolean $uk
         * An internal flag to determine whether this location is a UK address, or BFPO/Overseas address.
         */
        protected $uk = null;

        /**
         * Constructor Method
         *
         * @access public
         * @param boolean $uk
         * @return void
         */
        public function __construct($uk)
        {
            // If a non-boolean value is passed and verbose mode is on, throw an exception. 
            if(!is_bool($uk) && parent::$verbose) {
                throw new Exception();
            }
            $this->uk = (bool) $uk;
            parent::__construct();
        }

        public function flat($flat = null) {}
        {}

        public function houseName($house_name = null) {}
        public function houseNumber($house_number = null) {}
        public function street($street = null) {}
        public function streetLine1($street = null) {}
        public function streetLine2($street = null) {}
        public function district($district = null) {}
        public function districtLine1($district = null) {}
        public function districtLine2($district = null) {}
        public function town($town = null) {}
        public function county($county = null) {}
        public function postcode($postcode = null) {}
        public function poBox($pobox = null) {}
        public function country($country = null) {}
        public function sharedLetterbox($shared_letterbox = null) {}

        public function location($location = null) {}
        public function locationLine1($location = null) {}
        public function locationLine2($location = null) {}
        public function locationLine3($location = null) {}
        public function locationLine4($location = null) {}
        public function locationLine5($location = null) {}
        public function locationLine6($location = null) {}

    }