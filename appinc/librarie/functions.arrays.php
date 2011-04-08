<?
	/*********************************************************************************
	*** Arrays functions library
	*
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		a bunch of useful functions that sadly don't come along with PHP
	*********************************************************************************/


	/** Function max_strlen
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		returns the maximum length of strings in specified array
	*
	* @param	$strings	: array ; the array to search into
	* @param	$column		: optional ; if $strings is a multi-dimensional array (MDA), $column specifies the column to use for the search ;
	*						  if $strings is a MDA but $column is not specified (ie null) the search will occur throughout to whole array
	* @return	integer
	*/
	function max_strlen($strings, $column = null) {
		$max = 0;
		if (is_array($strings)) {
			foreach ($strings as $s) {
				if (is_array($s))
					if (is_null($column))
						$l = max_strlen($s);
					else
						$l = strlen($s[$column]);
				else
					$l = strlen($s);

				if ($l > $max)
					$max = $l;
			}
		}
		return $max;
	}

	/** Function array_key_iexists
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		case-insensitive version of PHP's array_key_exists()
	*
	* @param	$key	: mixed ; the key to i-search for
	* @param	$search	: array ; the array to search into
	* @return	mixed	: 'false' if search fails, the actual key otherwise ; => check return value with "===", not "=="
	*/
	function array_key_iexists($key, $search) {
		if (is_array($search)) {
			$ukey = strtoupper($key);
			foreach ($search as $k => $value)
				if (strtoupper($k) === $ukey)
					return $k;
		}
		return false; // if we get here then nothing was found
	}

	/** Function array_reduce_keys
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		reduces an assoc array to keep only entries whose keys are specified
	*
	* @param	$array	: assoc array ; the array to reduce
	* @param	$keys	: array ; the list of keys of $array to keep ; keys not present in $array will be ignored, except if $keepUnset is true
	* @param	$keepUnset  : boolean ; whether to add (or not) keys of $keys that are not present in $array ; defaults to false
	* @param	$unsetValue : mixed ; value to set new entries of $array to, if $keepUnset is true
	* @return	array ;	eg : this call :
	*						array_reduce_keys(array("a" => "aaa", "b" => "bbb", "c" => "ccc"), array("a", "c"))
	*					will return this array :
	*						array("a" => "aaa", "c" => "ccc")
	*/
	function array_reduce_keys($array, $keys, $keepUnset = false, $unsetValue = null) {
		$rkeys = array_flip($keys);

		foreach ($array as $key => $value)
			if (!isset($rkeys[$key]))
				unset($array[$key]);

		if ($keepUnset && (count($keys) > count($array)))
			foreach ($keys as $key)
				if (!isset($array[$key]))
					$array[$key] = $unsetValue;

		return $array;
	}

	/** Function array_crop
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		reduces an 2 dims assoc array to keep only ONE entry for EACH entry of the array
	*
	* @param	$array	: assoc array ; the array to crop
	* @param	$key	: string ; the key to keep for each entry ; see $keepUnset
	* @param	$keepUnset  : boolean ; whether to add (or not) an entry if $array[$key] is not set ; defaults to false
	* @param	$unsetValue : mixed ; value to set new entries of $array to, if $keepUnset is true
	* @return	array ; 1 dim since each entry got cropped down to one key
	*/
	function array_crop($array, $key, $keepUnset = false, $unsetValue = null) {
		foreach ($array as $k => $v)
			if (is_array($v) && array_key_exists($key, $v))
				$array[$k] = $v[$key];
			else
				if ($keepUnset)
					$array[$k] = $unsetValue;

		return $array;
	}

	/** Function array_match_keys
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		Searches an array for keys names that match a pattern (regex) and returns an array of the corresponding key-value pairs.
	*			It's somehow a regex version of array_reduce_keys except that it doesn't pad unset values (which would make no sense since we're dealing with a regex and, as such, an open list)
	*			
	* @param	$array		: array to search in
	* @param	$pattern	: key name pattern to search for => http://php.net/preg-match
	*						  Don't forget to include begin/end characters for PHP regex; typically "/" => eg: "/^azerty/"
	*			$replace	: optional ; new key pattern : if specified, keys won't be kept as-is but altered via a preg_replace() call. => http://php.net/preg-replace
	* @return	
	*/
	function array_match_keys($array, $pattern, $replace = null) {
		$res = array();

		foreach ($array as $k => $v)
			if (preg_match($pattern, $k) === 1)
				if (is_null($replace))
					$res[$k] = $v;
				else
					$res[preg_replace($pattern, $replace, $k)] = $v;

		return $res;
	}

	/** Functions ukrsort & uarsort
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		(r)everse versions of uksort & uasort so we can use 'em with PHP comparison functions
	*
	* @param	$array			: assoc array ; the array to sort
	* @param	$$cmp_function	: callback ; the comparison function
	* @return	array ;	sorted array in "reverse order" (relatively to $cmp_function results of course :o) )
	*/
	function ukrsort(&$array, $cmp_function) {
		if (uksort($array, $cmp_function)) {
			$array = array_reverse($array, true);
			return true;
		}
		else
			return false;
	}

	function uarsort(&$array, $cmp_function) {
		if (uasort($array, $cmp_function)) {
			$array = array_reverse($array, true);
			return true;
		}
		else
			return false;
	}

	/** Function nimplode
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		range-limited version of implode
	*
	* @param	$glue	: string
	* @param	$pieces	: array
	* @param	$limit	: integer
	* @return	string
	*/
	function nimplode($glue, $pieces, $limit, $start = 0) {
		if (!is_integer($limit) || ($limit < 0))
			return null;

		if ($limit == 0) // shortcut :)
			return array();

		$array = array();
		
		reset($pieces);
		for ($i = 0; $i < $start; $i++)
			each($pieces);

		while ((list($k,$v) = each($pieces)) && (count($array) < $limit))
			$array[$k] = $v;

		return implode($glue, $array);
	}

	/** Function array_stuff
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		array version of str_insert, with potentially specified array index range
	*
	* @param	$array	: array to stuff
	* @param	$string	: string to insert
	* @param	$strpos	: integer ; position to insert $string at ; may be negative in which
	*						case it's evaluated relatively to each array value's length and not once and for all
	* @param	$from	: integer ; starting array index ; defaults to 0 (first entry)
	* @param	$to		: integer ; ending array index ; defaults to -1 (last entry)
	* @param	$paddingChar : char ; if $strpos > length of (a) value(s), then values are padded with this character before insertion
	* @return	boolean upon succes/failure ; modifies $array
	*/
	function array_stuff(&$array, $string, $strpos, $from = 0, $to = -1, $paddingChar = null) {
		if (!is_array($array) || !is_int($strpos) || !is_int($from) || !is_int($to))
			return false;

		$size = count($array);
		if ($to < 0)
			$to = $size + $to;

		if (($from > $to) || ($from >= $size))
			return false;

		if ($to >= $size)
			$to = $size - 1;

		reset($array);
		for ($i = 0; $i < $from; $i++)
			each($array);

		for ($i = 1; $i <= ($to - $from + 1); $i++) {
			list($k, $v) = each($array);
			$array[$k] = str_insert($string, $v, $strpos, $paddingChar);
		}
	}

	/** Function array_str_insert
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		array-returning version of array_stuff, ie it doesn't modifies the input array but creates a new one.
	*			Everything else is the same.
	* @return	stuffed array :o)
	*/
	function array_str_insert($array, $string, $strpos, $from = 0, $to = -1, $paddingChar = null) {
		array_stuff($array, $string, $strpos, $from, $to, $paddingChar);
		return $array;
	}

	/** Function array_keys_postfix
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		returns a copy of the input array but with all keys postfixed by specified string
	*			obviously designed for arrays with string keys ;o)
	* @return	array
	*/
	function array_keys_postfix($array, $string) {
		$res = array();
		foreach ($array as $k => $v)
			$res[$k.$string] = $v;
		return $res;
	}

	/** Function array_keys_prefix
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		returns a copy of the input array but with all keys prefixed by specified string
	*			obviously designed for arrays with string keys ;o)
	* @return	array
	*/
	function array_keys_prefix($array, $string) {
		$res = array();
		foreach ($array as $k => $v)
			$res[$string.$k] = $v;
		return $res;
	}

	/** Function transpose
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		transposes a two dimensions associative array (= a matrix) ie columns become rows and vice versa ; cf http://en.wikipedia.org/wiki/Transpose for details
	*
	* @note		Use with caution and parcimony because it's a well knowned (mathematically speaking) heavy operation ([CPU & memory]-wise) ; cf http://en.wikipedia.org/wiki/In-place_matrix_transposition
	*			and because the algorithm used here is quite... naive :o) (and as such, cumbersome) so big-matrix-transposition should be considered with caution... ideally not considered at all.
	* @note2	The matrix must be a regular rectangular one, ie all rows have the same number of columns and vice versa <=> there is no hole in the rectangular matrix
	*
	* @param	$array	: array to transpose
	* @return	a new, transposed, array
	*/
	function transpose($array) {
		$res = array();
		while (list($a,$A) = each($array))
			while (list($b,$value) = each($A))
				$res[$b][$a] = $value;
		return $res;
	}

	/** Function array_search_keys
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		*Recursively* searches for a key name and returns an array of the corresponding values
	*			Of course, non recursive equivalent is... $array[$key] ! :o)))
	*			
	* @param	$array	: array to search in
	* @param	$key	: key name to search for
	* @return	
	*/
	function array_search_keys($array, $key) {
		$res = array();
		if (isset($array[$key]))
			$res[] = $array[$key];
		foreach ($array as $k => $v)
			if (is_array($v))
				$res = array_merge($res, array_search_keys($v, $key));
		return $res;
	}

	/** Function array_merge_assoc
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		Associative version of array_merge ie it forces to keep keys EVEN IF THEY ARE NUMERIC
	*			which can't be forced with array_merge
	*			
	* @param	any number of arrays to merge
	* @return	one array
	*/
	function array_merge_assoc($array1 /* ... */) {
		$n = func_num_args();

		if ($n == 0)
			return null;

		$res = func_get_arg(0);

		for ($i = 1; $i < $n; $i++) {
			$array = func_get_arg($i);
			foreach ($array as $k => $v)
				$res[$k] = $v;
		}

		return $res;
	}
?>