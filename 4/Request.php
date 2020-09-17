<?php

    class Request {
        
        /**
         * Check request value and data type
         *
         * @param  mixed    $request    $_GET or $_POST method answer
         * @param  string   $data_type  str | int data_type to check
         * @return mixed                false: validation error | $data_type typed value
         */
        private static function check_request($request, $data_type) {
            // check request data type
            $data_type_check = $data_type === "str" ? is_string($request) : is_numeric($request);
            
            // if data type doesn't match
            if(!$data_type_check)
                return false;

            return $data_type === "str" ? $request : (int)$request;
        }
        
        /**
         * GET request
         *
         * @param  string   $key            request's key. $_GET[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @param  string   $data_type      str | int for request's data type check
         * @return mixed                    $data_type typed request value or $default
         */
        public static function get($key, $default = "", $data_type = "str") {
            // return $default if null or empty
            if(!isset($_GET[$key]) || empty($_GET[$key]))
                return $default;

            // check request
            $security = Request::check_request($_GET[$key], $data_type);

            // return value
            return $security ?: $default;
        }

        /**
         * POST request
         *
         * @param  string   $key            request's key. $_POST[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @param  string   $data_type      str | int for request's data type check
         * @return mixed                    $data_type typed request value or $default
         */
        public static function post($key, $default = "", $data_type = "str") {
            // return $default if null or empty
            if(!isset($_POST[$key]) || empty($_POST[$key]))
                return $default;

            // check request
            $security = Request::check_request($_POST[$key], $data_type);

            // return value
            return $security ?: $default;
        }

        // Aliases
        /**
         * POST request with a integer return value
         *
         * @param  string   $key            request's key. $_GET[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @return mixed                    integer request value or $default
         */
        public static function getInt($key, $default = "") {
            return Request::get($key, $default, "int");
        }

        /**
         * POST request with a string return value
         *
         * @param  string   $key            request's key. $_GET[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @return mixed                    string request value or $default
         */
        public static function getStr($key, $default = "") {
            return Request::get($key, $default, "str");
        }

        /**
         * POST request with a integer return value
         *
         * @param  string   $key            request's key. $_POST[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @return mixed                    integer request value or $default
         */
        public static function postInt($key, $default = "") {
            return Request::post($key, $default, "int");
        }

        /**
         * POST request with a string return value
         *
         * @param  string   $key            request's key. $_POST[$key]
         * @param  mixed    $default        value to return if the request didn't pass security filters
         * @return mixed                    string request value or $default
         */
        public static function postStr($key, $default = "") {
            return Request::post($key, $default, "str");
        }

    }

?>