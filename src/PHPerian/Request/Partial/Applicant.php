<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Applicant XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Applicant.php
     */
    class Applicant extends Partial
    {

        // Data length validation.
        const MAX_CHARS_FORENAME    = 15;
        const MAX_CHARS_SURNAME     = 30;

        /**
         * @var array $struct
         * Define a class member to hold the Applicant XML structure.
         */
        protected $struct = array(
            'ApplicantIdentifier' => -1,
        );

        /**
         * Constructor Method
         *
         * @access public
         * @param string $forename
         * @param string $surname
         * @return void
         */
        public function __construct($forename, $surname)
        {
            // Make sure that both forename and surname are non-empty strings, and match the correct validation
            // criteria.
            $f_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_FORENAME . '}$/';
            $s_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_SURNAME . '}$/';
            if(
                !preg_match($f_regex, $forename)
             || !preg_match($s_regex, $surname)
             || !is_string($forename)
             || !is_string($surname)
            ) {
                // If the forename and surname do no validate, then throw an exception regardless of whether verbose or
                // silent mode is on; the class cannot be used.
                throw new Exception();
            }
            $this->struct['Name'] = array(
                'Forename' => $forename,
                'Surname' => $surname,
            );
            parent::__construct();
        }

        /**
         * Get and Set: Title
         *
         * @access public
         * @param string
         * @return string | Applicant $this
         */
        public function title()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Title'], func_get_args(), 10);
        }

        /**
         * Get and Set: Middle Name
         *
         * @access public
         * @param string
         * @return string | Applicant $this
         */
        public function middleName()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['MiddleName'], func_get_args(), 15);
        }

        /**
         * Get and Set: Suffix
         *
         * @access public
         * @param string
         * @return string | Applicant $this
         */
        public function suffix()
        {
            return $this->validateAlphaNumericExtra($this->struct['Name']['Suffix'], func_get_args(), 10);
        }

        /**
         * Get and Set: Gender
         *
         * @access public
         * @param string
         * @return string | Applicant $this
         */
        public function gender()
        {
            return $this->validateSet($this->struct['Gender'], func_get_args(), array('M', 'F'));
        }

        /**
         * Set Gender to Male
         *
         * @access public
         * @return Applicant $this
         */
        public function setGenderMale()
        {
            return $this->gender('M');
        }

        /**
         * Set Gender to Female
         *
         * @access public
         * @return $this
         */
        public function setGenderFemale()
        {
            return $this->gender('F');
        }

        /**
         * Get and Set: Date of Birth
         *
         * @access public
         * @param integer $year
         * @param integer $month
         * @param integer $day
         * @return $this
         */
        public function dateOfBirth($year = null, $month = null, $day = null)
        {
            if(func_num_args() === 0) {
                // Just check that the year is set as the month and day get set at the same time, and won't be set
                // without it.
                return isset($this->struct['DateOfBirth']['CCYY'])
                    ? $this->struct['DateOfBirth']['CCYY'] . '/'
                    . $this->struct['DateOfBirth']['MM'] . '/'
                    . $this->struct['DateOfBirth']['DD']
                    : null;
            }
            if(
                is_int($year) && $year >= 1875 && $year <= (int) date('Y')
             && is_int($month) && $month >= 1 && $month <= 12
             && is_int($day) && $day >= 1 && $day <= 31
            ) {
                $this->struct['DateOfBirth'] = array(
                    'CCYY' => (string) $year,
                    'MM' => str_pad((string) $month, 2, '0', STR_PAD_LEFT),
                    'DD' => str_pad((string) $day, 2, '0', STR_PAD_LEFT),
                );
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

        /**
         * Create: Alias
         *
         * @access public
         * @throws \PHPerian\Exception
         * @return Alias
         */
        public function createAlias() {

            // If an entry for Aliases in the structure array has not been created, do so now.
            if(!isset($this->struct['Alias']) || !is_array($this->struct['Alias'])) {
                $this->struct['Alias'] = array();
            }
            // Make sure that no more than the maximum number of Aliases is created on this Applicant object.
            if(count($this->struct['Alias']) < self::MAX_NUM_ALIAS) {
                // Create a new Alias object. There's no need for error checking as an exception will be thrown if the
                // class does not exist.
                $alias = parent::__call(__METHOD__, func_get_args());
                // Save a reference to the newly created Alias inside the Applicant class that created it.
                $this->struct['Alias'][] = $alias->id();
            }
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $alias;
        }

        /**
         * Get: Aliases
         *
         * @access public
         * @return array
         */
        public function getAliases()
        {
            return isset($this->struct['Alias']) && is_array($this->struct('Alias'))
                ? $this->struct['Alias']
                : array();
        }

    }