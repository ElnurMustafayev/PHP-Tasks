<?php

    interface IFileManager {
        function GetUsers();
        function AddPassword(string $userid, string $newpassword) : bool;
    }

    class UserFileManager implements IFileManager {
        private string $_fpath = "./Users.json";
                
        /**
         * Get users associative array 
         * ["id"] => ["password"]
         *
         * @return  array   false - if something went wrong
         */
        function GetUsers() {
            $users = [];

            // if filepath is true
            if(file_exists($this->_fpath)) {

            //if file is not empty
                if(filesize($this->_fpath) > 0) {
                    // open read
                    $file = fopen($this->_fpath, "r");
                    // read all users
                    $JSON = fread($file, filesize($this->_fpath));
                    // convert to assoc arr
                    $users = json_decode($JSON, true);
                    // dispose
                    fclose($file);
                }
            }

            // false if something went wrong
            return $users; // null
        }
        
        /**
         * Add password in file
         *
         * @param  string $userid       user's id
         * @param  string $newpassword  password to add
         * 
         * @return bool                 true => successful
         */
        function AddPassword(string $userid, string $newpassword) : bool {
            // get all users assoc array
            $users = $this->GetUsers();

            // if file exists
            if(file_exists($this->_fpath)) {

                // if password exists
                if(!Functions::array_value_exists($newpassword, $users)) {

                    // add or edit user
                    $users[$userid] = $newpassword;
                    // convert to JSON
                    $JSON = json_encode($users);

                    // open write
                    $file = fopen($this->_fpath, "w");
                    // write edited data
                    fwrite($file, $JSON);
                    // dispose
                    fclose($file);

                    // successful
                    return true;
                }

            }

            // if something went wrong
            return false;
        }
    }

?>