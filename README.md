# [<img src="https://raw.github.com/mynameiszanders/phperian/develop/phperian.png" title="PHPerian" alt="PHPerian Logo" width="389" height="111" />](https://github.com/mynameiszanders/phperian)

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

    // Include Composer's autoload script.
    require_once 'vendor/autoload.php';

    // Start a new request.
    $request = new \PHPerian\Request;
    // Create a new applicant.
    $applicant = $request   ->createApplicant('Zander', 'Baldwin')
                            ->setGenderMale()
                            ->dateOfBirth(1970, 1, 1);
    // Create a new location.
    $location = $request    ->createLocation()
                            ->name('Buckingham Palace')
                            ->postcode('SW1A 1AA');
    // Tie the applicant with the location.
    $residency = $request   ->createResidency($applicant, $location, $request::LOCATION_CURRENT)
                            ->dateFrom(1970, 1, 1)
                            ->dateTo(2012, 12, 21);
    // Generate the XML request.
    $xml = $request->xml();

    $binary_token = new \PHPerian\SOAP\Token;

    // Create a SOAP request pre-configured for 
    $soap = new \PHPerian\SOAP\Service($xml, $binary_token);
    // Set security details.
    $soap->setCertificate($file_to_certificate);
    $soap->setCertificatePassword($certificate_password);
    $soap->setPrivateKey($file_to_private_key);
    // Send the SOAP request.
    $response_xml = $soap->send();

    $data = new \PHPerian\Response($xml);
```

Authors
-------

This package was written by [Zander Baldwin](http://mynameiszanders.github.com), with the help of [Clive Dann](http://clivedann.co.uk).

Build Status
------------

[![Build Status](https://travis-ci.org/mynameiszanders/phperian.png?branch=develop)][travisbuild]<br />
You can follow the build progress on [Travis CI](https://travis-ci.org/mynameiszanders/phperian).

[repo]: https://github.com/mynameiszanders/phperian "PHPerian GitHub repository"
[travisbuild]: https://travis-ci.org/mynameiszanders/phperian "Build Status on Travis CI"