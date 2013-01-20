<?php

    namespace PHPerian;

    /**
     * Class Loader
     *
     * This class provides static methods for loading and autoloading library
     * classes during testing. The most common use for this class is to simply
     * call `\PHPerian\TestLoader::registerAutoloader()` before using any library
     * components.
     * Please do not use this class directly. If you are not autoloading from
     * Composer, you should include the file `../PHPerian.php`.
     *
     * @package     PHPerian
     * @category    Library
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/TestLoader.php
     */
    class TestLoader
    {

        /**
         * Load A Library Class
         *
         * Perform checks to make sure only local library classes are loaded,
         * and the class file exists within the library path.
         *
         * @static
         * @access public
         * @param string $class
         * @return void
         */
        public static function load($class)
        {
            if(substr($class, 0, 9) !== 'PHPerian\\') {
                return;
            }
            $library_root = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $file = realpath($library_root . DIRECTORY_SEPARATOR . $file);
            if(substr($file, 0, strlen($library_root)) == $library_root) {
                if(is_readable($file)) {
                    include $file;
                }
            }
        }

        /**
         * Register Autoloader
         *
         * Register an autoloader for Nosco's Experian library.
         *
         * @static
         * @access public
         * @return boolean
         */
        public static function registerAutoloader()
        {
            return spl_autoload_register(array('PHPerian\\TestLoader', 'load'));
        }

    }