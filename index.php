<?php

      // header("Content-type: text/html; charset=UTF-8");

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

      // Define current language
      // -----------------------
      require_once(BASE_DIR . '/appinc/librarie/functions.language.php');
      require_once(BASE_DIR . '/appinc/librarie/Rmail/Rmail.php');
       
      /* @TODO: make the following function better... */
      initLanguage();

      // Launch MySQL Connection
      // -----------------------
      require_once(BASE_DIR . '/appinc/librarie/class.DbMysql.php');
      /* @var $db DbMySQL */
      $db = new DbMysql(MYSQL_DB, MYSQL_USER, MYSQL_PASS, MYSQL_HOST);
      $db->connection() or die("Database connexion failed.");

      // Launch Smarty Libs
      // ------------------        
      require_once(BASE_DIR . '/appinc/librarie/Smarty-3.0.6/libs/Smarty.class.php');
      require_once(BASE_DIR . '/appinc/librarie/Smarty-3.0.6/smarty-gettext.php');
      $s = new Smarty();

      // Smarty settings
      @$s->register_block('t', 'smarty_translate');
      $s->template_dir = BASE_DIR . '/appinc/template';
      $s->compile_dir = BASE_DIR . '/appinc/template/_compiled';
      $s->cache_dir = BASE_DIR . '/appinc/template/_cache';
      $s->config_dir = BASE_DIR . '/configs';

      // Error Array
      /* @TODO: Use an error manager may be more convenient */
      $err = Array();

      // Declare records Managers
      // ------------------------            
      $managers = Array();

      /* @var $managers['node'] NodeManager */
      $managers['node'] = new NodeManager($s, $db, $managers, $err);
      /* @var $managers['relation'] RelationManager */
      $managers['relation'] = new RelationManager($s, $db, $managers, $err);
      /* @var $managers['relation_trust_level'] RelationTrustLevelManager */
      $managers['relation_trust_level'] = new RelationTrustLevelManager($s, $db, $managers, $err);
      /* @var $managers['relation_type'] RelationTypeManager */
      $managers['relation_type'] = new RelationTypeManager($s, $db, $managers, $err);
      /* @var $managers['relation_value'] RelationValueManager */
      $managers['relation_value'] = new RelationValueManager($s, $db, $managers, $err);
      /* @var $managers['user'] UserManager */
      $managers['user'] = new UserManager($s, $db, $managers, $err);

      
      // API calls
      // ---------
      if( isset($_REQUEST["api"]) ) {
                    
            require_once(BASE_DIR . "/appinc/class/API.class.php");            
            $api = new API($db, $managers, $err);
      }
      
      

      // XHR Actions
      // -----------

      /* @TODO: - Convert there methods in REST FULL format
       *        - Put this switch case in a dedicate function
       */
      if (isset($_REQUEST["action"])) {
            switch ($_REQUEST["action"]) {

                  case "signin":
                        echo json_encode(Array("statut" => $managers['user']->isConnected()));
                        exit;
                        break;

                  case "signup":
                        echo $managers['user']->addUser();
                        exit;
                        break;

                  case "getnodelist":
                        echo $managers['node']->getNodeList();
                        exit;
                        break;

                  case "getRelationBetweenNodes":
                        echo $managers['relation']->getRelationBetweenNodes();
                        exit;
                        break;

                  case "getMergeRelationNodes":
                        echo $managers['relation']->getMergeRelationNodes();
                        exit;
                        break;

                  case "getNodeRelation":
                        echo $managers["relation"]->getNodeRelationJSON();
                        exit;
                        break;

                  case "getRelationValues":
                        echo $managers["relation_value"]->getRelationValuesJSON($_REQUEST["relation_id"]);
                        exit;
                        break;

                  case "removeUselessNodes":
                        echo $managers["node"]->removeUselessNode();
                        exit;
                        break;

                  case "updateNodeInfo":
                        echo $managers["node"]->updateNodeInfo();
                        exit;
                        break;
                    
                  case "sendUserConfirmationEmail":
                        $managers["user"]->sendUserConfirmationEmail();
                        exit;
                        break;
                    
                  case "confirmAccount":
                        $managers["user"]->confirmAccount();
                        break;

                    
                  default:break;
            }
      }
            


      // -------------------------------------
	// Include files
	// see config.init.php for include pages
	// -------------------------------------
	$screen = isset($_GET["screen"]) ? strip_tags(trim($_GET['screen'])) : "";
	if ( empty($screen) == FALSE && array_key_exists($screen, $arrScreen) ) {
		if ( !file_exists( $arrScreen[$screen] ) ) {
			$_require	= $arrScreen['404'];
			$screen	= '404';
		}
		else $_require	= $arrScreen[$screen];

	}
	else {
		$_require = $arrScreen['homepage'];
		$screen	= 'homepage';
	}
	
	if ( file_exists( $_require ) )
		require_once( $_require );
	// -------------------------------------
      

?>