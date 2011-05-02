<?php

/**
 * Description of RelationTypeManager
 *
 * @author pirhoo
 */
class RelationManager extends Manager {

      private $relations = Array();

      function __construct(& $smarty, & $db, & $managers, & $err) {

            // call the parent construtor
            parent::__construct($smarty, $db, $managers, $err);
      }

      public function addRelation() {


            $node_left_id = stripslashes($_POST["entity-left-mid"]);
            $node_right_id = stripslashes($_POST["entity-right-mid"]);
            $relation_type = stripslashes($_POST["relation_type"]);

            if (!$this->managers["user"]->isConnected())
                  $this->err[] = Array("time" => time(), "msg" => _("You must be connected to add a relation."));


            if ($node_left_id == $node_right_id)
                  $this->err[] = Array("time" => time(), "msg" => _("Your relation is incorrect."));


            // check data
            if ($node_left_id != ""
             && $node_right_id != ""
             && is_numeric($relation_type)
             && count($this->err) == 0) {


                  // if the node doesn't exist
                  if (!$this->managers["node"]->getNode($node_left_id))
                  // add the node to the database
                        if (!$this->managers["node"]->addFreebaseNode($node_left_id))
                        // or alert
                              $this->err[] = Array("time" => time(), "msg" => _("Your left entity doesn't exist on Freebase."));



                  // if the node doesn't exist
                  if (!$this->managers["node"]->getNode($node_right_id))
                  // add the node to the database
                        if (!$this->managers["node"]->addFreebaseNode($node_right_id))
                        // or alert
                              $this->err[] = Array("time" => time(), "msg" => _("Your right entity doesn't exist on Freebase."));


                  // if we have met any error
                  // we can add the relation
                  if (count($this->err) == 0) {

                        $node_left = $this->managers["node"]->getNode($node_left_id);
                        $node_right = $this->managers["node"]->getNode($node_right_id);
                        $creator = $this->managers["user"]->getUser($_SESSION["user_id"]);

                        // a user cannot add a relation twice
                        // get every relation between this nodes
                        $relations = $this->managers["relation"]->getRelations($node_left->getId(), $node_right->getId());
                        $relation_exist = false;
                        // for each relations...
                        foreach ($relations as $rel)
                        // ...check if this creator have already added it.
                              $relation_exist = $relation_exist || ( $rel->getCreator() == $creator->getId() && $rel->getType() == $relation_type);

                        if (!$relation_exist) {

                              $query = "INSERT INTO " . TABLE_PREFIX . "relation (node_left, node_right, creator, type, trust_level) ";
                              $query .= "VALUES ({$node_left->getId()}, {$node_right->getId()}, {$creator->getId()}, {$relation_type}, {$creator->getTrustLevel()} )";

                              $this->db->query($query) or die("Database error. Sorry, try again.");

                              $relation_id = $this->db->lastid();

                              // add each property
                              foreach ($_POST as $key => $val) {

                                    // every key are not property
                                    $property_id = str_replace("property_", "", $key);

                                    // if we found a right property
                                    if (is_numeric($property_id) && is_numeric($relation_id)) {

                                          $val = stripslashes($val);

                                          $query = "INSERT INTO " . TABLE_PREFIX . "relation_value ";
                                          $query .= "(property, relation, value)";
                                          $query .= "VALUES ({$property_id}, {$relation_id},'{$val}')";

                                          $this->db->query($query) or die("Database error. Sorry, try again.");
                                    }
                              }
                              
                              $this->err[] = Array("time" => time(), "msg" => _("Your relation has been added.") );
                                                         
                        } else
                              $this->err[] = Array("time" => time(), "msg" => _("You have already added this relation."));
                  }
            }
      }

      public function getRelations($node_left, $node_right) {

            $query = "SELECT * FROM " . TABLE_PREFIX . "relation 
                      WHERE (node_left={$node_left}  AND node_right={$node_right})
                         OR (node_right={$node_left} AND node_left={$node_right})";

            $this->db->query($query) or die("Database error. Sorry, try again.");

            $relations = array();

            while ($row = $this->db->fetch()) {

                  $rel = new Relation($row);

                  $this->relations[$row["id"]] = $rel;
                  $relations[$row["id"]] = $rel;
            }

            return $relations;
      }

