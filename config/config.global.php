<?php

    /** config.global.php
    * @author Team22mars <pierre@owni.fr>
    * @version 1.0
    */

    // permet d'afficher les messages d'erreur
     if( isset($_GET['debug'])) {
         ini_set('display_errors', 1);
         ini_set('log_errors', 1);
         error_reporting(E_ALL);
     } else {
         ini_set('display_errors', 0);
         ini_set('log_errors', 0);
         error_reporting(null);         
     }

    
    // le dossier à la racine du site    
    define("BASE_DIR", preg_replace("#/config$#i", "", dirname(__FILE__)));
    define("APP_URL", "http://".$_SERVER["SERVER_NAME"].str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]) );

    // Les constantes qui paramêtrent l'APP
    // ------------------------------------
    require_once (BASE_DIR."/config/config.init.php");
    
    // lance une session si celle-ci n'est pas déjà lancée
    if(session_id() == "") session_start();

?>