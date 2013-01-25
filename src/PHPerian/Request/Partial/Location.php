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
        const MAX_CHARS_HOUSE_NAME = 50;
        const MAX_CHARS_HOUSE_NUMBER = 10;
        const MAX_CHARS_STREET = 60;
        const MAX_CHARS_DISTRICT = 35;
        const MAX_CHARS_TOWN = 30;
        const MAX_CHARS_COUNTY = 30;
        const MAX_CHARS_POSTCODE_UK = 8;
        const MAX_CHARS_POSTCODE_NONUK = 40;
        const MAX_CHARS_POBOX = 6;
        const MAX_CHARS_LOCATION = 40;

        const COUNTRY_UK = 'UK';
        const COUNTRY_IE = 'IE';

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

        /**
         * Get and Set: Flat
         *
         * @access public
         * @param string $flat
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function flat($flat = null) {}
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Flat'])
                    ? $this->struct['Flat']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($flat)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_FLAT . '}$/', $flat)
            ) {
                $this->struct['Flat'] = $flat;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: House Name
         *
         * @access public
         * @param string $house_name
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function houseName($house_name = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['HouseName'])
                    ? $this->struct['HouseName']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($house_name)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_HOUSE_NAME . '}$/', $house_name)
            ) {
                $this->struct['HouseName'] = $house_name;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: House Number
         *
         * @access public
         * @param string $house_number
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function houseNumber($house_number = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['HouseNumber'])
                    ? $this->struct['HouseNumber']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($house_number)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_HOUSE_NUMBER . '}$/', $house_number)
            ) {
                $this->struct['HouseNumber'] = $house_number;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Street
         *
         * @access public
         * @param string $street
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function street($street = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $return = array();
                if(isset($this->struct['Street'])) {
                    $return[] = $this->struct['Street'];
                }
                if(isset($this->struct['Street2'])) {
                    $return[] = $this->struct['Street2'];
                }
                return count($return) > 0
                    ? implode("\n", $return)
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($street) && $street) {
                $street = explode("\n", $street);
                if(isset($street[2]) && parent::$verbose) {
                    throw new Exception();
                }
                if(isset($street[0])) {
                    $this->streetLine1($street[0]);
                }
                if(isset($street[1])) {
                    $this->streetLine2($street[1]);
                }
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Street (Line 1)
         *
         * @access public
         * @param string $street
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function streetLine1($street = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Street'])
                    ? $this->struct['Street']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($street)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_STREET . '}$/', $street)
            ) {
                $this->struct['Street'] = $street;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Street (Line 2)
         *
         * @access public
         * @param string $street
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function streetLine2($street = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Street2'])
                    ? $this->struct['Street2']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($street)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_STREET . '}$/', $street)
            ) {
                $this->struct['Street2'] = $street;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: District
         *
         * @access public
         * @param string $district
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function district($district = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $return = array();
                if(isset($this->struct['District'])) {
                    $return[] = $this->struct['District'];
                }
                if(isset($this->struct['District2'])) {
                    $return[] = $this->struct['District2'];
                }
                return count($return) > 0
                    ? implode("\n", $return)
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($district) && $district) {
                $district = explode("\n", $district);
                if(isset($district[2]) && parent::$verbose) {
                    throw new Exception();
                }
                if(isset($district[0])) {
                    $this->streetLine1($district[0]);
                }
                if(isset($district[1])) {
                    $this->streetLine2($district[1]);
                }
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: District (Line 1)
         *
         * @access public
         * @param string $district
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function districtLine1($district = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['District'])
                    ? $this->struct['District']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($district)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_STREET . '}$/', $district)
            ) {
                $this->struct['District'] = $district;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: District (Line 2)
         *
         * @access public
         * @param string $district
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function districtLine2($district = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['District2'])
                    ? $this->struct['District2']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($district)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_STREET . '}$/', $district)
            ) {
                $this->struct['District2'] = $district;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Town
         *
         * @access public
         * @param string $town
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function town($town = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['PostTown'])
                    ? $this->struct['PostTown']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($town)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_TOWN . '}$/', $town)
            ) {
                $this->struct['PostTown'] = $town;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: County
         *
         * @access public
         * @param string $county
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function county($county = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['County'])
                    ? $this->struct['County']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($county)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_COUNTY . '}$/', $county)
            ) {
                $this->struct['County'] = $county;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Postcode
         *
         * @access public
         * @param string $postcode
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function postcode($postcode = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Postcode'])
                    ? $this->struct['Postcode']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            $max_chars = $this->uk
                ? self::MAX_CHARS_POSTCODE_UK
                : self::MAX_CHARS_POSTCODE_NONUK;
            if(
                is_string($postcode)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . $max_chars . '}$/', $postcode)
            ) {
                $this->struct['Postcode'] = $postcode;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: PO Box
         *
         * @access public
         * @param string $pobox
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function poBox($pobox = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['POBox'])
                    ? $this->struct['POBox']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($pobox)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_POBOX . '}$/', $pobox)
            ) {
                $this->struct['POBox'] = $pobox;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Country
         *
         * @access public
         * @param string $country
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function country($country = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Country'])
                    ? $this->struct['Country']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($pobox)
             && preg_match('/^(UK|IE)$/i', $pobox)
            ) {
                $this->struct['Country'] = strtoupper($pobox);
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Shared Letterbox
         *
         * @access public
         * @param boolean $country
         * @throws \PHPerian\Exception
         * @return boolean | Location $this
         */
        public function sharedLetterbox($shared_letterbox = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['SharedLetterbox'])
                    ? $this->struct['SharedLetterbox'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($shared_letterbox)) {
                $this->struct['SharedLetterbox'] = $shared_letterbox ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function location($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $return = array();
                if(isset($this->struct['LocationLine1'])) {
                    $return[] = $this->struct['LocationLine1'];
                }
                if(isset($this->struct['LocationLine2'])) {
                    $return[] = $this->struct['LocationLine2'];
                }
                if(isset($this->struct['LocationLine3'])) {
                    $return[] = $this->struct['LocationLine3'];
                }
                if(isset($this->struct['LocationLine4'])) {
                    $return[] = $this->struct['LocationLine4'];
                }
                if(isset($this->struct['LocationLine5'])) {
                    $return[] = $this->struct['LocationLine5'];
                }
                if(isset($this->struct['LocationLine6'])) {
                    $return[] = $this->struct['LocationLine6'];
                }
                return count($return) > 0
                    ? implode("\n", $return)
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($location) && $location) {
                $location = explode("\n", $location);
                if(isset($location[6]) && parent::$verbose) {
                    throw new Exception();
                }
                if(isset($location[0])) {
                    $this->locationLine1($location[0]);
                }
                if(isset($location[1])) {
                    $this->locationLine2($location[1]);
                }
                if(isset($location[2])) {
                    $this->locationLine3($location[2]);
                }
                if(isset($location[3])) {
                    $this->locationLine4($location[3]);
                }
                if(isset($location[4])) {
                    $this->locationLine5($location[4]);
                }
                if(isset($location[5])) {
                    $this->locationLine6($location[5]);
                }

            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 1)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine1($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine1'])
                    ? $this->struct['LocationLine1']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine1'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 2)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine2($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine2'])
                    ? $this->struct['LocationLine2']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine2'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 3)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine3($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine3'])
                    ? $this->struct['LocationLine3']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine3'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 4)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine4($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine4'])
                    ? $this->struct['LocationLine4']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine4'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 5)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine5($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine5'])
                    ? $this->struct['LocationLine5']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine5'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Location (Line 6)
         *
         * @access public
         * @param string $location
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function locationLine6($location = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['LocationLine6'])
                    ? $this->struct['LocationLine6']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($location)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_LOCATION . '}$/', $location)
            ) {
                $this->struct['LocationLine6'] = $location;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

    }