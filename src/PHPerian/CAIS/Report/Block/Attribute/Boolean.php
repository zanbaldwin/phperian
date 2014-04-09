<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Boolean extends Attribute implements AttributeInterface
    {

        protected $flags = 'YN';

        /**
         * Set: Value
         *
         * @access public
         * @param boolean|string $value
         * @return void
         */
        public function setValue($value)
        {
            if(is_bool($value)) {
                $this->value = $value;
            }
            elseif(preg_match('/^[01]$/', $value)) {
                $this->value = (bool) $value;
            }
            elseif(is_string($value) && strlen($value) === 1 && strpos($this->flags, $value) !== false) {
                $this->value = !strpos($this->flags, $value);
            }
            else {
                throw new Exceptions\InvalidDataType('Boolean attributes require their values to be of boolean data type, or one of their single character flags.');
            }
        }

        /**
         * Get: Flags
         *
         * @access public
         * @return string
         */
        public function getFlags($value)
        {
            return $this->flags;
        }

        /**
         * Set: Flags
         *
         * @access public
         * @param string $value
         * @return void
         */
        public function setFlags($value)
        {
            if(!is_string($value) || strlen($value) !== 2 || substr($value, 0, 1) === substr($value, 1, 2)) {
                throw new Exceptions\InvalidDataType('A boolean attributes flags must be set with a two-character string, without duplicates.');
            }
            $this->flags = $value;
        }

    }
