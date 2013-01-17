Experian Web Service Library
============================

This package is a collection of classes designed to assist the generation of XML for a SOAP service request to
Experian's Web Service, and to interpret their response.

License
-------

Written for [Nosco Systems](http://nosco-systems.co.uk), it is licensed under [MIT/X11]. The `LICENSE` file can be found in the root directory of the package.

Installation
------------

This package will eventually find its way to [Packagist](https://packagist.org/) when a stable version is released, but
until then it will only be available through its GitHub [repository page][repo] and its practicality of use cannot be
gauranteed.

To install this package in its current form, add this repository to your project's `composer.json`, and add this package
as a requirement:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/mynameiszanders/experianwebservice"
        }
    ],
    "require": {
        "nosco/experian": "dev-master"
    }

Authors
-------

This package was written by [Zander Baldwin](http://mynameiszanders.github.com), with the help of [Clive Dann](http://clivedann.co.uk).

[repo]: https://github.com/mynameiszanders/experianwebservice