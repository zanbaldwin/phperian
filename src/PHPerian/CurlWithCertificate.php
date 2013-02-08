<?php

    namespace PHPerian;

    class CurlWithCertificate
    {

        const CURL_NOT_INSTALLED    = 1;
        const INVALID_HTTP_VERB     = 2;
        const URL_NOT_SET           = 3;
        const CONTENT_BODY_REQUIRED = 4;

        // Define a list of supported HTTP methods (verbs) and state whether they require a content body with the
        // request. (-1) for an optional content body, 0 for none required, and 1 for required.
        protected static $verbs = array(
            'connect'   => -1,
            'delete'    => 0,
            'get'       => 0,
            'head'      => 0,
            'options'   => 0,
            'post'      => 1,
            'put'       => 1,
            'trace'     => -1,
        );
        protected $curl_defaults = array(
            // Automatically set the "Referer" header where it follows a "Location" redirect.
            CURLOPT_AUTOREFERER     => true,
            // Follow any "Location" headers that the server sends as part of the HTTP header.
            CURLOPT_FOLLOWLOCATION  => true,
            // Maximum amount of HTTP redirections to follow.
            CURLOPT_MAXREDIRS       => 10,
            // Force the use of a new connection instead of a cached one.
            CURLOPT_FRESH_CONNECT   => true,
            // The URL to fetch. This can also be set when initializing a session with curl_init().
            CURLOPT_URL             => 'http://127.0.0.1/',
            // Force the use of a specific HTTP version.
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            // Include the header in the output.
            CURLOPT_HEADER          => true,
            // Output verbose information. Writes output to STDERR, or the file specified using CURLOPT_STDERR.
            CURLOPT_VERBOSE         => true,
            // Return the transfer as a string of the return value of curl_exec() instead of outputting it out
            // directly.
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_CUSTOMREQUEST   => 'GET',
            // The full data to post in a HTTP "POST" operation. To post a file, prepend a filename with @ and use
            // the full path. The filetype can be explicitly specified by following the filename with the type in
            // the format ';type=mimetype'. This parameter can either be passed as a urlencoded string like
            // 'para1=val1&para2=val2&...' or as an array with the field name as key and field data as value.
            CURLOPT_POSTFIELDS      => false,
            // An array of HTTP header fields to set, in the format array('Content-type: text/plain',
            // 'Content-length: 100').
            CURLOPT_HTTPHEADER      => array(),
            // Don't bother verifying certificates, otherwise we'll have to ask the user of this class to specify a
            // file containing the certificates of trusted root certificate authorities - although the option in
            // available if they so wish.
            CURLOPT_SSL_VERIFYPEER  => false,
            // If the user wants to specifiy a file containing certificate authorities to verify the SSL options they
            // can, but it's not enabled by default (false).
            CURLOPT_CAINFO          => false,
        );

        /**
         * Class Constructor Method
         *
         * @access public
         * @return void
         */
        public function __construct()
        {
            if(!function_exists('curl_init')) {
                throw new \CException(
                    \Yii::t(
                        'nosco',
                        'This class ({{classname}}) depends on PHP\'s cURL extension, which is not currently installed.',
                        array(
                            '{{classname}}' => __CLASS__
                        )
                    ),
                    self::CURL_NOT_INSTALLED
                );
            }
        }

        /**
         * Set Certificate File
         *
         * @access public
         * @param string $file
         * @return boolean
         */
        public function setCertificate($file)
        {
            $file = realpath($file);
            if(is_string($file)) {
                $this->curl_defaults[CURLOPT_SSLCERT] = $file;
                return true;
            }
            return false;
        }

        /**
         * Set Certificate Password
         *
         * @access public
         * @param string $password
         * @return boolean
         */
        public function setCertificatePassword($password)
        {
            if(is_string($password)) {
                $this->curl_defaults[CURLOPT_SSLCERTPASSWD] = $password;
                return true;
            }
            return false;
        }

        /**
         * Set Certificate Authorities
         *
         * @access public
         * @param string $cafile
         * @return boolean
         */
        public function setCertificateAuthorities($cafile)
        {
            $cafile = realpath($cafile);
            if(is_string($cafile)) {
                $this->curl_defaults[CURLOPT_SSL_VERIFYPEER] = true;
                $this->curl_defaults[CURLOPT_CAINFO] = $cafile;
                return true;
            }
            return false;
        }

        /**
         * Set Private Keyfile
         *
         * @access public
         * @param string $keyfile
         * @return boolean
         */
        public function setPrivateKey($file)
        {
            $file = realpath($file);
            if(is_string($file)) {
                $this->curl_defaults[CURLOPT_SSLKEY] = $file;
                return true;
            }
            return false;
        }

        /**
         * GET Request
         *
         * Perform a simple get request on a URL and return the response.
         *
         * @access public
         * @param string|array $url
         * @return stdObject
         */
        public function get($url)
        {
            return $this->request('get', $url);
        }

        /**
         * POST Request
         *
         * Perform a simple POST request on a URL with the provided body and return the response.
         *
         * @access public
         * @param string|array $url
         * @param string|array $body
         * @return stdObject
         */
        public function post($url, $body)
        {
            return $this->request('post', $url, $body);
        }

        /**
         * HTTP Request
         *
         * Perform a HTTP request using the specified verb as the action. The URL must be supplied and the content body
         * is optional for certain verbs.
         * Valid verbs are GET, HEAD, POST, PUT, DELETE, TRACE, OPTIONS, CONNECT.
         *
         * @access public
         * @param string $verb
         * @param string|array $url
         * @param string|array $body
         * @return stdObject
         */
        public function request($verb, $url_headers, $body = null)
        {
            // Define the empty array that we will populate with cURL configuration options.
            $curl_options = array();

            // Make sure that the HTTP method (verb) that has been specified is valid.
            if(!is_string($verb) || !isset(self::$verbs[$verb = strtolower($verb)])) {
                throw new \CException(
                    \Yii::t(
                        'nosco',
                        'The HTTP method (verb) supplied to {{classmethod}} is invalid.',
                        array(
                            '{{classmethod}}' => __METHOD__,
                        )
                    ),
                    self::INVALID_HTTP_VERB
                );
            }
            // Great, we escaped the Exception. Set the HTTP method for cURL to use.
            $curl_options[CURLOPT_CUSTOMREQUEST] = strtoupper($verb);

            // Time to parse the URL and any additional headers that are specified.
            // Force the URL and additional headers parameter to be an array for consistancy.
            $url_headers = (array) $url_headers;
            // Next we need to ensure that the first element (zero-index - so do not specify a key) is a URL.
            if(!isset($url_headers[0]) || !is_string($url_headers[0])) {
                throw new \CException(
                    \Yii::t(
                        'nosco',
                        '{{classmethod}} requires a URL to be passed.',
                        array(
                            '{{classmethod}}' => __METHOD__,
                        )
                    ),
                    self::URL_NOT_SET
                );
            }
            // Next, make sure that the string passed actually validates as a URL.
            if(!filter_var($url_headers[0], FILTER_VALIDATE_URL)) {
                throw new \CException(
                    \Yii::t(
                        'nosco',
                        'The URL passed to {{classmethod}} is not valid.',
                        array(
                            '{{classmethod}}' => __METHOD__,
                        )
                    ),
                    self::INVALID_URL
                );
            }
            // Excellent, set the URL to cURL options, and remove it from the rest of the headers.
            $curl_options[CURLOPT_URL] = $url_headers[0];
            unset($url_headers[0]);

            // Define a new array for the headers to be used. This is so the array has default numeric indexes (which
            // cURL requires).
            $curl_headers = array();
            // Iterate through the remaining additional headers, parsing them as need be.
            foreach($url_headers as $header => $value) {
                // If either of the header or its value are not strings, then continue onto the next iteration because
                // we don't want to use them.
                if(!is_string($header) || !is_string($value)) {
                    continue;
                }
                // Trim both the header and its value of any whitespace that may mess up the regular expressions.
                $header = trim($header);
                $value = trim($value);
                // Check that the header and its value are both strings, and that the header conforms to (my
                // interpretation of) the RFC.
                // Headers can only contain alphanumeric characters and hyphens (or alternatively, our own implentation
                // of spaces INSTEAD of hyphens - not both - to auto-capitalise words).
                $header_regex = '/^([a-zA-Z0-9]+(\-[a-zA-Z0-9]+)*|[a-zA-Z0-9]+( [a-zA-Z0-9]+)*)$/';
                // Header values can contain printable ASCII characters, or CRLF/LF provided it is immediately followed
                // by a space or horizontal tab (this is referred to as Linear White Space).
                $value_regex  = '/^([\040-\176]|\r?\n[\040\011])*$/';
                // Now the check, make sure that the header and its value are strings, and they conform to their
                // respective regular expressions. If they don't, continue onto the next iteration.
                if(!preg_match($header_regex, $header) || !preg_match($value_regex, $value)) {
                    continue;
                }
                // If the header contains whitespace, then uppercase the first letter of each word, and hyphenate them.
                if(strpos($header, ' ') !== false) {
                    $header = str_replace(' ', '-', ucwords($header));
                }
                // We're done! Add them to the array that will be used as the headers option for the cURL request.
                $curl_headers[] = $header . ': ' . $value;
            }
            // After iterating through the headers and picking out the valid ones, add them to the cURL request options.
            $curl_options[CURLOPT_HTTPHEADER] = $curl_headers;

            // Next we need to determine whether the content body is required. If it is, then we need to make sure one
            // has actually been supplied.
            switch(self::$verbs[$verb]) {
                // If no content body is supplied when one is required, throw an exception and let the user deal
                // with it however they wish.
                case 1:
                    if(!is_string($body) && !is_array($body)) {
                        throw new \CException(
                            \Yii::t(
                                'nosco',
                                'The HTTP Method ({{verb}}) passed to {{classmethod}} requires a content body to be provided.',
                                array(
                                    '{{classmethod}}' => __METHOD__,
                                    '{{verb}}' => strtoupper($verb),
                                )
                            ),
                            self::CONTENT_BODY_REQUIRED
                        );
                    }
                    break;
                // If no content body is required, then discard the one supplied (if any).
                case 2:
                    $body = null;
                    break;
            }
            // If the content body has not been discarding, then add it to the cURL request options.
            if(!is_null($body)) {
                $curl_options[CURLOPT_POSTFIELDS] = $body;
            }

            // Success, we have configured the cURL options to make the correct request! Let's do it!
            // Obviously, we'll call the NCurlWithCertificate::curl() method and return the result.
            return $this->curl($curl_options);
        }

        /**
         * Perform cURL Execution
         *
         * @access protected
         * @param array $options
         * @return stdObject
         */
        protected function curl($options)
        {
            // Start a new cURL instance.
            $curl_handle = curl_init();
            // Merge the user array options with the default options.
            $curl_options = $this->curl_defaults;
            // Only merge the two arrays if the options passed to this method is actually an array!
            if(is_array($options)) {
                // Iterate through each option and...
                foreach($options as $curlopt => $option) {
                    // If the default configuration array has that particular option, then...
                    if(isset($curl_options[$curlopt])) {
                        // Replace the default value with the value passed to this method!
                        $curl_options[$curlopt] = $option;
                    }
                }
            }
            // Set the options that have been determined from the defaults merged with instance-specific values.
            curl_setopt_array($curl_handle, $curl_options);
            // Make the request and grab the response.
            $response = curl_exec($curl_handle);
            // Check for errors. If there was an error throw an exception for the user to deal with (don't forget to add
            // the cURL error message and number).
            $errno = curl_errno($curl_handle);
            if($response === false || $errno > 0) {
                throw new \CException(
                    \Yii::t(
                        'nosco',
                        "A failure occured whilst making a {{verb}} request to: {{url}}\ncURL returned the error \"{{error}}\".",
                        array(
                            '{{verb}}' => $curl_options[CURLOPT_CUSTOMREQUEST],
                            '{{url}}' => $curl_options[CURLOPT_URL],
                            '{{error}}' => curl_error($curl_handle),
                        )
                    ),
                    $errno
                );
            }

            // Grab information about the cURL request. Parts of this may be useful for the user of this class, so we'll
            // mix in our response headers and body into this information and return it all as a single object.
            $info = curl_getinfo($curl_handle);
            // Instead of splitting tat the first bottleneck (2 consecutive CR+LF's), get the length of the header
            // section. This prevents incorrect bisecting of header and body when two header blocks are provided (after
            // a 100 Continue header).
            $header_length = $info['header_size'];
            // Fetch our headers, and split into an array.
            $header_string = rtrim(substr($response, 0, $header_length));
            $headers = explode("\r\n", $header_string);
            // Make sure the variable holding the header names and values exists.
            if(!isset($info['headers']) || !is_array($info['headers'])) {
                $info['headers'] = array();
            }
            // Iterate through the headers, split them into name and value components and save them to the headers array
            // inside the cURL information variable - in the format array('Header-Name' => 'header value').
            foreach($headers as $header) {
                // Trim any unnecessary whitespace from the individual header string.
                $header = trim($header);
                // Make sure that there is actually a header string on this line, and that it follows "^/.*\:.*/$".
                if(!$header || ($pos = strpos($header, ':')) === false) {
                    continue;
                }
                // Grab each part of the header string.
                $header_name = trim(substr($header, 0, $pos));
                $header_value = trim(substr($header, $pos + 1));
                // Save them to the information array.
                $info['headers'][$header_name] = $header_value;
            }
            // Fetch our body content.
            $body = ltrim(substr($response, $header_length));

            // Construct the stdClass object that we will be returning.
            $return = (object) array(
                'url' => $info['url'],
                'code' => $info['http_code'],
                'headers' => $info['headers'],
                'body' => $body,
            );
            return $return;
        }

    }