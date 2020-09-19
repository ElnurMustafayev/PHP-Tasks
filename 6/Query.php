<?php

class Query {
    public $select = "";
    public $from = "";
    public $where = "";
    public $where_or = "";
    public $order_by = "";
    public $limit = "";

    public function Build() {
        return "$this->select $this->from $this->where $this->where_or $this->order_by $this->limit";
    }

    public function ResetQueryString() {
        $this->select = "";
        $this->from = "";
        $this->where = "";
        $this->where_or = "";
        $this->order_by = "";
        $this->limit = "";
    }

    // str|arr
    // ["id", "name"]: SELECT id, name
    public function select($select = "*") {
        $result = "";

        $result = is_array($select) ? implode(", ", $select) : $select;

        $this->select = "SELECT $result";

        return $this;
    }

    // str 
    // "users": FROM users
    public function from($table) {
        $this->from = "FROM $table";

        return $this;
    }

    // str|arr
    // ["id" => 1]: WHERE id = 1
    public function where($where) {
        $result = "";
        if(is_array($where))
            $result =   implode(" AND ", 
                                array_map(  function($v, $k) { return "$k = $v"; },
                                            $where, array_keys($where)));
        else
            $result = $where;

        $this->where = "WHERE $result";

        return $this;
    }

    // str|arr
    // ["id" => 10]: OR (id = 10)
    public function where_or($where_or) {
        $result = (new Query())->where($where_or)->where;

        $result = substr($result, strlen("WHERE "));

        $this->where_or = "OR (" . $result . ")";

        return $this;
    }

    // str, str
    // "id", "ASC" => ORDER BY id ASC
    public function order_by($what, $how = "DESC") {
        
        $this->order_by = "ORDER BY $what " . strtoupper($how);

        return $this;
    }

    // int|str, int|null
    // 0, NULL: LIMIT 0
    public function limit($start, $stop) {
        $part = $stop ? ", $stop" : "";
        $this->limit = "LIMIT $start $part";

        return $this;
    }

    // PDO
    // resurns: row|false
    public function get_row($connection) {
        if(empty($connection))
            exit("Connection to server failed!");
        
        try {
            $sql   = $this->Build();
            $query = $connection->prepare( $sql );
            $query->execute();
            $row = $query->fetch( PDO::FETCH_ASSOC );
        }
        catch(Exception $ex) {
            exit($ex->getMessage());
        }

        $this->ResetQueryString();
        return $row ?: false;
    }

    // PDO
    // returns: results|false
    public function get_results($connection) {
        if(empty($connection))
            exit("Connection to server failed!");

        $results = null;

        try {
            $sql   = $this->Build();
            $query = $connection->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll( PDO::FETCH_ASSOC );
        }
        catch(Exception $ex) {
            exit($ex->getMessage());
        }

        $this->ResetQueryString();
        return $results ?: false;
    }
}

?>