<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class AlphaNumeric extends Attribute implements AttributeInterface
    {

        public function setValue($value)
        {
            if(!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
                throw new Exceptions\InvalidDataType('Alphanumeric attributes require their value to be a data-type castable into a string.');
            }
            $this->value = (string) $value;
            if(strlen($value) > $this->getLength()) {
                $limit = $this->getLength();
                throw new Exceptions\DataTruncated("Attribute value exceeds its {$limit} character limit.");
            }
        }

    }
