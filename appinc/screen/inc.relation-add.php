<?php
      /**
       * This include construts the screen to add a relation.
       * 
       * Include must be declared into /config/config.init.php
       * in the $arrScreen associative Array.
       * 
       * @author pirhoo <pierre@owni.fr>
       * 
       */

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

      // every errors to a JSON
      $s->assign("err_json", json_encode($err));
      $s->display('index.tpl');
      
?>
