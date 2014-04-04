<?php

    namespace PHPerian\CAIS\Report;

    use \PHPerian\CAIS\Report\Block\Header;
    use \PHPerian\CAIS\Report\Block\Body;
    use \PHPerian\CAIS\Report\Block\Footer;

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

    }
