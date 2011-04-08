<?php
/**
 * Description of Relation_trust_level
 *
 * @author pirhoo
 */
class Relation_trust_level  extends Record {
    
    public $relation_id;
    public $user_id;
    public $trust_level;
    
    public function getRelationId() {
        return $this->relation_id;
    }

    public function setRelationId($relation_id) {
        $this->relation_id = $relation_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getTrustLevel() {
        return $this->trust_level;
    }

    public function setTrustLevel($trust_level) {
        $this->trust_level = $trust_level;
    }



}

?>
