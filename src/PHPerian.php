<?php

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * This is a convinience file for bootstrapping the library during testing.
     * Do not call this file if you are autoloading via Composer.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian.php
     */

    use PHPerian\TestLoader;

    require_once 'PHPerian/TestLoader.php';
    TestLoader::registerAutoloader();