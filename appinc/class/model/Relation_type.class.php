<?php
/**
 * Description of Relation_type
 *
 * @author pirhoo
 */
class Relation_type extends Record { 
    
    private $freebase_id;
    private $label;
    
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

}

?>
