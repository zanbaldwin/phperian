<?php

    namespace PHPerian\CAIS;

    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;
    use \PHPerian\Exception;

    abstract class Collection implements \ArrayAccess, \IteratorAggregate, \Countable
    {

        protected $attributes = array();

        /**
         * Constructor: Create Attributes
         *
         * @access protected
         * @return void
         */
        public function __construct()
        {
            if(is_array($this->attributes) && !empty($this->attribute)) {
                // Do not re-run this constructor as the attibutes will be overwritten back to their defaults.
                return;
            }
            if(!isset(static::$attributeDefinitions) || !is_array(static::$attributeDefinitions) || empty(static::$attributeDefinitions)) {
                throw new Exceptions\InvalidDefinition('Missing attribute definitions for class ' . get_class($this));
            }
            foreach(static::$attributeDefinitions as $label => $attribute) {
                // Make sure the attribute label is valid.
                if(!preg_match('/^\\w+$/', $label)) {
                    $class = get_class($this);
                    throw new Exceptions\InvalidDefinition("Attribute label definition is missing a valid label for `{$class}` collection.");
                }
                if(!(isset($attribute['type']) && isset($attribute['start']) && isset($attribute['end']) && isset($attribute['name']))) {
                    $class = get_class($this);
                    throw new Exceptions\InvalidDefinition("Missing required definition parameters for \"{$label}\" attribute in `{$class}` collection.");
                }
                // Create the attribute.
                if(!is_object($attributeInstance = $this->createAttribute($attribute))) {
                    $class = get_class($this);
                    throw new Exceptions\InvalidDefinition("Defined attribute type for \"{$label}\" in `{$class}` collection does not exist.");
                }
                $this->attributes[$label] = $attributeInstance;
                unset($attributeInstance);
                // We need to do some extra processing for the Boolean attribute - set what we want to display for our
                // true and false values.
                if($attribute['type'] === AttributeInterface::BOOLEAN && isset($attribute['booleanflags'])) {
                    try {
                        $this->attributes[$label]->setFlags($attribute['booleanflags']);
                    }
                    // Catch any exceptions are thrown, send the same error message but we want the exception to be of
                    // type InvalidDefinition so that it's easier to track down the fault.
                    catch(Exception $e) {
                        throw new Exceptions\InvalidDefinition($e->getMessage());
                    }
                }
            }
        }

        /**
         * Create Attribute
         *
         * @access private
         * @param string $attribute
         * @return AttributeInterface
         */
        private function createAttribute($attribute)
        {
                $nsclass = '\\' . preg_replace('/\\\\+/', '\\', ltrim(AttributeInterface::ATTRIBUTE_NS . '\\' . $attribute['type'], '\\'));
                if(!class_exists($nsclass)) {
                    return false;
                }
                $argumentsList = array(
                    $attribute['start'],
                    $attribute['end'],
                    $attribute['name'],
                    isset($attribute['default']) ? $attribute['default'] : null,
                    isset($attribute['justification']) ? $attribute['justification'] : null,
                    isset($attribute['padding']) ? $attribute['padding'] : null,
                );
                // Use the Reflection classes to create a new instance of the attribute class (passing the constructor
                // parameters as a dynamic array).
                $reflection = new \ReflectionClass($nsclass);
                return $reflection->newInstanceArgs($argumentsList);
        }

        /**
         * Magic Method: Get Attribute Value
         *
         * @access public
         * @param string $offset
         * @return mixed
         */
        public function __get($offset)
        {
            if($offset === 'attributes') {
                return $this->setAttributes($value);
            }
            elseif(isset($this->attributes[$offset]) && is_object($this->attributes[$offset]) && $this->attributes[$offset] instanceof AttributeInterface) {
                return $this->attributes[$offset]->getValue();
            }
        }

        /**
         * Magic Method: Set Attribute Value
         *
         * @access public
         * @param string $offset
         * @param mixed $value
         * @return void
         */
        public function __set($offset, $value)
        {
            if($offset === 'attributes') {
                return $this->setAttributes($value);
            }
            if(isset($this->attributes[$offset]) && is_object($this->attributes[$offset]) && $this->attributes[$offset] instanceof AttributeInterface) {
                return $this->attributes[$offset]->setValue($value);
            }
            else {
                throw new Exceptions\InvalidAssignment("The attribute with identifier \"{$offset}\" does not exist in `{$class}` collection.");
            }
        }

        /**
         * Set: Mass-Assign Attributes
         *
         * @access public
         * @param array $assignments
         * @return void
         */
        public function setAttributes(array $assignments)
        {
            foreach($assignments as $attribute => $value) {
                if($value !== null && isset($this->attributes[$attribute]) && is_object($this->attributes[$attribute]) && $this->attributes[$attribute] instanceof AttributeInterface) {
                    $this->attributes[$attribute]->setValue($value);
                }
            }
        }

        /**
         * Get: Mass-Assign Attributes
         *
         * @access public
         * @return array
         */
        public function getAttributes()
        {
            $assignments = array();
            foreach($attributes as $identifier => $attribute) {
                if(is_object($attribute) && $attribute instanceof AttributeInterface) {
                    $assignments[$identifier] = $attribute->getValue();
                }
            }
            return $assignments;
        }

        /**
         * Magic Method: Call Attribute Method
         *
         * @access public
         * @param string $method
         * @param array $arguments
         * @return mixed
         */
        public function __call($method, array $arguments)
        {
            if(preg_match('/^(get|set|fetch)(\\w+)$/', $method, $matches)) {
                $attribute = strtolower(substr($matches[2], 0, 1)) . substr($matches[2], 1);
                if($this->offsetExists($attribute)) {
                    switch($matches[1]) {
                        case 'get':
                            return $this->offsetGet($attribute)->getValue();
                            break;
                        case 'set':
                            if(count($arguments) < 1) {
                                throw new Exceptions\InsufficientArguments("A value must be supplied for the attribute \"{$attribute}\" to be set.");
                            }
                            return $this->offsetGet($attribute)->setValue($arguments[0]);
                            break;
                        case 'fetch':
                            return $this->offsetGet($attribute);
                            break;
                    }
                }
            }
            $class = get_class($this);
            throw new Exceptions\UndefinedMethod("The method \"{$method}\" in class \"{$class}\" is not defined.");
        }

        /**
         * Offset: Exists
         *
         * @access public
         * @param mixed $offset
         * @return boolean
         */
        public function offsetExists($offset)
        {
            return isset($this->attributes[$offset]);
        }

        /**
         * Offset: Get
         *
         * @access public
         * @param mixed $offset
         * @return mixed
         */
        public function offsetGet($offset)
        {
            return $this->offsetExists($offset)
                ? $this->attributes[$offset]
                : null;
        }

        /**
         * Offset: Set
         *
         * @access public
         * @param mixed $offset
         * @param mixed $value
         * @return void
         */
        public function offsetSet($offset, $value)
        {
        }

        /**
         * Offset: Unset
         *
         * @access public
         * @param mixed $offset
         * @return void
         */
        public function offsetUnset($offset)
        {
        }

        /**
         * Get: Iterator
         *
         * @access public
         * @return \ArrayIterator
         */
        public function getIterator()
        {
            return new \ArrayIterator($this->attributes);
        }

        /**
         * Count Attributes
         *
         * @access public
         * @return integer
         */
        public function count()
        {
            return count($this->attributes);
        }

        /**
         * Get: CAIS Record String
         *
         * @access public
         * @return string|false
         */
        public function getString()
        {
            $record = '';
            foreach($this->attributes as $attribute) {
                $record = str_pad($record, $attribute->getEndByte(), "\0");
                $record = substr_replace($record, $attribute->getString(), $attribute->getStartByte(), $attribute->getEndByte());
            }
            return strpos($record, "\0") === false
                ? $record
                : false;
        }

        /**
         * Magic Method: To String
         *
         * @access public
         * @return string
         */
        public function __toString()
        {
            return $this->getString() ?: '';
        }

    }
