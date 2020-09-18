<?php

    class Database {
        
        /**
         * Insert new value(s) in the $table
         *
         * @param  string   $table      table name to insert
         * @param  array    $values     associative array [["k1" => "v1", "k2" => "v2"], ...]
         * @return mixed                execute value or exception
         */
        function insert($table, $values = []) {
            // (v1, v2), (v1, v2), (v1, v2), ...
            // glue all parametr2 values with comma
            $values_str =  implode(", ",
                            // (value1, value2, ...)
                            array_map(function($item) {
                                    return "(" . implode(",", array_values($item)) . ")";
                                }, $values));

            // (key1, key2, key3, ...)
            $keys_str = "(" . implode(",", array_keys($values[0])) . ")";

            // create sql query string
            $query = "INSERT INTO $table $keys_str VALUES $values_str;";

            echo $query;

            try {
                // if there is a connection to the server
                if(!isset($this->conn))
                    throw new Exception("Check your connection to the server", 404);

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

    $values =   [["name" => "Elnur", "phone" => 21424124],
                ["name" => "Ali", "phone" => 2362352]];
    
    (new Database())->insert("Users", $values);

?>