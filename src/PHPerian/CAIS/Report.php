<?php

    namespace PHPerian\CAIS;

    use \PHPerian\Exceptions;
    use \PHPerian\CAIS\Report\Block;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;

    class Report implements \ArrayAccess, \IteratorAggregate, \Countable
    {

        protected $blocks = array();

        /**
         * Offset: Exists
         *
         * @access public
         * @param mixed $offset
         * @return boolean
         */
        public function offsetExists($offset)
        {
            return isset($this->blocks[$offset]);
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
                ? $this->blocks[$offset]
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
            if(!is_object($value) || !$value instanceof Block) {
                throw new Exceptions\InvalidAssignment('The CAIS report can only contain instances of the Block object.');
            }
            $this->blocks[$offset] = $value;
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
            unset($this->blocks[$offset]);
        }

        /**
         * Get: Iterator
         *
         * @access public
         * @return ArrayIterator
         */
        public function getIterator()
        {
            return new \ArrayIterator($this->blocks);
        }

        /**
         * Count
         *
         * @access public
         * @return integer
         */
        public function count()
        {
            return count($this->blocks);
        }

        /**
         * Create New Block
         *
         * @access public
         * @param integer|string $id
         * @param integer $source
         * @param string $name
         * @param boolean $sharing
         * @param integer $cutoff
         * @param string $version
         * @return PHPerian\CAIS\Report\Block
         */
        public function createBlock($id, $source, $name, $sharing = null, $cutoff = null, $version = null)
        {
            if($id !== null && !is_string($id) && !is_int($id)) {
                throw new Exceptions\InvalidArgument('Block ID must be a string or integer.');
            }
            if($this->offsetExists($id)) {
                throw new Exceptions\Duplicate('Cannot create block; ID already exists.');
            }
            $block = new Block($source, $name, $sharing, $cutoff, $version);
            $id !== null
                ? $this->blocks[$id] = $block
                : $this->blocks[] = $block;
            return $block;
        }

        /**
         * Get: CAIS String
         *
         * @access public
         * @return string
         */
        public function getString()
        {
            return trim(preg_replace('/\\n+/', "\n", implode("\n", $this->blocks)), "\n");
        }

        /**
         * Magic Method: To String
         *
         * @access public
         * @return string
         */
        public function __toString()
        {
            return $this->getString();
        }

    }
