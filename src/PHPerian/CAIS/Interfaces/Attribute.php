<?php

    namespace PHPerian\CAIS\Interfaces;

    interface Attribute
    {

        const JUSTIFY_LEFT  = true;
        const JUSTIFY_RIGHT = false;

        const ATTRIBUTE_NS      = '\\PHPerian\\CAIS\\Report\\Block\\Attribute';

        const ALPHA             = 'Alpha';
        const ALPHANUMERIC      = 'AlphaNumeric';
        const BOOLEAN           = 'Boolean';
        const DATE              = 'Date';
        const INTEGER           = 'Integer';
        const READONLY          = 'ReadOnly';

        public function __construct($start, $end, $name, $value, $justification = null/*self::JUSTIFY_LEFT*/, $padding = ' ');

        public function getStartByte();
        public function getEndByte();
        public function getLength();
        public function getName();
        public function getJustification();
        public function getPadding();

        public function getValue();
        public function setValue($value);
        public function getString();

    }
