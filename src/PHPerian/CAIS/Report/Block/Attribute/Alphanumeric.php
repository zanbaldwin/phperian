<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class AlphaNumeric extends Attribute implements AttributeInterface
    {

        public function setValue($value)
        {
            if(!is_string($value)) {
                throw new Exceptions\InvalidDataType('Alphanumeric attributes required their value to be a string.');
            }
            $this->value = $value;
            if(strlen($value) > $this->getLength()) {
                $limit = $this->getLength();
                throw new Exceptions\DataTruncated("Attribute value exceeds its {$limit} character limit.");
            }
        }

    }
