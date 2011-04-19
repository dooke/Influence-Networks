<?php
/**
 * Node class extends Record class
 * 
 * This class represents entities (person and organization). The Freebase ID is used to find the entity in Freebase
 * .
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package Record
 * @subpackage Node
 */
class Node extends Record {

    /**
     * @var string
     * @access private
     */
    private $freebase_id;
    /**
     * @var string
     * @access private
     */
    private $label;
    /**
     * @var string
     * @access private
     */
    private $type;

    /**
     * $freebase_id attrbiute getter
     * @return string
     * @access public
     */
    public function getFreebaseId() {
        return $this->freebase_id;
    }

    /**
     * $freebase_id attrbiute setter
     * @param string $freebase_id
     * @access public
     */
    public function setFreebaseId($freebase_id) {
        $this->freebase_id = $freebase_id;
    }
    
    
    /**
     * $label attrbiute getter
     * @return string
     * @access public
     */
    public function getLabel() {
        return $this->label;
    }


    /**
     * $label attrbiute setter
     * @param string $label
     * @access public
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * $type attrbiute getter
     * @return string
     * @access public
     */
    public function getType() {
        return $this->type;
    }

    /**
     * $type attrbiute setter
     * @param string $type
     * @access public
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * Return an array with all value of this object
     * @return array
     * @access public
     */
    public function getArray() {

        $r = Array(
            "id" => $this->id,
            "freebase_id" => $this->freebase_id,
            "label" => utf8_encode($this->label),
            "type" => $this->type,
        );


        return $r;
    }

}

?>
