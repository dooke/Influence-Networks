<?php

      chdir("../../");

      @header('Content-Type: text/html; charset=UTF-8');

      // Load the current configuration 
      // ------------------------------
      require_once('./config/config.global.php');

      // Mysql basic record        
      require_once(BASE_DIR . "/appinc/class/model/Record.class.php");

      // Load some models
      // ----------------
      // The nomenclature is the same of the DB
      require_once(BASE_DIR . "/appinc/class/model/Node.class.php");
      require_once(BASE_DIR . "/appinc/class/model/Relation.class.php");
      require_once(BASE_DIR . "/appinc/class/model/Relation_trust_level.class.php");
      require_once(BASE_DIR . "/appinc/class/model/Relation_type.class.php");
      require_once(BASE_DIR . "/appinc/class/model/Relation_type_property.class.php");
      require_once(BASE_DIR . "/appinc/class/model/Relation_value.class.php");
      require_once(BASE_DIR . "/appinc/class/model/User.class.php");

      // Load records managers
      // ---------------------
      require_once(BASE_DIR . "/appinc/class/manager/Manager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/RelationManager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/RelationTrustLevelManager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/RelationTypeManager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/RelationValueManager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/NodeManager.class.php");
      require_once(BASE_DIR . "/appinc/class/manager/UserManager.class.php");

      // Launch MySQL Connection
      // -----------------------
      require_once(BASE_DIR . '/libraries/class.Mysql.php');
      /* @var $db dbMySQL */
      $db = new dbMysql(MYSQL_DB, MYSQL_USER, MYSQL_PASS, MYSQL_HOST);
      $db->connection() or die("Database connexion failed.");

      // Smarty
      // ------------------------
      require_once(BASE_DIR . '/libraries/Smarty-2.6.26/libs/Smarty.class.php');
      require_once(BASE_DIR . '/libraries/Smarty-2.6.26/smarty-gettext.php');
      $s = new Smarty();

      // Smarty settings
      $s->register_block('t', 'smarty_translate');
      $s->template_dir = BASE_DIR . '/templates';
      $s->compile_dir = BASE_DIR . '/templates/_compiled';
      $s->cache_dir = BASE_DIR . '/templates/_cache';
      $s->config_dir = BASE_DIR . '/configs';

      // Error Array
      $err = Array();
      
      // Declare records Managers
      // ------------------------            
      $managers = Array();
      
      /* @var $managers['node'] NodeManager */
      $managers['node']                 = new NodeManager($s, $db, $managers, $err);
      /* @var $managers['relation'] RelationManager */
      $managers['relation']             = new RelationManager($s, $db, $managers, $err);
      /* @var $managers['relation_trust_level'] RelationTrustLevelManager */
      $managers['relation_trust_level'] = new RelationTrustLevelManager($s, $db, $managers, $err);
      /* @var $managers['relation_type'] RelationTypeManager */
      $managers['relation_type']        = new RelationTypeManager($s, $db, $managers, $err);
      /* @var $managers['relation_value'] RelationValueManager */
      $managers['relation_value']       = new RelationValueManager($s, $db, $managers, $err);
      /* @var $managers['user'] UserManager */
      $managers['user']                 = new UserManager($s, $db, $managers, $err);


      switch ($_REQUEST["action"]) {

            case "signin":
                  echo json_encode(Array("statut" => $managers['user']->isConnected()));
                  break;

            case "signup":
                  $managers['user']->addUser();
                  break;

            case "getnodelist":
                  $managers['node']->getNodeList();
                  break;
            
            case "getRelationBetweenNodes":
                  $managers['relation']->getRelationBetweenNodes();
                  break;
            
            case "getMergeRelationNodes":
                  $managers['relation']->getMergeRelationNodes();
                  break;
            
            case "getNodeRelation":
                  $managers["relation"]->getNodeRelationJSON();
                  break;
            
            case "getRelationValues":
                  exit( $managers["relation_value"]->getRelationValuesJSON($_REQUEST["relation_id"]) );
                  break;

            default:break;
      }
?>