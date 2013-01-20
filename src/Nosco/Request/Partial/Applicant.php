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
     * @abstract
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/Applicant.php
     */
    class Applicant extends Partial
    {

        // Data length validation.
        const MAX_NUM_ALIASES       = 3;
        const MAX_CHARS_TITLE       = 10;
        const MAX_CHARS_FORENAME    = 15;
        const MAX_CHARS_MIDDLENAME  = 15;
        const MAX_CHARS_SURNAME     = 30;
        const MAX_CHARS_SUFFIX      = 10;

        /**
         * @var array $struct
         * Define a class member to hold the Applicant XML structure.
         */
        protected $struct = array(
            'ApplicantIdentifier' => -1,
        );

        public function __construct($forname, $surname)
        {
            // Make sure that both forename and surname are non-empty strings, and match the correct validation
            // criteria.
            $f_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_FORENAME . '}$/';
            $s_regex = '/^' . parent::PCRE_ALPHANUMERIC_EXTRA . '{1,' . self::MAX_CHARS_SURNAME . '}$/';
            if(!preg_match($f_regex, $forename) || !preg_match($s_regex, $surname)) {
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

    }