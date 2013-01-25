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

        const MAX_CHARS_OPTOUT_CUTOFF = 5;

        /**
         * Get and Set: Opt-Out
         *
         * @access public
         * @param boolean $opt_out
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function optOut($opt_out = null) {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['OptOut'])
                    ? $this->struct['OptOut'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($opt_out)) {
                $this->struct['OptOut'] = $opt_out ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Transient Association Flag
         *
         * @access public
         * @param boolean $trans_assoc
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function transientAssociation($trans_assoc = null)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['TransientAssocs'])
                    ? $this->struct['TransientAssocs'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($trans_assoc)) {
                $this->struct['TransientAssocs'] = $trans_assoc ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: HHO Allowed
         *
         * @access public
         * @param boolean $hho_allowed
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function hhoAllowed($hho_allowed)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct['HHOAllowed'])
                    ? $this->struct['HHOAllowed'] == parent::BOOLEAN_TRUE
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(is_bool($trans_assoc)) {
                $this->struct['HHOAllowed'] = $trans_assoc ? parent::BOOLEAN_TRUE : parent::BOOLEAN_FALSE;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Get and Set: Opt-Out Cut Off
         *
         * @access public
         * @param boolean $opt_out_cutoff
         * @throws \PHPerian\Exception
         * @return boolean | ThirdPartyData $this
         */
        public function optOutCutOff($opt_out_cutoff)
        {
            // If no arguments are passed to the method, return what has already been set.
            if(func_num_args() === 0) {
                return isset($this->struct[$this->type]['OptoutValidCutOff'])
                    ? $this->struct[$this->type]['OptoutValidCutOff']
                    : null;
            }
            // If an argument has been passed to the method, accept this as the value they wish to set.
            if(
                is_string($opt_out_cutoff)
             && preg_match('/^' . parent::PCRE_ALPHANUMERIC . '{1,' . self::MAX_CHARS_OPTOUT_CUTOFF . '}$/', $opt_out_cutoff)
            ) {
                $this->struct[$this->type]['OptoutValidCutOff'] = $opt_out_cutoff;
            }
            // If the input was invalid, and the user has chosen to be verbose about exceptions, throw one.
            elseif(parent::$verbose) {
                throw new Exception();
            }
            // Return a copy of this instance to allow chaining.
            return $this;
        }

    }