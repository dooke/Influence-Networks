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
            define('MYSQL_DB',   '@@MYSQL_DB@@');
            define('MYSQL_USER', '@@MYSQL_USER@@');
            define('MYSQL_PASS', '@@MYSQL_PASS@@');
            
            define('TABLE_PREFIX', 'inf_');

    else :

            /* *** DEV ENVIRONMENT *** */
            define('MYSQL_HOST', 'localhost');
            define('MYSQL_DB',   'influence_networks');
            define('MYSQL_USER', 'root');
            define('MYSQL_PASS', 'root');
            
            define('TABLE_PREFIX', 'inf_');
            
    endif;
    
    
    // list of every screen
    $arrScreen = Array(
                  "404" => "./appinc/screen/inc.homepage.php",
                  "homepage" => "./appinc/screen/inc.homepage.php",
                  "relation-add" => "./appinc/screen/inc.relation-add.php",
                  "relation-review" => "./appinc/screen/inc.relation-review.php",
                  "relation-visualize" => "./appinc/screen/inc.relation-visualize.php",
                  "relation-visualise" => "./appinc/screen/inc.relation-visualize.php", // retro-compatibility
                  "relation-visualize-embed" => "./appinc/screen/inc.relation-visualize-embed.php"
                      );


    // Sharing configuration
    // -----------------------
    define("DOC_URL"   , "http://influencenetworks.org");
    define("DOC_TITLE" , "[APP] Influence Networks lets you see how public figures know each other" );
    define("DOC_TWUSER", "owni");
    define("GA_PROFILE", "UA-18463169-5");

    
?>