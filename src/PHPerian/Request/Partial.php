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

        const PCRE_NUMERIC              = '[0-9]';
        const PCRE_ALPHA                = '[a-zA-Z]';
        const PCRE_ALPHANUMERIC         = '[a-zA-Z0-9]';
        const PCRE_ALPHANUMERIC_EXTRA   = '[a-zA-Z0-9\\-&\\.\'\\/\\\\\\(\\)@ ]';
        const PCRE_BOOLEAN              = '[YN]';
        const INVALID_DATA_FORMAT       = 1;

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
            if(preg_match('/^create([A-Z].*)$/', $method, $matches)) {
                // Make sure that the class specified in the method exists as a Request sub-class.
                $class = '\\' . __CLASS__ . '\\' . $matches[1];
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
                self::$incrementers[$class][$this->id()] = count(self::$incrementers[$class]) + 1;
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

    }