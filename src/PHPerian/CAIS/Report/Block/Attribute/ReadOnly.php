<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class ReadOnly extends Attribute implements AttributeInterface
    {

        public function setValue($value)
        {
        }

    }
