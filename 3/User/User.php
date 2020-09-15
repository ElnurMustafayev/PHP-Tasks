<?php

    include "./User/UserFileManager.php";

    class User {
        private static int $_id_count = 0;
        public string $_id;
        public string $_password;
        private IFileManager $_filemanager;

        function __construct(?IFileManager $filemanager = null) {
            //$this->_id = Functions::getGUID();
            $this->_id = strval(++User::$_id_count);
            $this->_filemanager = $filemanager ?? new UserFileManager;
        }
        
        /**
         * Add password if doesn't exist 
         * write in Users.json
         *
         * @param  string   $password   new user's password to add
         * @return bool     $status     true => successful
         */
        public function AddPassword(string $password) : bool {
            // md5() encryption
            $this->_password = md5($password);
            $answer = $this->_filemanager->AddPassword($this->_id, $this->_password);

            // if something went wrong
            if(!$answer)
                echo "Warning: Could not add '$password' password!" . "<br>";

            // send status
            return $answer;
        }
        
        /**
         * Set encrypted password 
         * (doesn't write password in .json file)
         *
         * @param  mixed $password
         * @return void
         */
        public function EncryptPassword(string $password) : string {
            return $this->_password = Functions::EncryptUserPassword($this->_id, $password);
        }
    }

?>