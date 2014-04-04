<?php

    namespace PHPerian\CAIS\Report\Block;

    use \PHPerian\Exceptions;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;

    abstract class Attribute
    {

        protected $start;
        protected $end;
        protected $name;
        protected $value;
        protected $justification    = AttributeInterface::JUSTIFY_LEFT;
        protected $padding          = ' ';

        /**
         * Constructor
         *
         * @access public
         * @return void
         */
        public function __construct($start, $end, $name, $defaultValue, $justification = null, $padding = null)
        {
            // Make sure that the start position is an integer above zero. Either in the integer data-type, or a
            // string-representation of one.
            if((!is_int($start) || $start < 0) && (!is_string($start) || !preg_match('/^(0|[1-9]\\d*)$/', $start))) {
                throw new Exceptions\InvalidArgument('The start position should be a positive integer.');
            }
            // The Experian CAIS documentation specifies the start byte to be one greater than it should be. They do not
            // used zero-based counting with this. It can get rather annoying.
            $this->start = (int) $start - 1;
            // Make sure that the end position is an integer above zero. Either in the integer data-type, or a
            // string-representation of one.
            if((!is_int($end) || $end < 0) && (!is_string($end) || !preg_match('/^(0|[1-9]\\d*)$/', $end))) {
                throw new Exceptions\InvalidArgument('The end position should be a positive integer.');
            }
            // The Experian CAIS documentation specifies the start byte to be one greater than it should be. They do not
            // used zero-based counting with this. It can get rather annoying.
            $this->end = (int) $end - 1;
            // The name is not really important, but if it's not a non-empty string then don't bother setting it.
            $this->name = is_string($name) && !empty($name)
                ? $name
                : null;
            // Attempt to set the default value.
            if($defaultValue !== null) {
                try {
                    $this->setValue($defaultValue);
                }
                catch(Exceptions\Exception $e) {
                    throw new InvalidArgument('The attributes default value could not be set.');
                }
            }
            // Check that the justification is correct. The constants use the boolean data-type.
            if($justification !== null) {
                if(!is_bool($justification)) {
                    throw new Exceptions\InvalidArgument('The attribute justification flag is the wrong data-type, please use the class constants provided.');
                }
                $this->justification = $justification;
            }
            // Check that the justification is correct, it should be a one-character string.
            if($padding !== null) {
                if(!is_string($padding) || strlen($padding) !== 1) {
                    throw new Exceptions\InvalidArgument('The attribute padding should be a one-character string.');
                }
                $this->padding = $padding;
            }
        }

        /**
         * Get: Start Byte
         *
         * @access public
         * @return integer
         */
        public function getStartByte()
        {
            return $this->start;
        }

        /**
         * Get: End Byte
         *
         * @access public
         * @return integer
         */
        public function getEndByte()
        {
            return $this->end;
        }

        /**
         * Get: Length
         *
         * @access public
         * @return integer
         */
        public function getLength()
        {
            return ($this->end - $this->start) + 1;
        }

        /**
         * Get: Attribute Name
         *
         * @access public
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Get: Justification
         *
         * @access public
         * @return boolean
         */
        public function getJustification()
        {
            return $this->justification;
        }

        /**
         * Get: Padding
         *
         * @access public
         * @return string
         */
        public function getPadding()
        {
            return $this->padding;
        }

        /**
         * Get: Value
         *
         * @access public
         * @return mixed
         */
        public function getValue()
        {
            return $this->value;
        }

        /**
         * Get: Value (String Form)
         *
         * @access public
         * @return string
         */
        public function getString()
        {
            return str_pad(
                (string) $this->getValue(),
                $this->end - $this->start,
                $this->padding,
                $this->getJustification()
                    ? STR_PAD_LEFT
                    : STR_PAD_RIGHT
            );
        }


    }