      public function getRandRelation() {

            if ($this->managers["user"]->isConnected()) {

                  $query = "SELECT COUNT(R.id) AS nb FROM ";
                  $query .= TABLE_PREFIX . "relation R ";
                  $query .= "WHERE creator != " . intval($_SESSION["user_id"]) . " ";
                  $query .= "AND R.locked = 0 ";
                  $query .= "AND R.id NOT IN ( ";
                  $query .= "SELECT RT.relation_id ";
                  $query .= "FROM " . TABLE_PREFIX . "relation_trust_level RT ";
                  $query .= "WHERE user_id=" . intval($_SESSION["user_id"]) . " ";
                  $query .= ")";

                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  $row = $this->db->fetch();
                  $offset_max = $row["nb"];

                  $row = false;
                  $i = 0;

                  // trys 5 times to find a random relation
                  while ($row == false && $i < 5 && $offset_max > 0) {

                        $offset = rand(0, $offset_max);

                        $query = "SELECT R.* FROM ";
                        $query .= TABLE_PREFIX . "relation R ";
                        $query .= "WHERE creator != " . intval($_SESSION["user_id"]) . " ";
                        $query .= "AND R.locked = 0 ";
                        $query .= "AND R.id NOT IN ( ";
                        $query .= "SELECT RT.relation_id ";
                        $query .= "FROM " . TABLE_PREFIX . "relation_trust_level RT ";
                        $query .= "WHERE user_id =" . intval($_SESSION["user_id"]) . " ";
                        $query .= ") ";
                        $query .= "LIMIT 1 OFFSET " . $offset;

                        $this->db->query($query) or die("Database error. Sorry, try again.");
                        $row = $this->db->fetch();

                        $row = !!$row ? new Relation($row) : false;

                        if (!!$row)
                        // to load property from db to the instance
                              $row->setPropertyValues($this->managers["relation_value"]->getRelationValues($row->getId())); // 

                        $i++;
                  }

                  return $row;
            } else
                  return false;
      }

      public function getRelation($key) {

            if (isset($this->relations[$key])) {

                  return $this->relations[$key];
            } elseif (is_numeric($key)) {

                  $query = "SELECT * FROM " . TABLE_PREFIX . "relation ";
                  $query .= " WHERE id={$key}";

                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  $row = $this->db->fetch();

                  $row = $row ? new Relation($row) : false;

                  if (!!$row)
                        $this->relations[$key] = $row;

                  return $row;
            } else
                  return false;
      }

      public function updateTrustLevel($relation_id) {

            $relation = $this->managers["relation"]->getRelation($relation_id);
            $user = $this->managers["user"]->getUser($relation->getCreator());

            if (!!$relation) {

                  $trust_levels = $this->managers["relation_trust_level"]->getRelationTrustLevels($relation_id);

                  if (is_array($trust_levels) && count($trust_levels) < 3) {

                        $tl = $relation->getTrustLevel();

                        if ($tl < 5) {

                              $tl = $relation->getTrustLevel() * $user->getTrustLevel();
                              $exp = $user->getTrustLevel();

                              foreach ($trust_levels as $key => $trust_level) {
                                    // auteur du trust_level

                                    $u = $this->managers["user"]->getUser($trust_level->getUserId());
                                    if (!!$u) {

                                          $tl += $trust_level->getTrustLevel() * $u->getTrustLevel();
                                          $exp += $u->getTrustLevel();
                                    }
                              }

                              $tl = $tl / $exp;
                              $tl = round($tl * 10) / 10;
                              $tl = str_replace(",", ".", $tl);
                              // query to update the trust level
                              $query = "UPDATE " . TABLE_PREFIX . "relation SET trust_level = '{$tl}' WHERE id = {$relation_id}";
                              $this->db->query($query) or die(_("Database error. Sorry, try again."));
                        }
                  } elseif (is_array($trust_levels) && count($trust_levels) >= 3) {

                        $this->managers["relation"]->lockRelation($relation_id);
                        $this->err[] = array("time" => time(), "msg" => "You can't review this relation.");
                  }
            }
      }

