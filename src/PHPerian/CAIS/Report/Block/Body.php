<?php

    namespace PHPerian\CAIS\Report\Block;

    use \PHPerian\CAIS\Report\Block\Body\Record;
    use \PHPerian\Exceptions;

    class Body
    {

        protected $records;
        protected $attributes = array();

        public function __construct()
        {
            $this->records = new \SplObjectStorage;
        }

        /**
         * Add Record
         *
         * @access public
         * @param PHPerian\CAIS\Report\Block\Body\Record $record
         * @return void
         */
        public function addRecord(Record $record)
        {
            if(!$this->records->contains($record)) {
                $this->records->attach($record);
            }
        }

        /**
         * Remove Record
         *
         * @access public
         * @param PHPerian\CAIS\Report\Block\Body\Record $record
         * @return void
         */
        public function removeRecord(Record $record)
        {
            if($this->records->contains($record)) {
                $this->records->detach($record);
            }
        }

        /**
         * Get: CAIS String
         *
         * @access public
         * @return string
         */
        public function getString()
        {
            $body = '';
            foreach($this->records as $record) {
                $body .= $record . "\n";
            }
            return trim(preg_replace('/\\n+/', "\n", $body), "\n");
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
