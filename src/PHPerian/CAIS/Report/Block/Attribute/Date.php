<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Date extends Attribute implements AttributeInterface
    {

        /**
         * Get: Value
         *
         * @access public
         * @return \DateTime
         */
        public function getValue()
        {
            return clone $this->value;
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

        public function getString()
        {
            return str_pad(
                (string) $this->getValue()->format('dmY'),
                $this->end - $this->start,
                $this->padding,
                $this->getJustification()
                    ? STR_PAD_LEFT
                    : STR_PAD_RIGHT
            );
        }

    }
