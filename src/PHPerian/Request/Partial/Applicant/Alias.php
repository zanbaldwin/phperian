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
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['Title'])
                    ? $this->struct['Title']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($title)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_TITLE . '}$/', $title)
            ) {
                $this->struct['Title'] = $title;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
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
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['MiddleName'])
                    ? $this->struct['MiddleName']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($middle_name)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_MIDDLENAME . '}$/', $middle_name)
            ) {
                $this->struct['MiddleName'] = $middle_name;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            return $this;
        }

    }