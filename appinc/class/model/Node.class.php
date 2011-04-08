<?php

/**
 * Description of Node
 *
 * @author pirhoo
 */
class Node extends Record {

      private $freebase_id;
      private $label;
      private $type;

      public function getId() {
            return $this->id;
      }

      public function setId($id) {
            $this->id = $id;
      }

      public function getFreebaseId() {
            return $this->freebase_id;
      }

      public function setFreebaseId($freebase_id) {
            $this->freebase_id = $freebase_id;
      }

      public function getLabel() {
            return $this->label;
      }

      public function setLabel($label) {
            $this->label = $label;
      }

      public function getFreebase_id() {
            return $this->freebase_id;
      }

      public function setFreebase_id($freebase_id) {
            $this->freebase_id = $freebase_id;
      }

      public function getType() {
            return $this->type;
      }

      public function setType($type) {
            $this->type = $type;
      }

      public function getArray() {

            $r = Array(
                "id" => $this->id,
                "freebase_id" => $this->freebase_id,
                "label" => $this->label,
                "type" => $this->type,
            );


            return $r;
      }

}

?>