      public function lockRelation($relation_id) {

            if (is_numeric($relation_id)) {

                  $query = "UPDATE " . TABLE_PREFIX . "relation ";
                  $query .= "SET locked=1 ";
                  $query .= "WHERE id = {$relation_id}";

                  $this->db->query($query) or die(_("Database error. Sorry, try again."));

                  return true;
            } return false;
      }

      public function getNodeRelations($node_id) {

            if (is_numeric($node_id)) {

                  $query = "SELECT * FROM ";
                  $query .= TABLE_PREFIX . "relation ";
                  $query .= " WHERE node_left  = {$node_id} ";
                  $query .= "    OR node_right = {$node_id}";

                  $this->db->query($query) or die(_("Database error. Sorry, try again."));
                  $relations = array();

                  while ($row = $this->db->fetch())
                        $this->relations = $relations[$row["id"]] = new Relation($row);

                  return $relations;
            } else
                  return false;
      }

      public function getNodesRelation($node_left, $node_right) {

            if (is_numeric($node_left) && is_numeric($node_right)) {

                  $query = "SELECT * FROM ";
                  $query .= TABLE_PREFIX . "relation ";
                  $query .= " WHERE (node_left  = {$node_left} ";
                  $query .= "        AND node_right = {$node_right} )";
                  $query .= "    OR (node_left  = {$node_left} ";
                  $query .= "        AND node_right = {$node_right} )";

                  $this->db->query($query) or die(_("Database error. Sorry, try again."));
                  $relations = array();

                  while ($row = $this->db->fetch())
                        $this->relations = $relations[$row["id"]] = new Relation($row);

                  return $relations;
            } else
                  return false;
      }

      public function getNodeRelation($node) {

            if (is_numeric($node)) {

                  $query = "SELECT R.*, 
                                    T.label AS type_label,
                                    N1.label AS node_left_label, 
                                    N2.label AS node_right_label,
                                    N1.freebase_id AS node_left_freebase_id, 
                                    N2.freebase_id AS node_right_freebase_id,
                                    N1.type AS node_left_type, 
                                    N2.type AS node_right_type FROM ";
                  $query .= TABLE_PREFIX . "relation R, ";
                  $query .= TABLE_PREFIX . "node N1, ";
                  $query .= TABLE_PREFIX . "node N2, ";
                  $query .= TABLE_PREFIX . "relation_type T ";
                  $query .= " WHERE ( node_left  = {$node} ";
                  $query .= "    OR   node_right = {$node} )";
                  $query .= "    AND  node_left  = N1.id ";
                  $query .= "    AND  node_right = N2.id ";
                  $query .= "    AND  R.type = T.id";

                  $this->db->query($query) or die(_("Database error. Sorry, try again."));
                  $relations = array();

                  while ($row = $this->db->fetch()) {
                        $this->relations = $relations[$row["id"]] = new Relation($row);
                  }

                  return $relations;
            } else
                  return false;
      }

      public function getNodeRelationJSON() {

            if (is_numeric($_GET["id"])) {

                  $relations = $this->getNodeRelation($_GET["id"]);
                  $relations_array = array();

                  foreach ($relations as $r)
                        $relations_array[] = $r->getArray();

                  return json_encode($relations_array);
            } else
                  return false;
      }

      public function getAllRelations($tl_min = 0, $tl_max = 5) {

            $tl_min = str_replace(".", ",", $tl_min); // MySQL float compatibility
            $tl_max = str_replace(".", ",", $tl_max);

            $query = "SELECT * FROM ";
            $query .= TABLE_PREFIX . "relation ";
            $query .= "WHERE 1=1 ";
            $query .= $tl_min > 0 && is_numeric($tl_min) ? "AND trust_level > {$tl_min} " : "";
            $query .= $tl_max < 5 && is_numeric($tl_max) ? "AND trust_level < {$tl_max} " : "";

            $this->db->query($query) or die(_("Database error. Sorry, try again."));
            $relations = array();

            while ($row = $this->db->fetch())
                  $this->relations = $relations[$row["id"]] = new Relation($row);

            return $relations;
      }

