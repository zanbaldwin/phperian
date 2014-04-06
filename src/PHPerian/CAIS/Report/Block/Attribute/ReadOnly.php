<?php

    namespace PHPerian\CAIS\Report\Block\Attribute;

    use \PHPerian\CAIS\Report\Block\Attribute;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class ReadOnly extends Attribute implements AttributeInterface
    {

        /**
         * Set: Value
         *
         * @access public
         * @return void
         */
        public function setValue($value)
        {
            // Don't do anything. This attribute is read-only.
            // Changing the value would kinda be a bit useless.
        }

    }
