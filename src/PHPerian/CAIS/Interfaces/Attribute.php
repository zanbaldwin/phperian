<?php

    namespace PHPerian\CAIS\Interfaces;

    interface Attribute
    {

        const JUSTIFY_LEFT  = true;
        const JUSTIFY_RIGHT = false;

        const ATTRIBUTE_NS      = '\\PHPerian\\CAIS\\Report\\Block\\Attribute';
        const READONLY          = 'ReadOnly';
        const ALPHA             = 'Alpha';

        public function __construct($start, $end, $name, $value, $justification = self::JUSTIFY_LEFT, $padding = ' ');

        public function getStartByte();
        public function getEndByte();
        public function getName();
        public function getJustification();
        public function getPadding();

        public function getType();
        public function getValue();
        public function setValue($value);
        public function getString();

    }