      public function getRelationBetweenNodes() {

            // an empty array who records every relation way
            // a relation way is an array of different relation
            $relations = Array();

            if (isset($_POST["entity-left-mid"])
             && isset($_POST["entity-right-mid"])) {

                  /* @var $nodeLeft Node */
                  $nodeLeft = $this->managers["node"]->getNode($_POST["entity-left-mid"]);
                  /* @var $nodeRight Node */
                  $nodeRight = $this->managers["node"]->getNode($_POST["entity-right-mid"]);

                  if ($nodeLeft != null && $nodeRight != null) {


                        // * First and second degre relations exist ?
                        // ********************************
                        $relation_2d_left = $this->getNodeRelation($nodeLeft->getId());
                        $relation_2d_right = $this->getNodeRelation($nodeRight->getId());


                        $relations = $this->interNodeRelations($relation_2d_left, $relation_2d_right, $nodeLeft->getId(), $nodeRight->getId());


                        // * Third degre relations exist ?
                        // ********************************
                        // TODO
                  }
            }

            // return results as json
            return json_encode($relations);
      }

      // This function extract every common nodes between two relations array           
      public function interNodeRelations(& $arr1, & $arr2, & $id1, & $id2) {

            $inter_arr = array();


            // for each relation in array
            /* @var $rel1 Relation */
            foreach ($arr1 as $key => $rel1) {

                  // for each relation in array
                  /* @var $rel2 Relation */
                  foreach ($arr2 as $key => $rel2) {

                        // the right node cwould matching
                        if ($rel1->getNodeLeft() == $id1) {

                              if ($rel1->getNodeRight() == $rel2->getNodeLeft()
                                      || $rel1->getNodeRight() == $rel2->getNodeRight())
                              // add it
                                    $inter_arr[$rel2->getId()] = $rel2;


                              // the left node cwould matching
                        } elseif ($rel1->getNodeRight() == $id1) {

                              if ($rel1->getNodeLeft() == $rel2->getNodeLeft()
                                      || $rel1->getNodeLeft() == $rel2->getNodeRight())
                              // add it
                                    $inter_arr[$rel2->getId()] = $rel2;
                        }
                  }
            }

            return $inter_arr;
      }

      public function getMergeRelationNodes() {

            // an empty array who records every relation way
            // a relation way is an array of different relation
            $relations = Array();
            $nodes = Array();


            // * First and second degre relations exist ?
            // ********************************
            

            if (isset($_POST["entity-left-mid"])) {
                  

                  /* @var $nodeLeft Node */
                  $nodeLeft = $this->managers["node"]->addFreebaseNode($_POST["entity-left-mid"]);

                  if($nodeLeft != false) {
                        $relation_2d_left = $this->getNodeRelation($nodeLeft->getId());

                        foreach ($relation_2d_left as $key => $rel)
                              $relations[$key] = $rel->getArray();

                        $nodes[ $nodeLeft->getId() ] = $nodeLeft->getArray();
                        
                  }
                  
            }

            // ---

            if (isset($_POST["entity-right-mid"])) {
                  
                 

                  /* @var $nodeRight Node */                  
                  $nodeRight =  $this->managers["node"]->addFreebaseNode($_POST["entity-right-mid"]);
                  if($nodeRight != false) {
                        $relation_2d_right = $this->getNodeRelation($nodeRight->getId());

                        foreach ($relation_2d_right as $key => $rel)
                              $relations[$key] = $rel->getArray();

                        $nodes[ $nodeRight->getId() ] = $nodeRight->getArray();
                  }
            }
            
            // return results as json
            return (json_encode(Array("nodes" => $nodes, "relations" => $relations)) );
      }
      
      /**
       * Return the number of relations
       * @return int 
       */
      public function getRelationCount() {
            
            $query = "SELECT count(id) AS nb  FROM ".TABLE_PREFIX."relation";
            $this->db->query($query) or die("Database error. Sorry, try again.");
            $row = $this->db->fetch();
            
            return $row["nb"];
            
      }

}

?>
