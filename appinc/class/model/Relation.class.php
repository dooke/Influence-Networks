<?php

/**
 * Node class extends Record class
 * 
 * This class represents every relation between entities. 
 * .
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package Record
 * @subpackage Relation
 */
class Relation extends Record {

    /**
     * @var integer
     * @access private
     */
    private $node_left;  // subject
    /**
     * @var integer
     * @access private
     */
    private $node_right; // object
    /**
     * @var integer
     * @access private
     */
    private $creator;
    /**
     * @var integer
     * @access private
     */
    private $type; // predicate
    /**
     * @var float
     * @access private
     */
    private $trust_level;
    // not initialized in constructor
    /**
     * List of property values...
     * @var array
     * @access private
     */
    private $propertyValues;
    /**
     * @var string
     * @access private
     */
    private $type_label;
    /**
     * @var string
     * @access private
     */
    private $node_left_label;
    /**
     * @var string
     * @access private
     */
    private $node_right_label;
    /**
     * @var string
     * @access private
     */
    private $node_left_freebase_id;
    /**
     * @var string
     * @access private
     */
    private $node_right_freebase_id;
    /**
     * @var string
     * @access private
     */
    private $node_left_type;
    /**
     * @var string
     * @access private
     */
    private $node_right_type;

    /**
     * $node_left attribute getter
     * @return mixed
     * @access public
     */
    public function getNodeLeft() {
        return $this->node_left;
    }

    /**
     * $node_left attribute setter
     * @param mixed $node_left
     * @access public
     */
    public function setNodeLeft($node_left) {
        $this->node_left = $node_left;
    }

    /**
     * $node_right attribute getter
     * @return mixed
     * @access public
     */
    public function getNodeRight() {
        return $this->node_right;
    }

    /**
     * $node_right attribute setter
     * @param mixed $node_right
     * @access public
     */
    public function setNodeRight($node_right) {
        $this->node_right = $node_right;
    }

    /**
     * $creator attribute getter
     * @return integer
     * @access public
     */
    public function getCreator() {
        return $this->creator;
    }

    /**
     * $creator attribute setter
     * @param integer $creator
     * @access public
     */
    public function setCreator($creator) {
        $this->creator = $creator;
    }

    /**
     * $type attribute getter
     * @return integer
     * @access public
     */
    public function getType() {
        return $this->type;
    }

    /**
     * $type attribute setter
     * @param integer $type
     * @access public
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * $trust_level attribute getter
     * @return float
     * @access public
     */
    public function getTrustLevel() {
        return $this->trust_level;
    }

    /**
     * $trust_level attribute setter
     * @param float $trust_level
     * @access public
     */
    public function setTrustLevel($trust_level) {
        $this->trust_level = $trust_level;
    }

    /**
     * $type_label attribute getter
     * @return string
     * @access public
     */
    public function getTypeLabel() {
        return $this->type_label;
    }

    /**
     * $type_label attribute setter
     * @param string $typeLabel
     * @access public
     */
    public function setTypeLabel($typeLabel) {
        $this->type_label = $typeLabel;
    }

    /**
     * $propertyValues attribute getter
     * @return array
     * @access public
     */
    public function getPropertyValues() {
        return $this->propertyValues;
    }

    /**
     * $propertyValues attribute setter
     * @param array $property
     * @access public
     */
    public function setPropertyValues($property) {
        $this->propertyValues = $property;
    }

    /**
     * $node_left_label attribute getter
     * @return string
     * @access public
     */
    public function getNodeLeftLabel() {
        return $this->node_left_label;
    }

    /**
     * $node_left_label attribute setter
     * @param string $node_left_label
     * @access public
     */
    public function setNodeLeftLabel($node_left_label) {
        $this->node_left_label = $node_left_label;
    }

    /**
     * $node_left_right attribute getter
     * @return string
     * @access public
     */
    public function getNodeRightLabel() {
        return $this->node_right_label;
    }

    /**
     * $node_left_right attribute setter
     * @param string $node_right_label
     * @access public
     */
    public function setNodeRightLabel($node_right_label) {
        $this->node_right_label = $node_right_label;
    }

    /**
     * $node_right_type attribute getter
     * @return integer
     * @access public
     */
    public function getNodeRightType() {
        return $this->node_right_type;
    }

    /**
     * $node_right_type attribute setter
     * @param integer $node_right_type
     * @access public
     */
    public function setNodeRightType($node_right_type) {
        $this->node_right_type = $node_right_type;
    }

    /**
     * $node_left_type attribute getter
     * @return integer
     * @access public
     */
    public function getNodeLeftType() {
        return $this->node_left_type;
    }

    /**
     * $node_left_type attribute setter
     * @param integer $node_left_type
     * @access public
     */
    public function setNodeLeftType($node_left_type) {
        $this->node_left_type = $node_left_type;
    }


    /**
     * $node_left_freebase_id attribute getter
     * @return string 
     * @access public
     */
    public function getNodeLeftFreebaseId() {
        return $this->node_left_freebase_id;
    }

    /**
     * $node_left_freebase_id attribute setter
     * @param string $node_left_freebase_id
     * @access public
     */
    public function setNodeLeftFreebaseId($node_left_freebase_id) {
        $this->node_left_freebase_id = $node_left_freebase_id;
    }

    /**
     * $node_right_freebase_id attribute getter
     * @return string 
     * @access public
     */
    public function getNodeRightFreebaseId() {
        return $this->node_right_freebase_id;
    }

    /**
     * $node_right_freebase_id attribute setter
     * @param string $node_right_freebase_id
     * @access public
     */
    public function setNodeRightFreebaseId($node_right_freebase_id) {
        $this->node_right_freebase_id = $node_right_freebase_id;
    }

    /**
     * Return an array with all value of this object
     * @return array
     * @access public
     */
    public function getArray() {

        $r = Array(
            "id" => $this->id,
            "node_left" => $this->node_left,
            "node_right" => $this->node_right,
            "creator" => $this->creator,
            "type" => $this->type,
            "trust_level" => $this->trust_level,
            "type_label" => utf8_encode($this->type_label),
            "node_left_label" => utf8_encode($this->node_left_label),
            "node_right_label" => utf8_encode($this->node_right_label),
            "node_left_freebase_id" => $this->node_left_freebase_id,
            "node_right_freebase_id" => $this->node_right_freebase_id,
            "node_left_type" => $this->node_left_type,
            "node_right_type" => $this->node_right_type
        );


        return $r;
    }

    /**
     * Return a json string from all value of this object
     * @return string
     * @access public
     */
    public function getJson() {
        return json_encode($this->getArray());
    }

}

?>
