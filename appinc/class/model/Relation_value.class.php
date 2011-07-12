<?php

/**
 * Description of Relation_value
 *
 * @author pirhoo
 */
class Relation_value extends Record {
    
    private $property;
    private $property_label;
    private $relation;
    private $value;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProperty() {
        return $this->property;
    }

    public function setProperty($property) {               
        $this->property = $property;
    }

    public function getPropertyLabel() {
        return $this->property_label;
    }

    public function setPropertyLabel($propertyLabel) {
        $this->property_label = $propertyLabel;
    }

    public function getRelation() {
        return $this->relation;
    }

    public function setRelation($relation) {
        $this->relation = $relation;
    }

    public function getValue() { 
        if($this->getPropertyLabel() == "Source" && !preg_match("#^http://#i", $this->value) )
                $this->value= "http://".$this->value;
        return $this->value;
    }

    public function setValue($value) {                   
        $this->value = $value;
    }

    

    /**
     * Return an array with all value of this object
     * @return array
     * @access public
     */
    public function getArray($native = false) {

        $r = Array(
            "id" => $this->id,
            "property" => $this->property,
            "property_label" => $this->property_label,
            "value" => $this->value
        );            

        return $r;
    }
}

?>
