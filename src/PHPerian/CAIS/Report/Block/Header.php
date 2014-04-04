<?php

    namespace PHPerian\CAIS\Report\Block;

    use \PHPerian\CAIS\Collection;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Header extends Collection
    {

        protected static $attributeDefinitions = array(
            'identifier' => array(
                AttributeInterface::READONLY,
                1,
                20,
                'Header Identifier',
                'HEADER',
                AttributeInterface::JUSTIFY_RIGHT,
                ' ',
            ),
            'source' => array(
                AttributeInterface::INTEGER,
                21,
                23,
                'Source Code Number',
                null,
                AttributeInterface::JUSTIFY_RIGHT,
                '0'
            ),
            'date' => array(
                AttributeInterface::DATE,
                24,
                31,
                'Date of Creation',
                null,
                AttributeInterface::JUSTIFY_RIGHT,
                '0'
            ),
            'name' => array(
                AttributeInterface::ALPHANUMERIC,
                32,
                61,
                'Company/Portfolio Name',
                null,
                AttributeInterface::JUSTIFY_LEFT,
                ' '
            ),
            'filler' => array(
                AttributeInterface::READONLY,
                62,
                81,
                'Filler',
                null,
                AttributeInterface::JUSTIFY_LEFT,
                ' '
            ),
            'version' => array(
                AttributeInterface::ALPHANUMERIC,
                82,
                89,
                'CAIS Version Indicator',
                'CAIS2007',
                AttributeInterface::JUSTIFY_LEFT,
                ' '
            ),
            'cutoff' => array(
                AttributeInterface::INTEGER,
                90,
                95,
                'Overdraft Reporting Cut-Off',
                0,
                AttributeInterface::JUSTIFY_RIGHT,
                '0',
            ),
            'sharing' => array(
                AttributeInterface::BOOLEAN,
                96,
                96,
                'Cards Behavioural Sharing Flag',
                false,
                AttributeInterface::JUSTIFY_LEFT,
                ' ',
                'Y ',
            ),
            'endFiller' => array(
                AttributeInterface::READONLY,
                97,
                530,
                'End Filler',
                null,
                AttributeInterface::JUSTIFY_LEFT,
                ' ',
            ),
        );

        public function __construct($source, $name, $sharing = null, $cutoff = null, $version = null)
        {
            // Create the attributes.
            parent::__construct();
            // Set the attributes.
            $this->setSource($source);
            $this->setName($name);
            if($sharing !== null) {
                $this->setSharing($sharing);
            }
            if($cutoff !== null) {
                $this->setCutoff($cutoff);
            }
            if($version !== null) {
                $this->setVersion($version);
            }
        }

    }
