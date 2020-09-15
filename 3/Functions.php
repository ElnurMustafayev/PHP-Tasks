<?php

    include "./User/User.php";

    class Functions {
        

        /**
         * Generate 32 size Guid string
         *
         * @return string   GUID string like "4F4FEB1AC312D9C852E67D1FEADC5ADE"
         */
        static public function getGUID() : string {
            return function_exists('com_create_guid') 
                ? com_create_guid() 
                : strtoupper(md5(uniqid(rand(), true)));
        }
        
        static public function array_value_exists($needle, array $arr) : bool {
            foreach ($arr as $key => $value) 
                // 123 == "123" => true
                if($value == $needle)
                    return true;

            return false;
        }

                
        /** Task 3
         * Check if email input correctly
         *
         * @param  string   $str    email string
         */
        static public function EmailCheck(string $str) : bool {
            return filter_var($str, FILTER_VALIDATE_EMAIL) !== false;
        }

    }

?>