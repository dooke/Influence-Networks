<?php


/**
 * Description of Record
 *
 * @author pirhoo
 */
abstract class Record implements ArrayAccess {

    protected $erreurs = array();
    protected $id;

    public function __construct(array $donnees = array()) {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    public function isNew() {
        return empty($this->id);
    }

    public function getErreurs() {
        return $this->erreurs;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function hydrate(array $data) {
        
        foreach ($data as $attribut => $value) {
            
            if( ! is_int($attribut) ) {
                  
                  $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));

                  if (is_callable(array($this, $method)))
                      $this->$method($value);
            }
        }
    }

    public function offsetGet($var) {
        
        if (isset($this->$var) && is_callable(array($this, $var)))
            return $this->$var();
        
    }

    public function offsetSet($var, $value) {
        $method = 'set' . ucfirst($var);

        if( isset($this->$var) 
        &&  is_callable(array($this, $method)) )
                $this->$method($value);
        
    }

    public function offsetExists($var) {
        
        return isset($this->$var) && is_callable(array($this, $var));
        
    }

    public function offsetUnset($var) {
        
        throw new Exception('Impossible de supprimer une quelconque valeur.');
        
    }
    
    public function quickDisplay() {
        
        print_r($this);
        
    }

}

?>
