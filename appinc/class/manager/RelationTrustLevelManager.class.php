<?php

/**
 * Description of RelationTrustLevelManager
 *
 * @author pirhoo
 */
class RelationTrustLevelManager extends Manager {

      private $trust_levels = Array();

      function __construct(& $smarty, & $db, & $managers, & $err) {

            // call the parent construtor
            parent::__construct($smarty, $db, $managers, $err);
      
      }
      
      public function addTrustLevel() {
            
            if( $this->managers["user"]->isConnected() ) {
                  
                  $relation   = $this->managers["relation"]->getRelation( $_POST["relation-id"] );
                  $trust_level = $_POST["rate"];

                  if(!!$relation && is_numeric($trust_level) && $trust_level >= 1 && $trust_level <= 5) {

                        if( $relation->getCreator() != $_SESSION["user_id"]) {

                              $relation_trust_levels = $this->getRelationTrustLevels( $relation->getId() );   
                              
                              if( is_array($relation_trust_levels) ) {
                                    
                                    $creator_exist = false;
                                    
                                    /* @var $item Relation_trust_level */
                                    foreach ($relation_trust_levels as $key=>$item)
                                          $creator_exist = $creator_exist || $item->getUserId() == $_SESSION["user_id"];                                    
                                    
                                    if(!$creator_exist) {                                           
                                          
                                          // after a lot of checking, we can add the relation
                                          $query  = "INSERT INTO ".TABLE_PREFIX."relation_trust_level ";
                                          $query .= "(relation_id, user_id, trust_level) ";
                                          $query .= "VALUES ({$relation->getId()}, {$_SESSION["user_id"]}, {$trust_level})";
                                                                                    
                                          $this->db->query($query) or die("Database error. Sorry, try again.");                                                  
                                          
                                          $this->managers["user"]->updateTrustLevel($relation->getCreator(), $trust_level);
                                          $this->managers["relation"]->updateTrustLevel( $relation->getId() );
                                          
                                          $this->err[] = Array("time" => time(), "msg" => _("Your review has been taken into account.") );
                                                                                    
                                    } else $this->err[] = Array("time" => time(), "msg" => _("You can't evaluate a relation twice.") );
                                    
                              } else $this->err[] = Array("time" => time(), "msg" => _("You review can't be recorded.") );

                        } else $this->err[] = Array("time" => time(), "msg" => _("You can't rate your own relation.") );

                  } else $this->err[] = Array("time" => time(), "msg" => _("Invalid data to evaluate the Trust Level.") );

            } else $this->err[] = Array("time" => time(), "msg" => _("You need to be connected.") );
            
      }
      
      public function getRelationTrustLevels($relation_id) {
            
            if(is_numeric($relation_id)) {
                  
                  $query  = "SELECT * FROM ".TABLE_PREFIX."relation_trust_level ";
                  $query .= " WHERE relation_id = {$relation_id}";
                  
                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  
                  $trust_levels = array();
                  
                  while( $row = $this->db->fetch() ) {
                        
                        $this->trust_levels[] = new Relation_trust_level($row);
                        $trust_levels[]       = new Relation_trust_level($row);
                  }
                  
                  return $trust_levels;
                                    
            } else return false;

            
      }
      
  

}

?>
