<?php

    /** config.init.php
    * @author Team22mars <pierre@owni.fr>
    * @version 1.0
    * @desc Set up the application
    */


    // MySQL Database settings
    // -----------------------
    if (strstr($_SERVER['SERVER_NAME'], 'influencenetworks.org') ):
        
            /* *** PROD ENVIRONMENT *** */
            define('MYSQL_HOST', 'localhost');
            define('MYSQL_DB', '');
            define('MYSQL_USER', '');
            define('MYSQL_PASS', '');
            
            define('TABLE_PREFIX', 'inf_');

    else :

            /* *** DEV ENVIRONMENT *** */
            define('MYSQL_HOST', 'localhost');
            define('MYSQL_DB',   'influence_networks');
            define('MYSQL_USER', 'root');
            define('MYSQL_PASS', 'root');
            
            define('TABLE_PREFIX', 'inf_');
            
    endif;


    // Sharing configuration
    // -----------------------
    define("DOC_URL"   , "http://influencenetworks.org");
    define("DOC_TITLE" , "[APP] Influence Networks lets you see how public figures know each other" );
    define("DOC_TWUSER", "owni");
    define("GA_PROFILE", "UA-18463169-5");

    
?>