<?php
/**
 * Description of Relation_type
 *
 * @author pirhoo
 */
class Relation_type extends Record { 
    
    private $freebase_id;
    private $label;
    private $direction;
    private $hint;
    
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
    
    public function getDirection() {
          return $this->direction;
    }

    public function setDirection($direction) {
          $this->direction = $direction;
    }

    public function getHint() {
          return $this->hint;
    }

    public function setHint($hint) {
          $this->hint = $hint;
    }


    /**
     * Return an array with all value of this object
     * @return array
     * @access public
     */
    public function getArray($native = false) {

        $r = Array(
            "id" => $this->id,
            "freebase_id" => $this->freebase_id,
            "label" => $this->label,
            "direction" => $this->direction,
            "hint" => $this->hint
        );            

        return $r;
    }

}

?>
