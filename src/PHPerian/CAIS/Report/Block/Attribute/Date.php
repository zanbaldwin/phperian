<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Date extends Attribute implements AttributeInterface
    {

        /**
         * Constructor
         *
         * @access public
         * @param integer $start
         * @param integer $end
         * @param string $name
         * @param mixed $defaultValue
         * @param boolean $justification
         * @param string $padding
         * @return void
         */
        public function __construct($start, $end, $name, $defaultValue, $justification = null, $padding = null)
        {
            parent::__construct($start, $end, $name, $defaultValue, AttributeInterface::JUSTIFY_RIGHT, '0');
        }

        /**
         * Get: Value
         *
         * @access public
         * @return \DateTime
         */
        public function getValue()
        {
            // If the value is an object, clone it so that any changes done to the object returned do not affect the
            // actual value stored in the class property.
            return is_object($this->value)
                ? clone $this->value
                : $this->value;
        }

        /**
         * Set: Value
         *
         * @access public
         * @param mixed $value
         * @return void
         */
        public function setValue($value)
        {
            try {
                $this->value = !(is_object($value) && $value instanceof \DateTime)
                    ? new \DateTime(preg_match('/^(0|\\-?[1-9]\\d*)$/', $value) ? '@' . $value : $value)
                    : $value;
            }
            catch(\Exception $e) {
                throw new Exceptions\InvalidArgument();
            }
        }

        /**
         * Get: CAIS String
         *
         * @access public
         * @return string
         */
        public function getString()
        {
            return str_pad(
                is_object($value = $this->getValue())
                    ? $value->format('dmY')
                    : '0',
                $this->end - $this->start,
                $this->padding,
                $this->getJustification()
                    ? STR_PAD_LEFT
                    : STR_PAD_RIGHT
            );
        }

    }
