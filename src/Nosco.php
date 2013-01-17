<?php

    /**
     * Nosco's Library for Experian Web Services
     *
     * This is a convinience file for bootstrapping the library during testing.
     * Do not call this file if you are autoloading via Composer.
     *
     * @package     Nosco
     * @category    Experian
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/experianwebservice/blob/develop/src/Nosco.php
     */

    use Nosco\TestLoader;

    require_once 'Nosco/TestLoader.php';
    TestLoader::registerAutoloader();