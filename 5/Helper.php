<?php

    class Helper {
        
        /**
         * Get the current position in web app 
         * "https://example/current/File.php?param=value" => "/current/file.php"
         *
         * @return string return current file direction path
         */
        public static function get_path(){
            // current position full path
            $current = $_SERVER['REQUEST_URI'];

            // get params starts position
            $param_start_pos = strpos($current, "?");
            // count value to trim
            $trim_pos = $param_start_pos ?: strlen($current);

            // trim properties
            $result = substr($current, 0, $trim_pos);
            // return path in lowercase
            return strtolower($result);
        }

    }

    // output: "/tasks/helper.php"
    echo Helper::get_path();

?>