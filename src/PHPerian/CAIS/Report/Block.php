<?php

    namespace PHPerian\CAIS\Report;

    use \PHPerian\CAIS\Report\Block\Header;
    use \PHPerian\CAIS\Report\Block\Body;
    use \PHPerian\CAIS\Report\Block\Footer;
    use \PHPerian\CAIS\Interfaces\Attribute as AttributeInterface;
    use \PHPerian\Exceptions;

    class Block
    {

        protected $header;
        protected $body;
        protected $footer;

        public function __construct($source, $name, $sharing = null, $cutoff = null, $version = null)
        {
            $this->header = new Header($source, $name, $sharing, $cutoff, $version);
            $this->body = new Body;
            $this->footer = new Footer;
        }

        public function fetchHeader()
        {
            return $this->header;
        }

        public function fetchBody()
        {
            return $this->body;
        }

        public function fetchFooter()
        {
            return $this->footer;
        }

        /**
         * Get: CAIS String
         *
         * @access public
         * @return string
         */
        public function getString()
        {
            $this->fetchFooter()->totalNumberOfRecords = count($this->fetchBody());
            return trim(preg_replace('/\\n+/', "\n", implode("\n", array($this->fetchHeader(), $this->fetchBody(), $this->fetchFooter()))), "\n");
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
