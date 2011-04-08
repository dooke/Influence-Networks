<?
	// First, a few MySQL-ly useful functions

	/** Function mysqlEscapeString
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		escapes a string or array so that it's not vulnerable to sql injection
	*
	* @param: $mixed : array or string
	* @param: $connection : mysql connection
	* @param: $strip : boolean, strips values before escaping in case of user input (from $_POST for instance)
	* @return same as input but escaped for proper mysql use
	*/
	function mysqlEscapeString($mixed, $connection, $strip = true) {
		if (is_array($mixed)) {
			$result = array();
			foreach ($mixed as $k => $v)
				$result[$k] = mysql_real_escape_string($strip ? stripslashes_gpc($v) : $v, $connection);
		}
		else
			$result = mysql_real_escape_string($strip ? stripslashes_gpc($mixed) : $mixed, $connection);
	
		return $result;
	}


	/** Function mysqlDateToTime
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		parses a mysql date (yyyy-mm-dd hh:mm:ss) and converts it into a unix timestamp (int)
	*
	* @param: $date : date to convert
	* @return unix timestamp or FALSE on failure (bad date)
	*/
	function mysqlDateToTime($date) {
		// may be more complex some day so let's put it a function
		return strtotime($date);
	}


	/** Function mysqlDateToParts
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		parses a mysql date (yyyy-mm-dd[ hh:mm:ss]) to extract the 3 or 6 values, which may be invalid btw (ie year could be "0195") because
	*			db server stores dates litterally
	*
	* @param: $date : date to parse
	* @return array (parts named by their date()-function format equivalent) or FALSE on failure ("very" bad date)
	*/
	function mysqlDateToParts($date) {
		if (preg_match("/^(?<Y>[[:digit:]]{4})\-(?<m>[[:digit:]]{2})\-(?<d>[[:digit:]]{2})( (?<h>[[:digit:]]{2})\:(?<i>[[:digit:]]{2})\:(?<s>[[:digit:]]{2}))?/", $date, $p))
			return array(
						"Y" => $p["Y"], // we ignore the numeric and subsets hierarchy indexes
						"m" => $p["m"],
						"d" => $p["d"],
						"h" => $p["h"],
						"i" => $p["i"],
						"s" => $p["s"],
					);
		else
			return false; // since date is supposed to come from the db, this case should never happen but who knows...
	}


	/** Function mysqlTimeToDate
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		converts a unix timestamp (int) into a mysql date (yyyy-mm-dd hh:mm:ss)
	*
	* @param: $time: timestamp to convert
	* @return string (yyyy-mm-dd hh:mm:ss)
	*/
	function mysqlTimeToDate($time) {
		return date("Y-m-d H:i:s", $time);
	}


	// ****************************************************************************************************

	// And now, behold the class itself ! :o)

	/* ************************************** **
	**                                        **
	**             CLASS MYSQL                **
	**                                        **
	** ************************************** */

	class DbMySQL {
		var $host	= 'localhost';
		var $port	= '3306';
		var $db;
		var $login;
		var $pass;
		var $cnct;
		var $result;
		var $results = array(); // to handle multiple and imbricated queries and thus results
		var $rows;
		var $column	= array();
		var $record = array();
		
		var $error	= array();
		
		/* ********* Constructor ********* */
		function dbMySQL ( $_cntDb, $_cntLogin, $_cntPass, $_cntHost = null, $_cntPort = null) {
			if (!is_null($_cntHost))
				$this->host	= $_cntHost;
			if (!is_null($_cntPort))
				$this->port	= $_cntPort;

			$this->db		= $_cntDb;
			$this->login	= $_cntLogin;
			$this->pass		= $_cntPass;
		}
		
		/* ********* MySQL connection ********* */
		function connection () {
			if ( $this->cnct = @mysql_connect($this->host, $this->login, $this->pass) ) {
				if ( @mysql_select_db($this->db) ) {
					return TRUE;
				}
				else {
					$this->dbug('Impossible de s�lectionner la base de donn�e.');
					return FALSE;
				}
			}
			else {
				$this->dbug('Connection impossible.');
				return FALSE;
			}
		}
		
		function getConnection () {
			return $this->cnct;
		}

		/* ********* Query execution ********* */
		function query ( $_query ) {
			if ( !empty($_query) ) {
				if ( $this->result = @mysql_query($_query, $this->cnct) ) {
					return TRUE;
				}
				else {
					$this->dbug('Execution de la requete impossible. ' . $_query . ' Erreur: ' . mysql_error() );
					return FALSE;
				}
			}
			else {
				$this->dbug('La requ�te est vide.');
				return FALSE;
			}
		}
		
		/* ********* Multiple Results handling ********* */
		function pushResult() {
			array_push($this->results, $this->result);
			return $this->result;
		}

		function popResult() {
			return ($this->result = array_pop($this->results));
		}

		/* ********* Query update ********* */
		function update ( $_arr, $_table, $_cond ) {
			if ( is_array( $_arr ) && sizeof($_arr) > 0 ) {
				foreach ( $_arr as $_k=>$_v ) {
					$_query = "UPDATE " . $_table . " SET " . $_k . " = '" . $_v . "' WHERE " . $_cond;
					if ( $this->query( $_query ) ) {
						return TRUE;
					}
					else {
						$this->dbug('Execution de la requete impossible. ' . $_query . ' Erreur: ' . mysql_error() );
						return FALSE;
					}
				}
			}
			else {
				$this->dbug('Erreur: _arr n\'est pas un tableau ou le tableau est vide.<br />' . svar_dump ( $_arr ) );
				return FALSE;
			}
		}
		
		/* ********* Number of rows ********* */
		function numrows () {
			if ( $this->result && ($this->rows = @mysql_num_rows($this->result)) ) {
				return $this->rows;
			}
			else {
				$this->dbug('Erreur lors de l\'execution de la fonction mysql_num_rows().' . mysql_error() );
				return FALSE;
			}
		}
		
		/* ********* Fetch data ********* */
		function fetch ($result_type = MYSQL_BOTH, $object = false) {
			return $object ? @mysql_fetch_object($this->result) : @mysql_fetch_array($this->result, $result_type);
		}
		
		/* ********* Fetch data in an array ********* */
		function next_record () {
			$this->record = mysql_fetch_array($this->result);
			$rsc = is_array($this->record);
			if ( !$rsc ) {
				@mysql_free_result($this->result);
			}
			return $rsc;
		}
		
		/* ********* Get field by record ********* */
		function field ( $_field ) {
			return $this->record[$_field];
		}
		
		/* ********* Fetch fields in an array ********* */
		function fieldname () {
			if ( $this->result ) {
				$nf = @mysql_num_fields($this->result);
				for ( $i=0; $i<$nf; $i++ ) {
					$this->column[] = @mysql_field_name($this->result,$i);
				}
				return $this->column;
			}
			else {
				$this->dbug('Erreur $result est vide.');
				return FALSE;
			}
		}
		
		function lastid () {
			return mysql_insert_id($this->cnct);
			// return mysql_insert_id($this->result); <= XL says : BUG ! mysql_insert_id() takes a sql_connection not a result
		}
		
		/* ********* Free result ********* */
		function freeresult () {
			return @mysql_free_result($this->result);
		}
		
		function thread() {
			 $this->LinkID = mysql_thread_id($link);
		}
		
		function dbug ( $_errmsg ) {
			$this->error[] = $_errmsg;
		}
		
	}
?>