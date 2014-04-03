<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Residency XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Residency.php
     */
    class Residency extends Partial
    {

        const MAX_CHARS_LOCATION_CODE = 2;

        /**
         * Constructor Method
         *
         * @access public
         * @param \PHPerian\Request\Partial\Applicant $applicant
         * @param \PHPerian\Request\Partial\Location $location
         * @param integer|string|true $location_code
         * @throws \PHPerian\Exception
         * @return void
         */
        public function __construct(
            \PHPerian\Request\Partial\Applicant $applicant,
            \PHPerian\Request\Partial\LocationDetails $location,
            $location_code
        ) {
            // As well as the class constants above, there are two shortcuts: boolean true means current residency, and
            // an integer means nth previous residency.
            switch(true) {
                case $location_code === true:
                    $location_code = \PHPerian::LOCATION_CURRENT;
                    break;
                case is_int($location_code):
                    if($location_code < 1 || $location_code > 8) {
                        throw new Exception();
                    }
                    $location_code++;
                    $location_code = '0' . (string) $location_code;
                    break;
            }
            if(!is_string($location_code) || !preg_match('/^[a-zA-Z0-9_]{1,' . self::MAX_CHARS_LOCATION_CODE . '}$/', $location_code)) {
                throw new Exception();
            }
            $this->struct = array(
                'ApplicantIdentifier' => $applicant->autoIncrement(),
                'LocationIdentifier' => $location->autoIncrement(),
                'LocationCode' => $location_code,

            );
            parent::__construct();
        }

        /**
         * Get and Set: Residency Date From
         *
         * @access public
         * @param integer $year
         * @param integer $month
         * @param integer $day
         * @throws \PHPerian\Exception
         * @return string | Residency $this
         */
        public function dateFrom()
        {
            return $this->validateDate($this->struct['ResidencyDateFrom'], func_get_args());
        }

        /**
         * Get and Set: Residency Date To
         *
         * @access public
         * @param integer $year
         * @param integer $month
         * @param integer $day
         * @throws \PHPerian\Exception
         * @return string | Residency $this
         */
        public function dateTo()
        {
            return $this->validateDate($this->struct['ResidencyDateTo'], func_get_args());
        }

    }