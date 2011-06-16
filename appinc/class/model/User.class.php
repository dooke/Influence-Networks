<?php
/**
 * User class extends Record class
 * 
 * This class represents user.
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package Record
 * @subpackage User
 */
class User extends Record{
    
    private $email;
    private $password;
    private $trust_level;    
    private $pending;
    private $confirmationCode;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($mail) {
        $this->email = $mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getTrustLevel() {
        return $this->trust_level;
    }

    public function setTrustLevel($trust_level) {
        $this->trust_level = $trust_level;
    }
    
    public function getPending() {
        return $this->pending;
    }

    public function setPending($pending) {
        $this->pending = $pending;
    }

    public function getConfirmationCode() {
        return $this->confirmationCode;
    }

    public function setConfirmationCode($confirmationCode) {
        $this->confirmationCode = $confirmationCode;
    }

}

?>
