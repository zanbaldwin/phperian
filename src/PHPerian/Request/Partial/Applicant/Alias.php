<?php

    namespace PHPerian\Request\Partial\Applicant;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the Alias XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Applicant/Alias.php
     */
    class Alias extends Partial
    {

        // Data length validation.
        const MAX_CHARS_TITLE       = 10;
        const MAX_CHARS_FORENAME    = 15;
        const MAX_CHARS_MIDDLENAME  = 15;
        const MAX_CHARS_SURNAME     = 30;
        const MAX_CHARS_SUFFIX      = 10;

        // Field values.
        const SOURCE_PROPOSAL       = 'P';
        const SOURCE_EXISTING       = 'E';
        const SOURCE_TELEPHONE      = 'T';
        const SOURCE_OTHER          = 'O';

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
            // Make sure that both forename and surname are non-empty strings.
            $f_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_FORENAME . '}$/';
            $s_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_SURNAME . '}$/';
            if(
                !is_string($forename)
             || !is_string($surname)
             || !preg_match($f_regex, $forename)
             || !preg_match($s_regex, $surname)
            ) {
                throw new Exception();
            }
            // Set the required attributes.
            $this->struct['Forename'] = $forename;
            $this->struct['Surname'] = $surname;
            // Call the parent constructor to assign a unique ID and save the object to map.
            parent::__construct();
        }

        /**
         * Get and Set: Title
         *
         * @access public
         * @param string $title
         * @throws \PHPerian\Exception
         * @return string | Alias $this
         */
        public function title($title = null)
        {
            return $this->validateAlphaNumeric($this->struct['Title'], func_get_args(), 10);
        }

        /**
         * Get and Set: Middle Name
         *
         * @access public
         * @param string $middle_name
         * @throws \PHPerian\Exception
         * @return string | Alias $this
         */
        public function middleName($middle_name = null)
        {
            return $this->validateAlphaNumericExtra($this->struct['MiddleName'], func_get_args(), 15);
        }

        /**
         * Get and Set: Suffix
         *
         * @access public
         * @param string $suffix
         * @throws \PHPerian\Exception
         * @return string | Alias $this
         */
        public function suffix($suffix = null)
        {
            return $this->validateAlphaNumericExtra($this->struct['Suffix'], func_get_args(), 10);
        }

        /**
         * Get and Set: Gender
         *
         * @access public
         * @param string $gender
         * @throws \PHPerian\Exception
         * @return string | Alias $this
         */
        public function gender($gender = null)
        {
            return $this->validateSet($this->struct['Gender'], func_get_args(), array('M', 'F'));
        }

        /**
         * Set Gender to Male
         *
         * @access public
         * @return Alias $this
         */
        public function setGenderMale()
        {
            return $this->gender('M');
        }

        /**
         * Set Gender to Female
         *
         * @access public
         * @return Alias $this
         */
        public function setGenderFemale()
        {
            return $this->gender('F');
        }

        /**
         * Get or Set Source
         *
         * @access public
         * @param string $source
         * @throws \PHPerian\Exception
         * @return Alias $this
         */
        public function source($source = null)
        {
            return $this->validateSet($this->struct['Source'], func_get_args(), array('P', 'E', 'T', 'O'));
        }

    }