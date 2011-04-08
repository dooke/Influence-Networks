<?
	/*********************************************************************************
	*** Languages functions library
	*
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		
	*********************************************************************************/

	/** Function setLanguage
	* @author	Development Team (XL based on Yosra's) <contact@web-e-tic.fr>
	* @desc		set language info for gettext stuff and co
	*
	* @param	$lang		: string ; looks like "fr_FR" or "en_US" ...
	* @param	$domain		: string ; typically the name of the language files
	* @param	$baseFolder	: string ; under the document root ; it's the folder that contain sth like "fr_FR/LC_MESSAGES/*.[pm]o"
	* @return	zilch, it just gets the job done
	*/
	function setLanguage($lang, $domain = "traductions", $baseFolder = "./locale") {

		$_SESSION[LANG_SESSION_VAR] = $lang;

                $codeset = "UTF-8";
                
		putenv("LC_ALL=$lang.$codeset");
		putenv("LANG=$lang.$codeset");
                putenv("LANGUAGE=$lang.$codeset");

                setlocale(LC_ALL, "$lang.$codeset");

                bindtextdomain($domain, $baseFolder);
                bind_textdomain_codeset($domain, $codeset);

		textdomain($domain);
                
	}

	/** Function __
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		alias (aka shortcut) for (d)ngettext
	*
	* @param	$msg1/2		: string to translate
	* @param	$n		: number
	* @param	$domain		: string ; optional
	* @return	translated message
	*/
	function __($msg1, $msg2, $n, $domain = null) {
		return is_null($domain) ? ngettext($msg1, $msg2, $n) : dngettext($domain, $msg1, $msg2, $n);
	}


	/** Function initLanguage
	* @author	Pierre Romera, Team 22mars <pierre.romera@gmail.com>
	* @desc		Define application language
        * 
	*/
        if(! function_exists("initLanguage") ) {

            define('LANG_SESSION_VAR', 'language');

            function initLanguage() {

                if(session_id() == "") session_start();

                if(isset($_GET["lang"]))
                     setLanguage($_GET["lang"]);

                elseif( isset($_SESSION[LANG_SESSION_VAR]) )
                     setLanguage($_SESSION[LANG_SESSION_VAR]);

                else setLanguage("fr_FR");

            }
        }
	
?>