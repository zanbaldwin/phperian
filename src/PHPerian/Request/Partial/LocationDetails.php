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
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/LocationDetails.php
     */
    class LocationDetails extends Partial
    {

        /**
         * @var array $struct
         * Define a class member to hold the Applicant XML structure.
         */
        protected $struct = array(
            'LocationIdentifier' => -1,
        );

        /**
         * @var string $type
         * The type of location this class represents.
         */
        protected $type = null;

        /**
         * Constructor Method
         *
         * @access public
         * @param boolean $uk
         * @return void
         */
        public function __construct($type)
        {
            $options = array(\PHPerian::LOCATION_UK, \PHPerian::LOCATION_BFPO, \PHPerian::LOCATION_OVERSEAS);
            if(!in_array($type, $options)) {
                throw new Exception(
                    'Parameter passed to ' . __CLASS__ . ' constructor method is not a valid option in the defined set.',
                    Partial::INVALID_OPTION
                );
            }
            $this->type = $type;
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
        public function flat($flat = null)
        {
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['Flat'], func_get_args(), 30);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['HouseName'], func_get_args(), 50);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['HouseNumber'], func_get_args(), 10);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $lines = array(
                    $this->streetLine1(),
                    $this->streetLine2(),
                );
                $return = trim(preg_replace('/\\n+/', "\n", implode("\n", $lines)), "\n");
                return $return
                    ? $return
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($street)) {
                $street = explode("\n", trim($street, "\n"));
            }
            if(!is_array($street)) {
                if(self::$verbose) {
                    throw new Exception(
                        'The parameter passed to ' . __METHOD__ . ' must be either a string or array.',
                        Partial::INVALID_DATA_TYPE
                    );
                }
                else {
                    return $this;
                }
            }
            $i = 0;
            foreach($street as $line) {
                $i++;
                $method = 'streetLine' . $i;
                $this->$method($line);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['Street'], func_get_args(), 60);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['Street2'], func_get_args(), 60);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $lines = array(
                    $this->districtLine1(),
                    $this->districtLine2(),
                );
                $return = trim(preg_replace('/\\n+/', "\n", implode("\n", $lines)), "\n");
                return $return
                    ? $return
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($street)) {
                $street = explode("\n", trim($street, "\n"));
            }
            if(!is_array($street)) {
                if(self::$verbose) {
                    throw new Exception(
                        'The parameter passed to ' . __METHOD__ . ' must be either a string or array.',
                        Partial::INVALID_DATA_TYPE
                    );
                }
                else {
                    return $this;
                }
            }
            $i = 0;
            foreach($street as $line) {
                $i++;
                $method = 'districtLine' . $i;
                $this->$method($line);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['District'], func_get_args(), 35);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['District2'], func_get_args(), 35);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['PostTown'], func_get_args(), 30);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumericExtra($this->struct[$this->type]['Country'], func_get_args(), 30);
        }

        /**
         * Get and Set: Postcode
         *
         * @access public
         * @param string $postcode
         * @throws \PHPerian\Exception
         * @return string | Location $this
         */
        public function postcode()
        {
            $arguments = func_get_args();
            // Remove any spaces that may appear in the postcode. They get stripped out by Experian anyway.
            if(isset($arguments[0])) {
                $arguments[0] = str_replace(' ', '', $arguments[0]);
            }
            $max_chars = $this->type == \PHPerian::LOCATION_UK ? 8 : 40;
            return $this->validateAlphaNumeric($this->struct[$this->type]['Postcode'], $arguments, $max_chars);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['POBox'], func_get_args(), 6);
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            // If a value was passed, make sure it is uppercase.
            $arguments = func_get_args();
            if(isset($arguments[0])) {
                $arguments[0] = strtoupper($arguments[0]);
            }
            return $this->validateSet($this->struct[$this->type]['Country'], func_get_args(), array('UK', 'IE'));
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
            if($this->type != \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateBoolean($this->struct[$this->type]['SharedLetterbox'], func_get_args());
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                $lines = array(
                    $this->locationLine1(),
                    $this->locationLine2(),
                    $this->locationLine3(),
                    $this->locationLine4(),
                    $this->locationLine5(),
                    $this->locationLine6(),
                );
                $return = trim(preg_replace('/\\n+/', "\n", implode("\n", $lines)), "\n");
                return $return
                    ? $return
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_string($location)) {
                $location = explode("\n", trim($location, "\n"));
            }
            if(!is_array($location)) {
                if(self::$verbose) {
                    throw new Exception(
                        'The parameter passed to ' . __METHOD__ . ' must be either a string or array.',
                        Partial::INVALID_DATA_TYPE
                    );
                }
                else {
                    return $this;
                }
            }
            $i = 0;
            foreach($location as $line) {
                $i++;
                $method = 'locationtLine' . $i;
                $this->$method($line);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine1'], func_get_args(), 40);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine2'], func_get_args(), 40);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine3'], func_get_args(), 40);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine4'], func_get_args(), 40);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine5'], func_get_args(), 40);
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
            if($this->type == \PHPerian::LOCATION_UK) {
                if(parent::$verbose) {
                    throw new Exception();
                }
                else {
                    return $this;
                }
            }
            return $this->validateAlphaNumeric($this->struct[$this->type]['LocationLine6'], func_get_args(), 40);
        }

    }