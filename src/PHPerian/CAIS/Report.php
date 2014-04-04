<?php

    namespace PHPerian\CAIS;

    use \PHPerian\CAIS\Report\Block;

    class Report implements ArrayAccess
    {

        protected $blocks = array();

        /**
         * Constructor
         *
         * @access public
         * @return void
         */
        public function __construct()
        {
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
                throw new InvalidAssignment('The CAIS report can only contain instances of the Block object.');
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
         * Create New Block
         *
         * @access public
         * @param integer $source
         * @param string $name
         * @param boolean $sharing
         * @param integer $cutoff
         * @param string $version
         * @return PHPerian\CAIS\Report\Block
         */
        public function createBlock($source, $name, $sharing = null, $cutoff = null, $version = null)
        {
            $block = new Block($source, $name, $sharing, $cutoff, $version);
            $this->blocks[] = $block;
            return $block;
        }

    }
