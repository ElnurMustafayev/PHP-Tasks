<?php

    class Request {
        
        /**
         * Check request value and data type
         *
         * @param  mixed    $request    $_GET or $_POST method answer
         * @param  string   $data_type  str | int data_type to check
         * @return bool                 true: if passed security filters
         */
        private static function check_request($request, $data_type) {
            // create flag
            $security = true;

            // if null or empty
            if(!isset($request) || empty($request))
                $security = false;

            // check request data type
            $data_type_check = $data_type === "str" ? is_string($request) : is_numeric($request);
            
            // if data type doesn't match
            if(!$data_type_check)
                $security = false;

            // return flag
            return $security;
        }
        
        /**
         * GET request
         *
         * @param  string   $key            request's key. $_GET[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @param  string   $data_type      str | int for request's data type check
         * @return mixed                    request value or $default
         */
        public static function get($key, $default = "default", $data_type = "str") {
            // check request
            $security = Request::check_request($_GET[$key], $data_type);

            // return value
            return $security ? $_GET[$key] : $default;
        }

        /**
         * POST request
         *
         * @param  string   $key            request's key. $_POST[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @param  string   $data_type      str | int for request's data type check
         * @return mixed                    request value or $default
         */
        public static function post($key, $default = "default", $data_type = "str") {
            // check request
            $security = Request::check_request($_POST[$key], $data_type);

            // return value
            return $security ? $_POST[$key] : $default;
        }

    }

?>