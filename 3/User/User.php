<?php

    include "./User/UserFileManager.php";

    class User {
        public string $_id;
        public string $_password;
        private IFileManager $_filemanager;

        function __construct(?IFileManager $filemanager = null) {
            $this->_id = Functions::getGUID();
            $this->_filemanager = $filemanager ?? new UserFileManager;
        }

        public function AddPassword(string $password) : bool {
            $this->_password = md5($password);   // Secret123
            $answer = $this->_filemanager->AddPassword($this->_id, $this->_password);

            //if(!$answer)
            //    throw new Exception("Could not add new password!");

            echo "Could not add new password!";
            return $answer;
        }
    }

?>