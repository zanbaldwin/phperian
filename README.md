# [PHPerian](https://github.com/mynameiszanders/phperian)

PHPerian is a PHP library, managed by [Composer](http://getcomposer.org) and eventually [Packagist](https://packagist.org/), designed to assist the generation of XML for a SOAP service request to Experian's Web Service, and to interpret their response.

**Please note that this package is currently in development, has no stable release, and no gaurantee can be made
regarding the stability or practicality of use. It is in no way fit for use in a production environment.**

The current version is *0.2-alpha*, which means it is ready for in-house (alpha) testing. This mostly involves completing the unit testing for the library/package.

License
-------

Written for [Nosco Systems](http://nosco-systems.co.uk), it is licensed under [MIT/X11](http://j.mp/mit-license). The
`LICENSE` file can be found in the root directory of the package.

Installation
------------

This package will eventually find its way to [Packagist](https://packagist.org/) when a stable version is released, but
until then it will only be available through its GitHub [repository page][repo].

To install this package in its current form, add this repository to your project's `composer.json`, and add this package
as a requirement:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/mynameiszanders/phperian"
    }
],
"require": {
    "mynameiszanders/phperian": "dev-master"
}
```

Example Usage
-------------

### CAIS Reporting

```php
<?php

    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;

    // Please note that this is a quick example and does not show the full capability of CAIS
    // reporting (such as array access for certain objects, method and object attribute
    // access, etc).
    $report = new \PHPerian\CAIS\Report;

    foreach($submembers as $submember) {
        // Create a new new block for the current submember, pass it a custom identifier, the
        // source code (Experian identifier), and the name.
        $block = $report->createBlock(
            $submember->id,
            $submember->sourceCode,
            $submember->name
        );

        foreach($submember->customers as $customer) {
            // Create a record for each customer. No arguments are required because the record
            // has 42 attributes, too many for one method.
            $record = $block->createRecord();
            // Start filling in the attributes.
            $record->attributes = array(
                'accountNumber'             => '12345B6789B',
                'accountType'               => 2,
                'startDate'                 => new \DateTime('1999-07-03'),
                'closeDate'                 => new \DateTime('2000-07-30'),
                'monthlyPayment'            => 200,
                'repaymentPeriod'           => 48,
                'currentBalance'            => 3600,
                'creditBalanceIndicator'    => AttributeInterface::IN_CREDIT,
                'accountStatusCode'         => AttributeInterface::STATUS_DORMANT,
                // ... And the list goes on. Refer to documentation for a full list of attributes.
            );
        }
    }

    // Create the CAIS report by type-casting the report object to a string. We could also use
    // the getString() method, instead.
    $caisReportToUpload = (string) $report;
```

### Web Services Request

```php
<?php

    // If you're not using Composer, include the base PHPerian file to autoload the classes for you.
    require_once 'src/PHPerian.php';

    // Start a new request.
    $request = new \PHPerian\Request;

    // Create the applicant.
    $applicant = $request->createApplicant('Test', 'Case')
        ->title('Mr')
        ->middleName('Scenario')
        ->setGenderMale()
        ->dateOfBirth('1970', 1, 1);
    // Add current address.
    $location = $request->createLocationDetails(\PHPerian::LOCATION_UK)
        ->houseName('Buckingham Palace')
        ->postcode('SW1A 1AA');
    // Link applicant with current address.
    $request->createResidency($applicant, $location, \PHPerian::LOCATION_CURRENT)
        ->dateFrom(2012, 12, 21)
        // Currently living there, provide today's date.
        ->dateTo(date('Y'), date('n'), date('j'));
    // Create the request control block.
    $request->createControl()
        ->userIdentity('TestQueen')
        ->reprocessFlag(true)
        ->authenticatePlus(true)
        ->fullFBL(true)
        ->detect(true)
        ->interactiveMode(\PHPerian::INTERACTIVE_MODE_ONESHOT);
    // Create the request application block.
    $request->createApplication('EQ')
        ->amount(1000)
        ->term(1)
        ->applicationChannel('FF')
        ->searchConsent(true);
    // Create ThirdPartyData XML block.
    $request->createThirdPartyData()
        ->optOut(false);

    // Generate the XML request.
    $xml = $request->xml();

    // Prettify the XML output.
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($xml);
    $dom->formatOutput = true;
    $xml = $dom->saveXml();

    headers_sent() || header('Content-Type: text/xml');
    echo $xml;
```

As of Friday, 25th January, 2013, the above code generates the following XML:

```xml
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
  <soap:Header>
    <wsse:Security>
      <wsse:BinarySecurityToken ValueType="ExperianWASP" EncodingType="wsse:Base64Binary" wsu:Id="SecurityToken">{{BinarySecurityToken}}</wsse:BinarySecurityToken>
    </wsse:Security>
  </soap:Header>
  <soap:Body>
    <ns2:Interactive xmlns:ns2="http://www.uk.experian.com/experian/wbsv/peinteractive/v100">
      <ns1:Root xmlns:ns1="http://schemas.microsoft.com/BizTalk/2003/Any">
        <ns0:Input xmlns:ns0="http://schema.uk.experian.com/experian/cems/msgs/v1.7/ConsumerData">
          <Applicant>
            <ApplicantIdentifier>1</ApplicantIdentifier>
            <Name>
              <Forename>Test</Forename>
              <Surname>Case</Surname>
              <Title>Mr</Title>
              <MiddleName>Scenario</MiddleName>
            </Name>
            <Gender>M</Gender>
            <DateOfBirth>
              <CCYY>1970</CCYY>
              <MM>01</MM>
              <DD>01</DD>
            </DateOfBirth>
          </Applicant>
          <LocationDetails>
            <LocationIdentifier>1</LocationIdentifier>
            <UKLocation>
              <HouseName>Buckingham Palace</HouseName>
              <Postcode>SW1A1AA</Postcode>
            </UKLocation>
          </LocationDetails>
          <Residency>
            <ApplicantIdentifier>1</ApplicantIdentifier>
            <LocationIdentifier>1</LocationIdentifier>
            <LocationCode>01</LocationCode>
            <ResidencyDateFrom>
              <CCYY>2012</CCYY>
              <MM>12</MM>
              <DD>21</DD>
            </ResidencyDateFrom>
            <ResidencyDateTo>
              <CCYY>2013</CCYY>
              <MM>01</MM>
              <DD>27</DD>
            </ResidencyDateTo>
          </Residency>
          <Control>
            <UserIdentity>TestQueen</UserIdentity>
            <ReprocessFlag>Y</ReprocessFlag>
            <Parameters>
              <AuthPlusRequired>E</AuthPlusRequired>
              <FullFBLRequired>Y</FullFBLRequired>
              <DetectRequired>Y</DetectRequired>
              <InteractiveMode>OneShot</InteractiveMode>
            </Parameters>
          </Control>
          <Application>
            <ApplicationType>EQ</ApplicationType>
            <Amount>1000</Amount>
            <Term>1</Term>
            <ApplicationChannel>FF</ApplicationChannel>
            <SearchConsent>Y</SearchConsent>
          </Application>
          <ThirdPartyData>
            <OptOut>N</OptOut>
          </ThirdPartyData>
        </ns0:Input>
      </ns1:Root>
    </ns2:Interactive>
  </soap:Body>
</soap:Envelope>
```

Authors
-------

This package was written by [Zander Baldwin](http://mynameiszanders.github.com), with the help of [Clive Dann](https://github.com/clivedann).

Build Status
------------

[![Build Status](https://travis-ci.org/mynameiszanders/phperian.png?branch=develop)][travisbuild]<br />
You can follow the build progress on [Travis CI](https://travis-ci.org/mynameiszanders/phperian).

[repo]: https://github.com/mynameiszanders/phperian "PHPerian GitHub repository"
[travisbuild]: https://travis-ci.org/mynameiszanders/phperian "Build Status on Travis CI"
