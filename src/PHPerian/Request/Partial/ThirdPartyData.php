<?php

    namespace PHPerian\Request\Partial;

    use \PHPerian\Request\Partial as Partial;
    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * A class for assisting with the generation of the ThirdParty XML block for request SOAP requests to Experian's Web
     * Services.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial/ThirdPartyData.php
     */
    class ThirdPartyData extends Partial
    {

        /**
         * Get and Set: Opt-Out
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function optOut()
        {
            return $this->validateBoolean($this->struct['OptOut'], func_get_args());
        }

        /**
         * Get and Set: Transient Association Flag
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function transientAssociation()
        {
            return $this->validateBoolean($this->struct['TransientAssocs'], func_get_args());
        }

        /**
         * Get and Set: HHO Allowed
         *
         * @access public
         * @param boolean
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function hhoAllowed()
        {
            return $this->validateBoolean($this->struct['HHOAllowed'], func_get_args());
        }

        /**
         * Get and Set: Opt-Out Cut Off
         *
         * @access public
         * @param string
         * @throws \PHPerian\Exception
         * @return string | ThirdPartyData $this
         */
        public function optOutCutOff()
        {
            return $this->validateAlphaNumeric($this->struct[$this->type]['OptoutValidCutOff'], func_get_args(), 5);
        }

    }