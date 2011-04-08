<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author pirhoo
 */
abstract class Manager { 
    
    protected $smarty;
    protected $db;
    protected $managers;
    protected $err;

    function __construct(& $smarty, & $db, & $managers, & $err) {
        // une référence vers smarty
        // le gestionaire de template
        $this->smarty = & $smarty;
        
        // une référence vers la base
        $this->db = & $db;
        
        // une référence vers les managers
        $this->managers = & $managers;
        
        // une référence vers le gestionaire d'erreur
        $this->err = & $err;
                
    }

    public function getSmarty() {
        return $this->smarty;
    }

    public function setSmarty($smarty) {
        $this->smarty = $smarty;
    }

    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function getManagers() {
          return $this->managers;
    }

    public function setManagers($managers) {
          $this->managers = $managers;
    }

    public function getErr() {
          return $this->err;
    }

    public function setErr($err) {
          $this->err = $err;
    }


}

?>
