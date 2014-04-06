<?php

    namespace PHPerian\CAIS\Report\Block;

    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\CAIS\Collection;
    use \PHPerian\Exceptions;

    class Footer extends Collection
    {

        protected static $attributeDefinitions = array(
            'trailerIdentifier' => array(
                'type'          => AttributeInterface::READONLY,
                'start'         => 1,
                'end'           => 20,
                'name'          => 'Trailer Identifier',
                'default'       => 'HEADER',
                'justification' => AttributeInterface::JUSTIFY_RIGHT,
                'padding'       => '9',
            ),
            'totalNumberOfRecords' => array(
                'type'          => AttributeInterface::INTEGER,
                'start'         => 21,
                'end'           => 28,
                'name'          => 'Total Number of Records',
                'default'       => null,
                'justification' => AttributeInterface::JUSTIFY_RIGHT,
                'padding'       => '0'
            ),
            'filler' => array(
                'type'          => AttributeInterface::READONLY,
                'start'         => 29,
                'end'           => 530,
                'name'          => 'Filler',
                'default'       => null,
                'justification' => AttributeInterface::JUSTIFY_RIGHT,
                'padding'       => ' '
            ),
        );

    }
