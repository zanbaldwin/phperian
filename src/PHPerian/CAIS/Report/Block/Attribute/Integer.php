<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Interger extends Attribute implements AttributeInterface
    {

        public function setValue($value)
        {
            if(!is_int($value) || !preg_match('/^(0|[1-9]\\d*)$/') || $value < 0) {
                throw new Exceptions\InvalidDataType('Integer attributes require their value to be a positive integer or the string-representation of one.');
            }
            $this->value = $value;
            if((int) str_pad('', $this->getLength(), '9') < $this->getValue()) {
                $limit = $this->getLength();
                throw new Exceptions\DataTruncated("Attribute value exceeds its {$limit} character limit.");
            }
        }

    }
