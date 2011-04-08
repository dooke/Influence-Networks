<?php

/**
 * Description of Relation
 *
 * @author pirhoo
 */
class Relation extends Record {

      private $node_left;  // sujet
      private $node_right; // objet
      private $creator;
      private $type; // predicat
      private $trust_level;
      // list of property values
      // not initialized in constructor
      private $propertyValues;  
      private $type_label;
      private $node_left_label;   
      private $node_right_label;   
      private $node_left_freebase_id;   
      private $node_right_freebase_id;
      private $node_left_type;   
      private $node_right_type;

      public function getId() {
            return $this->id;
      }

      public function setId($id) {
            $this->id = $id;
      }

      public function getNodeLeft() {
            return $this->node_left;
      }

      public function setNodeLeft($node_left) {
            $this->node_left = $node_left;
      }

      public function getNodeRight() {
            return $this->node_right;
      }

      public function setNodeRight($node_right) {
            $this->node_right = $node_right;
      }

      public function getCreator() {
            return $this->creator;
      }

      public function setCreator($creator) {
            $this->creator = $creator;
      }

      public function getType() {
            return $this->type;
      }

      public function setType($type) {
            $this->type = $type;
      }

      public function getTrustLevel() {
            return $this->trust_level;
      }

      public function setTrustLevel($trust_level) {
            $this->trust_level = $trust_level;
      }
      
      public function getTypeLabel() {
            return $this->type_label;
      }

      public function setTypeLabel($typeLabel) {
            $this->type_label = $typeLabel;
      }

      
      
      public function getPropertyValues() {
            return $this->propertyValues;
      }

      public function setPropertyValues($property) {
            $this->propertyValues = $property;
      }
      
      public function getNodeLeftLabel() {
            return $this->node_left_label;
      }

      public function setNodeLeftLabel($node_left_label) {
            $this->node_left_label = $node_left_label;
      }

      public function getNodeRightLabel() {
            return $this->node_right_label;
      }

      public function setNodeRightLabel($node_right_label) {
            $this->node_right_label = $node_right_label;
      }

      public function getNodeRightType() {
            return $this->node_right_type;
      }

      public function setNodeRightType($node_right_type) {
            $this->node_right_type = $node_right_type;
      }
      

      public function getNodeLeftType() {
            return $this->node_left_type;
      }

      public function setNodeLeftType($node_left_type) {
            $this->node_left_type = $node_left_type;
      }

      public function getJson() {

            return json_encode( $this->getArray() );
      }
      public function getNodeLeftFreebaseId() {
            return $this->node_left_freebase_id;
      }

      public function setNodeLeftFreebaseId($node_left_freebase_id) {
            $this->node_left_freebase_id = $node_left_freebase_id;
      }

      public function getNodeRightFreebaseId() {
            return $this->node_right_freebase_id;
      }

      public function setNodeRightFreebaseId($node_right_freebase_id) {
            $this->node_right_freebase_id = $node_right_freebase_id;
      }

            
      public function getArray() {

            $r = Array(
                "id"          => $this->id,
                "node_left"   => $this->node_left,
                "node_right"  => $this->node_right,
                "creator"     => $this->creator,
                "type"        => $this->type,
                "trust_level" => $this->trust_level,
                "type_label"        => $this->type_label,
                "node_left_label" => $this->node_left_label,
                "node_right_label" => $this->node_right_label,
                "node_left_freebase_id" => $this->node_left_freebase_id,
                "node_right_freebase_id" => $this->node_right_freebase_id,
                "node_left_type" => $this->node_left_type,
                "node_right_type" => $this->node_right_type
            );
            
            
            return $r;
      }

}

?>
