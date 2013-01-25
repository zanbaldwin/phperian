# [PHPerian](https://github.com/mynameiszanders/phperian)

PHPerian is a PHP library, managed by [Composer](http://getcomposer.org) and eventually [Packagist](https://packagist.org/), designed to assist the generation of XML for a SOAP service request to Experian's Web Service, and to interpret their response.

**Please note that this package is currently in development, has no stable release, and no gaurantee can be made
regarding the stability or practicality of use. It is in no way fit for use in a production environment.**

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

```php
<?php

    // If you're not using Composer, include the base PHPerian file to autoload the classes for you.
    require_once 'src/PHPerian.php';

    // Start a new request.
    $request = new \PHPerian\Request;
    // Create a new applicant.
    $applicant = $request   ->createApplicant('Zander', 'Baldwin')
                            ->setGenderMale()
                            ->dateOfBirth(1970, 1, 1);
    // Create a new location.
    $location = $request    ->createLocation()
                            ->houseName('Buckingham Palace')
                            ->postcode('SW1A 1AA');
    // Tie the applicant with the location.
    $request                ->createResidency($applicant, $location, \PHPerian::LOCATION_CURRENT)
                            ->dateFrom(1970, 1, 1)
                            ->dateTo(2012, 12, 21);
    $request                ->createThirdPartyData()
                            ->optOut(false);
    // Generate the XML request.
    $xml = $request->xml();
```

As of Friday, 25th January, 2013, the above code generates the following XML:

```
<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><soap:Header><wsse:Security><wsse:BinarySecurityTokenValueType="ExperianWASP"EncodingType="wsse:Base64Binary"wsu:Id="SecurityToken">{{BinarySecurityToken}}</wsse:BinarySecurityToken></wsse:Security></soap:Header><soap:Body><ns2:Interactive xmlns:ns2="http://www.uk.experian.com/experian/wbsv/peinteractive/v100"><ns1:Root xmlns:ns1="http://schemas.microsoft.com/BizTalk/2003/Any"><ns0:Input xmlns:ns0="http://schema.uk.experian.com/experian/cems/msgs/v1.7/ConsumerData"><Applicant><ApplicantIdentifier>1</ApplicantIdentifier><Name><Forename>Zander</Forename><Surname>Baldwin</Surname></Name><Gender>M</Gender><DateOfBirth><CCYY>1970</CCYY><MM>01</MM><DD>01</DD></DateOfBirth></Applicant><Location><LocationIdentifier>1</LocationIdentifier><UKLocation><HouseName>Buckingham Palace</HouseName></UKLocation></Location><Residency><ApplicantIdentifier>1</ApplicantIdentifier><LocationIdentifier>1</LocationIdentifier><LocationCode>01</LocationCode><ResidencyDateFrom><CCYY>1970</CCYY><MM>01</MM><DD>01</DD></ResidencyDateFrom><ResidencyDateTo><CCYY>2012</CCYY><MM>12</MM><DD>21</DD></ResidencyDateTo></Residency><ThirdPartyData><OptOut>N</OptOut></ThirdPartyData></ns0:Input></ns1:Root></ns2:Interactive></soap:Body></soap:Envelope>
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