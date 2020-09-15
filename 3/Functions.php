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



        /** Task 2
         * Encrypt/Decrypt password
         *
         * @param  string $id           user's id
         * @param  string $password     user's password
         * @return string               encrypted/decrypted password
         */
        static public function EncryptUserPassword(string $id, string $password) : string {
            $result = "";
            $keys = str_split($id);
            $chars = str_split($password);

            for ($i=0; $i < strlen($password); $i++)
                $result .= $chars[$i] ^ $keys[$i % strlen($id)];

            return $result;
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