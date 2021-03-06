<?php

/**
 * Description of Relation_type_property
 *
 * @author pirhoo
 */
class Relation_type_property extends Record {
    
    private $type;
    private $freebase_id;
    private $literal;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getFreebaseId() {
        return $this->freebase_id;
    }

    public function setFreebaseId($freebase_id) {
        $this->freebase_id = $freebase_id;
    }

    public function getLiteral() {
        return $this->literal;
    }

    public function setLiteral($literal) {
        $this->literal = $literal;
    }
 
    

    /**
     * Return an array with all value of this object
     * @return array
     * @access public
     */
    public function getArray($native = false) {

        $r = Array(
            "id" => $this->id,
            "type" => $this->type,
            "freebase_id" => $this->freebase_id,
            "literal" => $this->literal
        );            

        return $r;
    }

}

?>
