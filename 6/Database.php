<?php

include "./Query.php";

class Database
{
    private $conn;
    public $query_builder;

    function __construct()
    {
        $this->query_builder = new Query();
    }

	/* added by Rahim Suleymanov */
	public function connect ( $localhost, $username, $password, $database )
	{
		if ( empty( $localhost ) )
		{
			exit( 'Error: database host address is empty!' );
		}
		else if ( empty( $username ) )
		{
			exit( 'Error: database username is empty!' );
		}
		else if ( empty( $database ) )
		{
			exit( 'Error: database name is empty!' );
		}
		//      disabled for localhost
		//
		//		else if ( empty( $password ) )
		//		{
		//			exit( 'Error: database user password is empty!' );
		//		}
		else
		{
			try
			{
				$this->conn = new PDO( 'mysql:host=' . $localhost . ';dbname=' . $database . ';charset=utf8', $username, $password );
				$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			}
			catch ( PDOException $e )
			{
				exit( 'Error: ' . $e->getMessage() );
			}
		}
	}

	/* added by Asker Ali */
	public function update ( $table, $set = [], $where = [] )
	{
		if ( $this->conn )
		{
			$output       = implode( ' , ', array_map( function ( $v, $k ) {
				return $k . ' =" ' . $v . ' " ';
			}, $set, array_keys( $set ) ) );
			$where_output = implode( ' AND ', array_map( function ( $v, $k ) {
				return $k . ' =" ' . $v . ' " ';
			}, $where, array_keys( $where ) ) );

			try
			{
				$sql    = " UPDATE  $table SET $output  WHERE $where_output ";
				$update = $this->conn->prepare( $sql );
				if ( $update->execute() )
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			catch ( PDOException $e )
			{
				exit( 'Error: ' . $e->getMessage() );
			}
		}
		else
		{
			exit( 'Error: you should connect database!' );
		}
	}

	/* added by Rahim Suleymanov */
	public function get_row ( $table, $where = [], $order = '' )
	{
		if ( $this->conn )
		{
			if ( is_array( $where ) && ! empty( $where ) )
			{
				$keys = ' WHERE ' . implode( ' = ? AND ', array_keys( $where ) ) . ' = ?';
			}
			else
			{
				$keys = '';
			}

			if ( is_string( $order ) && ! empty( $order ) )
			{
				$order = ' ORDER BY ' . $order;
			}
			else
			{
				$order = '';
			}

			$sql   = 'SELECT * FROM ' . $table . $keys . $order;
			$query = $this->conn->prepare( $sql );
			$query->execute( array_values( $where ) );
			$row = $query->fetch( PDO::FETCH_ASSOC );

			return $row ? $row : [];
		}
		else
		{
			exit( 'Error: you should connect database!' );
		}
	}

	/* added by Rahim Suleymanov */
	public function delete ( $table, $where = [] )
	{
		if ( $this->conn )
		{
			if ( is_array( $where ) && ! empty( $where ) )
			{
				$keys = ' WHERE ' . implode( '= ? AND ', array_keys( $where ) ) . ' = ?';
			}
			else
			{
				$keys = [];
			}

			$sql    = 'DELETE FROM ' . $table . $keys;
			$remove = $this->conn->prepare( $sql );
			$done   = $remove->execute( array_values( $where ) );

			return $done ? TRUE : FALSE;
		}
		else
		{
			exit( 'Baza ilə əlaqə zamanı bir xəta oldu! ' );
		}
	}

	/* added by Rahim Suleymanov */
	public function get_results ( $table, $where = [], $order = '', $start = 0, $limit = 0 )
	{
		if ( $this->conn )
		{
			if ( is_array( $where ) && ! empty( $where ) )
			{
				$keys = ' WHERE ' . implode( ' = ? AND ', array_keys( $where ) ) . ' = ?';
			}
			else
			{
				$keys = '';
			}

			if ( is_string( $order ) && ! empty( $order ) )
			{
				$order = ' ORDER BY ' . $order;
			}
			else
			{
				$order = '';
			}

			if ( is_numeric( $start ) && $start >= 0 )
			{
				$limit = ' LIMIT ' . $start;

				if ( is_numeric( $limit ) && $limit > 0 )
				{
					$limit .= ', ' . $limit;
				}
			}
			else
			{
				$limit = '';
			}

			$sql   = 'SELECT * FROM ' . $table . $keys . $order . $limit;
			$query = $this->conn->prepare( $sql );
			$query->execute( array_values( $where ) );
			$row = $query->fetchAll( PDO::FETCH_ASSOC );

			return $row;
		}
		else
		{
			exit( 'Error: you should connect database!' );
		}
	}

	/* added by Elnur Mustafayev */
	/**
	 * Insert one new value in the $table
	 *
	 * @param string $table table name to insert
	 * @param array $values associative array ["k1" => "v1", "k2" => "v2", ...]
	 *
	 * @return mixed                return execute value or exit with exception
	 *
	 */
	function insert ( $table, $values )
	{
		if ( ! isset( $this->conn ) )
		{
			exit( 'Error: you should connect database!' );
		}

		if ( empty( $values ) )
		{
			throw new Exception( 'There is nothing to insert.' );
		}

		$keys_str   = '(' . implode( ",", array_keys( $values ) ) . ')';
		$values_str = '(' . implode( ",", array_values( $values ) ) . ')';

		$query = "INSERT INTO $table $keys_str VALUES $values_str;";

		try
		{
			$insert = $this->conn->prepare( $query );

			if ( ! $insert )
			{
				throw new Exception( 'The database server cannot successfully prepared statement', 400 );
			}

			return $insert->execute();
		}
		catch ( Exception $ex )
		{
			exit( 'Error: ' . $ex->getMessage() );
		}
    }

    // DELETEIT
    public function findAdmin() {
        // output: SELECT id, name FROM users WHERE id = 5 AND name = Elnur OR (name = Ali) ORDER BY age ASC LIMIT 0
        echo $this->query_builder
                ->select(["id", "name"])
                ->from("users")
                ->where(["id" => 5, "name" => "Elnur"])
                ->where_or("name = Ali")
                ->order_by("age", "asc")
                ->limit(0, NULL)
                ->Build();

        $this->query_builder->get_row($this->conn);
    }
}

$db = new Database();
$db->findAdmin();