<?php

/**
 * Description of RelationTypeManager
 *
 * @author pirhoo
 */
class RelationTypeManager extends Manager {

      private $types = Array();

      function __construct(& $smarty, & $db, & $managers, & $err) {

            // call the parent construtor
            parent::__construct($smarty, $db, $managers, $err);
            
      }

      public function htmlOption() {

            $query = "SELECT * FROM " . TABLE_PREFIX . "relation_type ORDER BY label";
            $this->db->query($query) or die("Database error. Sorry, try again.");

            $options = array();
 
            while ( $row = $this->db->fetch() ) {
                  $options[$row["id"]]       = _($row["label"]);
                  $this->types[ $row["id"] ] = new Relation_type($row);
            }

            return $options;
      }
      
      public function getType($type_id) {
            
            if( !isset($this->types[$type_id]) ) {
                  
                  if( is_numeric($type_id) ) {
                        $query  = "SELECT * FROM ". TABLE_PREFIX ."relation_type ";
                        $query .= " WHERE id={$type_id}";
                  
                        $this->db->query($query) or die("Database error. Sorry, try again.");
                        
                        if( $row = $this->db->fetch() ) {
                              
                              $this->types[$type_id] = new Relation_type($row);
                              return $this->types[$type_id];                        
                              
                        } else return false;
                                                
                  } else return false;
                              
            } else return $this->types[$type_id];
                        
      }

}

?>
            