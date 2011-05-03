<?php

      header("Content-type: text/html; charset=UTF-8");

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
      $s->register_block('t', 'smarty_translate');
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

                  default:break;
            }
      }



      // Choose the right screen
      // -----------------------

      /* @TODO: - Make URL more beutiful
       *        - Put this switch case in a dedicate function
       */
      switch ($_GET["screen"]) {

            // ** **************************************************************
            case "relation-add":
            // ** **************
                  // assing the screen
                  $s->assign('screen', 'relation-add');

                  if(!$managers["user"]->isConnected() )
                        $err[] = Array("time" => time(), "msg" => _("You must be connected to add a relation."));
                  else {
                        // check if we need to add a relation
                        if (isset($_POST["entity-left-mid"]) && isset($_POST["entity-right-mid"]) && isset($_POST["relation_type"]))
                              $managers['relation']->addRelation();

                        // load type of relation                  
                        $rt["-1"] = Array("label" => "--", "direction" => "", "hint" => "");
                        foreach ($managers['relation_type']->htmlOption() as $key => $val)
                              $rt[$key] = $val;

                        $s->assign('relation_type_option', $rt);
                  }
                  
                  break;

            // ** **************************************************************
            case "relation-review":
            // ** *****************

                  // assing the screen
                  $s->assign('screen', 'relation-review');

                  if(!$managers["user"]->isConnected() )
                        $err[] = Array("time" => time(), "msg" => _("You must be connected to review a relation."));
                  else {

                        // check if we need to add a relation
                        if (isset($_POST["relation-id"]) && isset($_POST["rate"]))
                              $managers['relation_trust_level']->addTrustLevel();


                        if (isset($_GET["id"]) && is_numeric($_GET["id"]))
                        /* @var $relation Relation */
                              $relation = $managers["relation"]->getRelation($_GET["id"]);
                        else  // get random relation
                        /* @var $relation Relation */
                              $relation = $managers["relation"]->getRandRelation();



                        if ($relation === false)
                              $err[] = Array("time" => time(), "msg" => _("There is no relation to review."));


                        if ($relation->getCreator() == $_SESSION["user_id"]) {
                              $relation = false;
                              $err[] = Array("time" => time(), "msg" => _("You can't review a relation you have created."));
                        }

                        $s->assign("relation", $relation);

                        if (!!$relation) {

                              $s->assign("relation_value", $relation->getPropertyValues());

                              /* @var $entity_left Node */
                              $entity_left = $managers["node"]->getNode($relation->getNodeLeft());
                              // assign Smarty variable
                              if (!!$entity_left)
                                    $s->assign("entity_left", $entity_left);


                              /* @var $entity_right Node */
                              $entity_right = $managers["node"]->getNode($relation->getNodeRight());
                              // assign Smarty variable      
                              if (!!$entity_right)
                                    $s->assign("entity_right", $entity_right);


                              /* @var $relation_type Relation_type */
                              $relation_type = $managers["relation_type"]->getType($relation->getType());
                              $s->assign("relation_type", $relation_type);
                        }
                  }


                  break;

            // ** **************************************************************
            case "relation-visualise":
            // ** ********************      
                  // assing the screen
                  $s->assign('screen', 'relation-visualise');

                  $node_left = null;
                  $node_right = null;

                  // if a relation is given
                  if (isset($_GET["rel"])) {

                        $rel = explode("|", $_GET["rel"]);
                        // pattern to test if the string is a freebase ID
                        $freebase_id_pattern = "!(\/[a-z]{1,3}\/){1}([a-z0-9_]){3,}!i";

                        if (preg_match($freebase_id_pattern, $rel[0]))
                              $entity_left = $managers["node"]->getNode($rel[0]);

                        if (count($rel) == 2 && preg_match($freebase_id_pattern, $rel[1]))
                              $entity_right = $managers["node"]->getNode($rel[1]);
                  }

                  $s->assign("trust_rank", isset($_GET["trust_rank"]) && is_numeric($_GET["trust_rank"]) && $_GET["trust_rank"] <= 5 && $_GET["trust_rank"] >= 1 ? $_GET["trust_rank"] : 3);
                  $s->assign("entity_left", $entity_left);
                  $s->assign("entity_right", $entity_right);
                  break;

            default:
                  // assing the screen
                  $s->assign('screen', 'homepage');
                  $s->assign("countRelation", $managers["relation"]->getRelationCount());
                  $s->assign("countRelationReview", $managers["relation_trust_level"]->getRelationTrustLevelCount());
                  $s->assign("countUser", $managers["user"]->getUserCount());
                  break;
      }

      // every errors to a JSON
      $s->assign("err_json", json_encode($err));
      $s->display('index.tpl');
?>