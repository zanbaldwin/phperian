<?php

    namespace PHPerian\Request;

    use \PHPerian\Exception as Exception;

    /**
     * PHPerian: PHP library for Experian's Web Services
     *
     * An abstract class for all Request sub-classes to extend from. It provides base functionality for generating the
     * XML from each sub-class's structure array.
     *
     * @package     PHPerian
     * @category    Library
     * @abstract
     * @author      Zander Baldwin <mynameiszanders@gmail.com>
     * @license     MIT/X11 <http://j.mp/mit-license>
     * @link        https://github.com/mynameiszanders/phperian/blob/develop/src/PHPerian/Request/Partial.php
     */
    abstract class Partial
    {

        // Validation values.
        const PCRE_NUMERIC              = '[0-9]';
        const PCRE_ALPHA                = '[a-zA-Z]';
        const PCRE_ALPHANUMERIC         = '[a-zA-Z0-9]';
        const PCRE_ALPHANUMERIC_EXTRA   = '[a-zA-Z0-9\\-&\\.\'\\/\\\\\\(\\)@ ]';
        const BOOLEAN_TRUE              = 'Y';
        const BOOLEAN_FALSE             = 'N';

        // Exception error codes.
        const INVALID_DATA_FORMAT       = 1;
        const TOO_MANY_ARGUMENTS        = 2;
        const INVALID_OPTION            = 3;

        /**
         * @var array $id_map
         */
        private static $id_map = array();

        /**
         * @var array $incrementers
         */
        private static $incrementers = array();

        /**
         * @var boolean $verbose
         */
        protected static $verbose = false;

        /**
         * @var string $id
         */
        protected $id = null;

        /**
         * @var array $struct
         */
        protected $struct = array();

        /**
         * Constructor Method
         *
         * @access public
         * @return void
         */
        public function __construct()
        {
            $this->id = uniqid('Partial', true);
            $this->save();
        }

        /**
         * Magic Method: Call
         *
         * If a method to create a new object has been called, attempt to find
         * the class and initialise it with the parameters passed.
         * Obviously, if the method does not exist, throw an exception.
         *
         * @access public
         * @throws \Nosco\Exception
         * @return object
         */
        public function __call($method, $arguments)
        {
            // This magic method is to catch any calls to "magic" methods that create and return a new instance of a
            // Request sub-class. So, make sure that the method keyword is "create", and that the rest of the method
            // string identifies the class to initiate.
            if(preg_match('/create([A-Z].*)$/', $method, $matches)) {
                // Make sure that the class specified in the method exists as a Request sub-class.
                $class = '\\' . get_called_class() . '\\' . $matches[1];
                if(class_exists($class)) {
                    // It does? Great! Create a new instance based on the arguments passed and return it.
                    $reflection = new \ReflectionClass($class);
                    return $reflection->newInstanceArgs($arguments);
                }
            }
            // If the method called was invalid (eg, it didn't map to a Request sub-class) throw an exception.
            throw new Exception('Call to undefined method "' . $method . '" on class "' . __CLASS__ . '".');
        }

        /**
         * Fetch Instance by ID
         *
         * @final
         * @static
         * @access public
         * @param string $id
         * @throws \PHPerian\Exception
         * @return object
         */
        final public static function fetchById($id)
        {
            // If the instance identified by $id does not exist, deal with the error.
            if(!isset(self::$id_map[$id])) {
                // If the user has verbose mode on, throw an exception.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If the user has silent mode on, just return a boolean false.s
                else {
                    return false;
                }
            }
            // It does exist, return the instance.
            return self::$id_map[$id];
        }

        /**
         * Serialise
         *
         * @final
         * @access public
         * @return string
         */
        public function serialize()
        {
            return base64_encode(serialize($this));
        }

        /**
         * Serialise by ID
         *
         * @final
         * @static
         * @access public
         * @param string $id
         * @throws \PHPerian\Exception
         * @return string
         */
        final public static function serializeById($id)
        {
            // If the instance identified by $id does not exist, throw an exception.
            if(!isset(self::$id_map[$id])) {
                // If user has set verbose mode on, throw an exception.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If the user has set silent mode on, return boolean false.
                else {
                    return false;
                }
            }
            // It does exist, return the Base64, serialized representation of the instance.
            return base64_encode(serialize(self::$id_map[$id]));
        }

        /**
         * Load Serialised Object
         *
         * @final
         * @static
         * @access public
         * @param string $serial
         * @throws \PHPerian\Exception
         * @return object
         */
        final public static function loadFromSerial($serial)
        {
            // If the serial is a non-empty string, throw an exception.
            if(!is_string($serial) || !$serial) {
                // If the user has verbose mode on, throw an exception.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If the user has silent mode on, return boolean false.
                else {
                    return false;
                }
            }
            // If the Base64-encoded string cannot be decoded correctly, throw an exception.
            if(!($serial = base64_decode($serial, true))) {
                // If the user has verbose mode on, throw an exception.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If the user has silent mode on, return boolean false.
                else {
                    return false;
                }
            }
            // If the Serial cannot be unserialised into an object, or that object does not extend this class, throw an
            // exception.
            if(!is_object($object = unserialize($serial)) || get_parent_class($object) != __CLASS__) {
                // If the user has verbose mode on, throw an exception.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If the user has silent mode on, return boolean false.
                else {
                    return false;
                }
            }
            // If the object already exists within the ID map (either due to it being created in this execution of the
            // script, or it has already been loaded from serial) return that instance instead as it may have been
            // updated.
            if(isset(self::$id_map[$object->id()])) {
                return self::$id_map[$object->id()];
            }
            // No instance already exists, so save the object and return it.
            $object->save();
            return $object;
        }

        /**
         * Get Object ID
         *
         * @access public
         * @return string
         */
        public function id()
        {
            return $this->id;
        }

        /**
         * Save Instance by ID
         *
         * @access private
         * @return void
         */
        protected function save()
        {
            self::$id_map[$this->id] = $this;
        }

        /**
         * Is Array Associative?
         *
         * Indicates whether an arrays keys are numerical or associative. Please note that if the array keys have been
         * changed, regardless of whether they are all numerical, it will return true.
         *
         * @static
         * @access public
         * @param array $array
         * @return boolean
         */
        public static function isAssoc($array)
        {
            // Grab the keys of the supplied array. The calculated array of keys will always have numerical indexing.
            $array = array_keys($array);
            // If the keys of the supplied array's keys equal the supplied array's keys, then it means that the
            // originally supplied array had numerical indexing, too! So inverse the equality result to provide a
            // boolean on whether the originally supplied array was associative or not.
            return $array !== array_keys($array);
        }

        /**
         * Iterate Through Structure Array
         *
         * @access private
         * @param array $structure
         * @param object $current
         * @throws \PHPerian\Exception
         * @return string
         */
        private function iterateStruct($structure, $current)
        {
            // If the structure is not an array, we cannot iterate through it. Throw an exception.
            if(!is_array($structure)) {
                throw new Exception();
            }
            // Our XML block isn't much to look at now, but at least it's the correct data type...
            $xml = '';
            // Right, on to the whole point of this method: iterating over an XML structure represented by a large
            // associative array.
            foreach($structure as $element => $contents) {
                switch(true) {

                    // If the element is an integer, then it means another Partial sub-class was referenced instead of
                    // an array structure. Fetch that object by its ID and ask for it to generate XML that we can add
                    // inside this Partial sub-class' XML.
                    case is_int($element) && is_string($contents):
                        // Attempt to load the object from the given ID.
                        try {
                            $object = \PHPerian\Request\Partial::fetchById($contents);
                        }
                        // If we did not get an object back, then an incorrect object ID was referenced.
                        catch(Exception $e) {
                            // If the user has set verbose mode on, throw the exception we caught.
                            if(self::$verbose) {
                                throw $e;
                            }
                            // If the user has set silent mode on, make a note of the error as a comment within the XML
                            // and continue onto the next iteration.
                            else {
                                $xml .= '<!-- Missing object "' . $contents . '". -->';
                                continue;
                            }
                        }
                        // If we successfully returned an object, grab the class name (strip out any namespacing) so
                        // we can use it as the element name.
                        $class = explode('\\', get_class($object));
                        $class = end($class);
                        // Ask the object to generate its own XML so we can wrap it in tags by the same name, and
                        // insert it into the XML we are generating in this iteraction.
                        $xml .= '<' . $class . '>' . $object->generateXML() . '</' . $class . '>';
                        break;

                    // If the element is a string and the contents is another structure to iterate over, then
                    // recursively call this method again.
                    case is_string($element) && is_array($contents):
                        // If the contents array is associative, then we need to wrap them in $element tags.
                        $xml .= self::isAssoc($contents)
                            ? '<' . $element . '>' . $this->iterateStruct($contents, $current) . '</' . $element . '>'
                            : $this->iterateStruct($contents, $current);
                        break;

                    // If both the element and contents are a string, it's a simple tag and its value. Easy peasy.
                    case is_string($element) && is_string($contents):
                        $xml .= '<' . $element . '>' . $contents . '</' . $element . '>';
                        break;

                    // I can't remember what this does. This is why you should ALWAYS put comments in your code.
                    case is_string($element) && $contents === -1 && is_object($current):
                        $xml .= '<' . $element . '>' . $current->autoIncrement() . '</' . $element . '>';
                        break;

                    // We could not match this partcular configuration of data types.
                    default:
                        // If the user has set verbose mode on, throw an exception because they don't want to continue
                        // with errors.
                        if(self::$verbose) {
                            throw new Exception();
                        }
                        // However, if the user has set silent mode on, continue with the next iteration because its not
                        // a fatal error. Ish.
                        continue;
                        break;
                }
            }
            return $xml;
        }

        /**
         * Generate XML
         *
         * @access public
         * @return string|false
         */
        public function generateXML()
        {
            // If the class that is calling this method does not have a class member array called $struct, then return
            // false.
            if(!isset($this->struct) || !is_array($this->struct)) {
                return false;
            }
            // Start iterating over the structure array, and return the output.
            return $this->iterateStruct($this->struct, $this);
        }

        /**
         * Auto-Increment
         *
         * @access public
         * @return integer
         */
        public function autoIncrement()
        {
            $class = get_called_class();
            if(!isset(self::$incrementers[$class]) || !is_array(self::$incrementers[$class])) {
                self::$incrementers[$class] = array();
            }
            if(!isset(self::$incrementers[$class][$this->id()])) {
                self::$incrementers[$class][$this->id()] = (string) (count(self::$incrementers[$class]) + 1);
            }
            return self::$incrementers[$class][$this->id()];
        }

        /**
         * Set Verbose Exceptions
         *
         * @static
         * @access public
         * @return void
         */
        public static function verbose()
        {
            self::$verbose = true;
        }

        /**
         * Set Silent Exceptions (Continue Chaining)
         *
         * @static
         * @access public
         * @return void
         */
        public static function silent()
        {
            self::$verbose = false;
        }

        /**
         * Get Mode
         *
         * @static
         * @access public
         * @return string
         */
        public static function mode()
        {
            return self::$verbose ? 'verbose' : 'silent';
        }

        /**
         * Get Called Method
         *
         * @static
         * @access protected
         * @param boolean $include_class
         * @return string
         */
        protected static function getCalledMethod($iterations = 1)
        {
            // Fetch the backtrace for debugging of execution flow.
            $trace = debug_backtrace();
            if(!is_int($iterations) || $iterations < 1) {
                throw new Exception(
                    'Incorrect data format passed to ' . __METHOD__ . ', a positive integer is required.',
                    self::INVALID_DATA_FORMAT
                );
            }
            // We want to know what the method was that called the method that called this function, so shift the trace
            // array the correct amount of times. The $iterations variables allows this method to find, for example, the
            // name of the method that called the method, that called the method, that called this method. Long-winded,
            // but useful :)
            for($i = -1; $i <= $iterations; $i++) {
                $caller = array_shift($trace);
            }
            // Grab the name of the method we want.
            $method = $caller['function'];
            // Providing the calling method was part of a class and not a procedural function, include it in the method
            // identifier string.
            if(isset($caller['class'])) {
                $method = $caller['class'] . '::' . $method;
            }
            return $method;
        }

        /**
         * Validate: Boolean
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param mixed $true
         * @param mixed $false
         * @throws \PHPerian\Exception
         * @return boolean | $this
         */
        protected function validateBoolean(&$structureElement, array $arguments = array(), $true = self::BOOLEAN_TRUE, $false = self::BOOLEAN_FALSE)
        {
            // If no arguments were passed to the method that called this one, it obviously means that they want the
            // value that has already been set returned.
            if(!is_array($arguments) || count($arguments) === 0) {
                return !is_null($structureElement)
                    ? $structureElement == $true
                    : null;
            }

            // If, however, arguments were passed to the method that called this one, it means they want to set the
            // value. We'll perform some checks first though.
            // If verbose mode is on (also acting as "strict" mode here), throw an exception if we have too many
            // arguments passed.
            if(self::$verbose && count($arguments) > 1) {
                throw new Exception(
                    'Only one parameter should be passed to ' . self::getCalledMethod() . '.',
                    self::TOO_MANY_ARGUMENTS
                );
            }
            // If versbose mode is on (also acting as "strict" mode here), throw an exception if a non-boolean parameter
            // was passed.
            if(self::$verbose && !is_bool($arguments[0])) {
                throw new Exception(
                    'You are required to pass a boolean data type to ' . self::getCalledMethod() . ' when in verbose mode.',
                    self::INVALID_DATA_FORMAT
                );
            }
            // We passed error checking, set the value.
            $structureElement = $arguments[0]
                ? $true
                : $false;
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Validate: Generic String
         *
         * @access private
         * @param reference $structureElement
         * @param array $arguments
         * @param integer $max_chars
         * @param string $pcre
         * @param boolean $fixed_length
         * @throws \PHPerian\Exception
         * @return boolean | $this
         */
        private function validateString(&$structureElement, array $arguments = array(), $max_chars, $pcre, $fixed_length = false)
        {
            // If no arguments were passed to the method that called this one, it obviously means that they want the
            // value that has already been set returned.
            if(!is_array($arguments) || count($arguments) === 0) {
                return !is_null($structureElement)
                    ? $structureElement
                    : null;
            }
            // If, however, arguments were passed to the method that called this one, it means they want to set the
            // value. We'll perform some checks first though.

            // These checks are fundamental, as the method cannot work if these don't pass. Don't suppress these
            // Exceptions when silent mode is on.
            if(!is_int($max_chars)) {
                throw new Exception();
            }
            if(!is_string($pcre)) {
                throw new Exception();
            }
            // If verbose mode is on (also acting as "strict" mode here), throw an exception if we have too many
            // arguments passed.
            if(self::$verbose && count($arguments) > 1) {
                throw new Exception(
                    'Only one parameter should be passed to ' . self::getCalledMethod(2) . '.',
                    self::TOO_MANY_ARGUMENTS
                );
            }
            // We will also allow integers as input, but change them to strings so that we can parse them.
            if(is_int($arguments[0])) {
                $arguments[0] = (string) $arguments[0];
            }
            //
            $regex = '/^' . $pcre . '{' . ($fixed_length ? '' : '1,') . $max_chars . '}' . '$/';
            // Make sure that the original parameter input is a string and conforms to the 
            if(!is_string($arguments[0]) || !preg_match($regex, $arguments[0])) {
                // If verbose mode is on, throw an Exception as the value passed was incorrect.
                if(self::$verbose) {
                    throw new Exception();
                }
                // If silent mode is on, return normally without setting any value.
                else {
                    return $this;
                }
            }
            // We passed error checking, set the value.
            $structureElement = $arguments[0];
            // Return a copy of this instance to allow chaining.
            return $this;
        }

        /**
         * Validate: Alpha
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param integer $max_chars
         * @param boolean $fixed_length
         * @throws \PHPerian\Exception
         * @return string | $this
         */
        protected function validateAlpha(&$structureElement, array $arguments = array(), $max_chars, $fixed_length = false)
        {
            return $this->validateString($structureElement, $arguments, $max_chars, self::PCRE_ALPHA, $fixed_length);
        }

        /**
         * Validate: Numeric
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param integer $max_chars
         * @throws \PHPerian\Exception
         * @return integer | $this
         */
        protected function validateNumeric(&$structureElement, array $arguments = array(), $max_chars)
        {
            $return = $this->validateString($structureElement, $arguments, $max_chars, self::PCRE_NUMERIC);
            if(is_string($return) && is_numeric($return)) {
                $return = (int) $return;
            }
            return $return;
        }

        /**
         * Validate: Alphanumeric
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param integer $max_chars
         * @param boolean $fixed_length
         * @throws \PHPerian\Exception
         * @return string | $this
         */
        protected function validateAlphaNumeric(&$structureElement, array $arguments = array(), $max_chars, $fixed_length = false)
        {
            return $this->validateString($structureElement, $arguments, $max_chars, self::PCRE_ALPHANUMERIC, $fixed_length);
        }

        /**
         * Validate: Alphanumeric (Extended)
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param integer $max_chars
         * @param boolean $fixed_length
         * @throws \PHPerian\Exception
         * @return string | $this
         */
        protected function validateAlphaNumericExtra(&$structureElement, array $arguments = array(), $max_chars, $fixed_length = false)
        {
            return $this->validateString($structureElement, $arguments, $max_chars, self::PCRE_ALPHANUMERIC_EXTRA, $fixed_length);
        }

        /**
         * Validate: Date
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @throws \PHPerian\Exception
         * @return string | $this
         */
        protected function validateDate(&$structureElement, array $arguments = array()) {}

        /**
         * Validate: Set
         *
         * @access protected
         * @param reference $structureElement
         * @param array $arguments
         * @param array $set
         * @throws \PHPerian\Exception
         * @return string | $this
         */
        protected function validateSet(&$structureElement, array $arguments = array(), array $set = array())
        {
            // If no arguments were passed to the method that called this one, it obviously means that they want the
            // value that has already been set returned.
            if(!is_array($arguments) || count($arguments) === 0) {
                return !is_null($structureElement)
                    ? $structureElement
                    : null;
            }

            // If, however, arguments were passed to the method that called this one, it means they want to set the
            // value. We'll perform some checks first though.
            // If verbose mode is on (also acting as "strict" mode here), throw an exception if we have too many
            // arguments passed.
            if(self::$verbose && count($arguments) > 1) {
                throw new Exception(
                    'Only one parameter should be passed to ' . self::getCalledMethod() . '.',
                    self::TOO_MANY_ARGUMENTS
                );
            }
            // Make sure that the input is a string.
            if(!is_string($arguments[0])) {
                if(self::$verbose) {
                    throw new Exception(
                        'You are required to pass a string data type to ' . self::getCalledMethod() . ' when in verbose mode.',
                        self::INVALID_DATA_FORMAT
                    );
                }
                else {
                    return $this;
                }
            }
            // Make sure the value passed is a valid option in the set.
            if(count($matched = preg_grep('/^' . preg_quote($arguments[0], '/') . '$/i', $set)) < 1)  {
                if(self::$verbose) {
                    throw new Exception(
                        'The value passed to ' . self::getCalledMethod() . ' is not a valid option in the defined set.',
                        self::INVALID_OPTION
                    );
                }
                else {
                    return $this;
                }
            }
            // We passed error checking, set the value. Make sure to use the one from the set, so that the correct case
            // is used.
            $structureElement = reset($matched);
            // Return a copy of this instance to allow chaining.
            return $this;
        }

    }