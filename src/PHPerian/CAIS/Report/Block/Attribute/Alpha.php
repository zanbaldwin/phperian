<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Alpha extends Attribute implements AttributeInterface
    {

        public function setValue($value)
        {
            if(!preg_match('/^[a-zA-Z0-9 \'-]+$/', $value)) {
                throw new Exceptions\InvalidDataType('Alpha attributes required their value to be a string containing only letters.');
            }
            $this->value = $value;
            if(strlen($value) > $this->getLength()) {
                $limit = $this->getLength();
                throw new Exceptions\DataTruncated("Attribute value exceeds its {$limit} character limit.");
            }
        }

    }
