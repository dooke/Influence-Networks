<?php
      /**
       * This include construts the screen to review a relation.
       * 
       * Include must be declared into /config/config.init.php
       * in the $arrScreen associative Array.
       * 
       * @author pirhoo <pierre@owni.fr>
       * 
       */

      // assing the screen
      $s->assign('screen', 'relation-review');

      if (!$managers["user"]->isConnected())
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

      // every errors to a JSON
      $s->assign("err_json", json_encode($err));
      $s->display('index.tpl');
?>
