<?php

    class Database {
        
        /**
         * Insert one new value in the $table
         *
         * @param  string   $table      table name to insert
         * @param  array    $values     associative array ["k1" => "v1", "k2" => "v2", ...]
         * @return mixed                return execute value or exit with exception
         */
        function insert($table, $values) {
            // if $values is empty
            if(empty($values))
                throw new Exception("There is nothing to insert");

            // if there is a connection to the server
            if(!isset($this->conn)) 
                exit("Error 404: Check your connection to the server");

            // (key1, key2, ...)
            $keys_str = "(" . implode(",", array_keys($values)) . ")";

            // (v1, v2, ...)
            $values_str =  "(" . implode(",", array_values($values)) . ")";

            // create sql query string
            $query = "INSERT INTO $table $keys_str VALUES $values_str;";

            try {
                // try to prepare query
                $insert = $this->conn->prepare($query);

                // if preparing failed
                if(!$insert)
                    throw new Exception("The database server cannot successfully prepared statement", 400);
                    
                // return execute value if successful
                return $insert->execute();
            }
            catch(Exception $ex) {
                // exit app with error
                exit("Error " . $ex->getCode() . ": " . $ex->getMessage());
            }
        }

    }

    $values =   ["name" => "Elnur", "phone" => 21424124, "address" => "Baku"];
    
    (new Database())->insert("Users", $values);

    // INSERT INTO Users (name,phone,address) VALUES (Elnur,21424124,Baku);

?>