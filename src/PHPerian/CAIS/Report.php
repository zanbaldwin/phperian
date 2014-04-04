<?php

    namespace PHPerian\CAIS;

    use \PHPerian\CAIS\Report\Block;
    use \PHPerian\Exceptions;

    class Report implements \ArrayAccess
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
        public function createBlock($id, $source, $name, $sharing = null, $cutoff = null, $version = null)
        {
            if(!is_scalar($id) && $id !== null) {
                throw new Exceptions\InvalidArgument('Block ID must be a string or integer.');
            }
            $block = new Block($source, $name, $sharing, $cutoff, $version);
            $id !== null
                ? $this->blocks[$id] = $block
                : $this->blocks[] = $block;
            return $block;
        }

    }
