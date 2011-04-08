<?php

/**
 * Description of RelationTypeManager
 *
 * @author pirhoo
 */
class RelationValueManager extends Manager {

      private $values = Array();

      function __construct(& $smarty, & $db, & $managers, & $err) {

            // call the parent construtor
            parent::__construct($smarty, $db, $managers, $err);
      }
      
      public function getRelationValues($relation_id) {
            
            if(is_numeric($relation_id)) {
                  
                  $query  = "SELECT V.*, P.label AS property_label FROM ".TABLE_PREFIX."relation_value V, ".TABLE_PREFIX."relation_type_property P";
                  $query .= " WHERE V.relation={$relation_id}";
                  $query .= " AND V.property = P.id";
                  
                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  
                  $values = array();
                  while( $row = $this->db->fetch() ) {
                        
                        $prop = new Relation_value($row);                                                 
                        $values[$row["property"]] = $prop;
                        $this->values[$row["id"]] = $prop;                        
                  }
                                    
                  return $values;

            } else return false;
            
      }
      
      public function getRelationValuesJSON($relation_id) {
            
            if(is_numeric($relation_id)) {
                  
                  $values = $this->getRelationValues($relation_id);     
                  $valuesPublic = array();
                  
                  /* @var $v Relation_value */
                  foreach($values as $key => &$v) {
                                                                    
                        $valuesPublic[ $v->getId() ] = Array("value"    => $v->getValue (), 
                                                             "property" => $v->getProperty(),
                                                             "relation" => $v->getRelation(),
                                                             "label"    => $v->getPropertyLabel());
                  } 
                  
                  return json_encode($valuesPublic);

            } else return false;
            
      }
      
      public function getValues() {
            return $this->values;
      }

      public function setValues($properties) {
            $this->values = $properties;
      }

}

?>
