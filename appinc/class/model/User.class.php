<?php

/**
 * Description of User
 *
 * @author pirhoo
 */
class User extends Record{
    
    private $email;
    private $password;
    private $trust_level;    
    
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
        
}

?>
